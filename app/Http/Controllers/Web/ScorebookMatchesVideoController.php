<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\StatVideoRequest;
use App\Http\Requests\Web\UpdatePlayTimeRequest;
use App\Models\StatsVideos;
use App\Repositories\MatchRepository;
use App\Repositories\MemberRepository;
use App\Repositories\StatRepository;
use App\Repositories\StatsVideoRepository;
use App\Repositories\FolderRepository;
use App\Repositories\VideoRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScorebookMatchesVideoController extends BaseController
{
    private $_matchRepos;

    public function __construct(MatchRepository $matchRepos, StatRepository $statRepos, MemberRepository $memberRepos, FolderRepository $folderRepo, VideoRepository $videoRepo, StatsVideoRepository $statsVideoRepo)
    {
        $this->_matchRepos     = $matchRepos;
        $this->_statRepos      = $statRepos;
        $this->_memberRepos    = $memberRepos;
        $this->_folderRepo     = $folderRepo;
        $this->_videoRepo      = $videoRepo;
        $this->_statsVideoRepo = $statsVideoRepo;
    }

    public function index($id, Request $request)
    {
        $auth_id    = Auth::guard('web')->user()->id;
        $match_list = $this->_matchRepos->getListMatchByAuth($auth_id)->pluck('id')->toArray();
        if (!in_array($id, $match_list)) {
           return abort(404);
        }else {
            $matches = $this->_matchRepos->model()::where('created_by', auth()->user()->id)
                ->with([
                    'team1' => function ($query) {
                        $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
                    },
                    'team2' => function ($query) {
                        $query->select('id', 'name', 'is_home', 'abbreviation', 'color_home', 'color_guest');
                    },
                    'lineup1',
                    'lineup2',
                ])->find($id);
            if (!$matches) {
                abort(404);
            }

            // Find team home
            $team_home_id  = $matches->team_owner == 1 ? $matches->team1->id : $matches->team2->id;
            $statScore     = $matches->statScore();
            $statKeys      = array_keys($statScore);
            $statsArgs     = [];
            $statVideoArgs = [];
            foreach ($statKeys as $key) {
                $key_tmp             = \Str::replace('_', '', $key);
                $statsArgs[$key_tmp] = $this->_statRepos->model()
                    ::where('match_id', $id)
                    ->where('created_at_round', $key)
                    ->with(['member', 'statsVideos'])
                    ->whereNotNull('timer_at')
                    ->orderBy('timer_at')
                    ->get();
                $video = StatsVideos::select(['video_id'])
                    ->where('match_id', $id)
                    ->where('round', $key)->groupBy('video_id')->get();
                $statVideoArgs[$key_tmp] = $video;
            }

            $match_common_info = $this->_matchRepos->getCommonInfo($id);
            return view('web.scorebook.matches_video', compact('matches', 'statScore', 'statVideoArgs', 'statKeys', 'statsArgs', 'team_home_id', 'match_common_info'));
        }
    }

    public function addTimePlayAllStats(Request $request)
    {
        DB::beginTransaction();
        try {
            StatsVideos::where('match_id', $request->match_id)->where('round', $request->round)->delete();
            $video = $this->_videoRepo->model()::find($request->video_id);
            $stats = $this->_statRepos->model()::where('match_id', $request->match_id)
                ->where('created_at_round', $request->round)
                ->whereNotNull('timer_at')
                ->with('member')->orderBy('timer_at')->get();

            $time_start_play_sec = 0;
            $time_stop_play_sec  = 0;
            foreach ($stats as $key => $stat) {
                $time_stop_play_sec = isset($stats[$key + 1])
                ? self::_milli2Second($stats[$key + 1]->timer_at - $stat->timer_at) + $time_start_play_sec
                : $video->duration;

                if ($time_start_play_sec >= $video->duration) {
                    break;
                }

                StatsVideos::create([
                    'match_id'         => $request->match_id,
                    'stat_id'          => $stat->id,
                    'video_id'         => $request->video_id,
                    'round'            => $stat->created_at_round,
                    'time_start_play'  => implode(':', parse_duration($time_start_play_sec)),
                    'time_stop_play'   => implode(':', parse_duration($time_stop_play_sec)),
                    'replace_next_flg' => 0,
                    'comment'          => '',

                ]);

                $time_start_play_sec = isset($stats[$key + 1])
                ? self::_milli2Second($stats[$key + 1]->timer_at - $stat->timer_at) + $time_start_play_sec
                : $video->duration;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }

        $stats = StatsVideos::select(['match_id', 'stat_id', 'video_id', 'time_start_play', 'time_stop_play'])
            ->where('match_id', $request->match_id)->where('round', $request->round)->get()->toArray();
        return response()->json($stats);
    }

    public function deleteStatVideoPlay(Request $request)
    {
        if ($request->stats) {
            $stats = explode(',', $request->stats);
            StatsVideos::whereIn('stat_id', $stats)->delete();
            return response()->json(['result' => true]);
        }
        return response()->json(['result' => false]);
    }

    public function editStatVideoPlay($matches_id, $stat_id, Request $request)
    {
        $stat  = $this->_statRepos->find($stat_id);
        $match = $this->_matchRepos->find($matches_id);
        if ($stat->match_id !== $match->id) {
            return redirect()->route('web.scorebook.matches.video', ['matches_id' => $match->id]);
        }

        $user = Auth::guard('web')->user();
        $conditions = [
            'created_by' => $user->id,
            'is_pagination' => false,
        ];

        $folders = $this->_folderRepo->list($conditions);
        $videos  = !empty($stat->statsVideos->video->folder_id)
            ? $this->_videoRepo->list(array_merge($conditions, ['folder_id' => $stat->statsVideos->video->folder_id]))
            : $this->_videoRepo->list(array_merge($conditions));
        return view('web.scorebook.matches_video_edit', compact('folders', 'videos', 'match', 'stat'));
    }

    public function updateStatVideoPlay($matches_id, $stat_id, StatVideoRequest $request)
    {
        try {
            DB::beginTransaction();
            $match = $this->_matchRepos->find($matches_id);
            $stat  = $this->_statRepos->find($stat_id);
            if ($stat->match_id !== $match->id) {
                return redirect()->route('web.scorebook.matches.video', ['matches_id' => $match->id]);
            }

            $round = '_' . \Str::replace('_', '', $stat->created_at_round);
            $data = [
                'match_id'         => $match->id,
                'stat_id'          => $stat->id,
                'video_id'         => $request->video_id,
                'round'            => $round,
                'time_start_play'  => $request->time_start_play,
                'time_stop_play'   => $request->time_stop_play,
                'replace_next_flg' => 0,
                'comment'          => $request->comment ?? '',
            ];

            $statVideos = $this->_statsVideoRepo->updateOrCreate(['id' => $stat->statsVideos->id ?? null], $data);
            if ($request->replace_next_flg) {
                $video = $this->_videoRepo->model()::find($request->video_id);
                $stats = $this->_statRepos->model()
                    ::where('timer_at', '>=', $stat->timer_at)
                    ->whereNotNull('timer_at')
                    ->where('match_id', $match->id)
                    ->where('created_at_round', $round)
                    ->orderBy('timer_at')
                    ->get();

                $time_start_play_sec = 0;
                $time_stop_play_sec  = 0;
                foreach ($stats as $key => $stat) {
                    if ($key == 0) {
                        $time_start_play_sec = isset($stats[$key + 1])
                            ? self::_milli2Second($stats[$key + 1]->timer_at - $stat->timer_at) + time_to_sec($statVideos->time_start_play)
                            : $video->duration;
                        continue;
                    }

                    $time_stop_play_sec = isset($stats[$key + 1])
                    ? self::_milli2Second($stats[$key + 1]->timer_at - $stat->timer_at) + $time_start_play_sec
                    : $video->duration;

                    if ($time_start_play_sec >= $video->duration) {
                        break;
                    }

                    $data = [
                        'match_id'         => $match->id,
                        'stat_id'          => $stat->id,
                        'video_id'         => $request->video_id,
                        'round'            => $round,
                        'time_start_play'  => implode(':', parse_duration($time_start_play_sec)),
                        'time_stop_play'   => implode(':', parse_duration($time_stop_play_sec)),
                        'replace_next_flg' => 0,
                        'comment'          => '',
                    ];
                    $statVideos = $this->_statsVideoRepo->updateOrCreate(['id' => $stat->statsVideos->id ?? null], $data);

                    $time_start_play_sec = isset($stats[$key + 1])
                    ? self::_milli2Second($stats[$key + 1]->timer_at - $stat->timer_at) + $time_start_play_sec
                    : $video->duration;
                }
            }
            DB::commit();
            return redirect()->route('web.scorebook.matches.video', ['matches_id' => $match->id]);
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return redirect()->route('web.scorebook.matches.video', ['matches_id' => $match->id]);
        }
    }

    public function getPulldownVideo(Request $request)
    {
        $user = Auth::guard('web')->user();
        $conditions = [
            'created_by' => $user->id,
            'is_pagination' => false,
            'is_append' => true,
        ];

        $videos = !empty($request->folder_id)
            ? $this->_videoRepo->list(array_merge($conditions, ['folder_id' => $request->folder_id]))
            : $this->_videoRepo->list($conditions);
        return response()->json($videos);
    }

    public function updatePlayTime(UpdatePlayTimeRequest $request)
    {
        DB::beginTransaction();
        try {
            $stats = $this->_statRepos->model()::with('statsVideos')
                ->where('match_id', $request->matches_id)
                ->where('created_at_round', "_$request->round")
                ->get();
            foreach ($stats as $stat) {
                if ($stat->statsVideos) {
                    $stop_time_sec                     = time_to_sec($stat->statsVideos->time_start_play) + $request->play_time;
                    $stat->statsVideos->time_stop_play = implode(':', parse_duration($stop_time_sec));
                    $stat->statsVideos->save();
                }
            }

            DB::commit();

            $stats = StatsVideos::select(['match_id', 'stat_id', 'video_id', 'time_start_play', 'time_stop_play'])
                ->where('match_id', $request->matches_id)->where('round', "_$request->round")->get()->toArray();
            return response()->json($stats);
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return response()->json(['errors' => ['play_time' => ['異常が起こりました。後でもう一度試してみてください。']]], 422);
        }
    }

    private function _milli2Second($millisecond)
    {
        return $millisecond > 0 ? $millisecond / 1000 : 0;
    }
}
