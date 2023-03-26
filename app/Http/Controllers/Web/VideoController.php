<?php

namespace App\Http\Controllers\Web;

use App\Repositories\VideoRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\VideoRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    protected $__videoRepo;

    public function __construct(VideoRepository $videoRepo)
    {
        $this->__videoRepo   = $videoRepo;
    }

    public function destroy(Request $request)
    {
        $user = Auth::guard('web')->user();

        $ischeck = checkPasswordAdmin($user, $request->password_admin);

        return $ischeck->status() === 200 ? $this->_detroyVideo($user, $request->folder_id, $request->id_video) : $ischeck;
    }

    private function _detroyVideo($user, $folder_id, $id_video)
    {
        try {
            $condition = [
                'created_by'    => $user->id ?? '',
                'folder_id'     => intval($folder_id)
            ];
            if (!empty($id_video)) {
                $condition['array_id_video'] = array_map('intval', explode(",", $id_video));
            }

            $this->__videoRepo->deleteVideo($condition);

            return response()->json([
                'message'   => 'Removed Video Success.',
                'status'    => true,
                'data'      => [
                    'space_upload_info' => Auth::guard('web')->user()->getSpaceUploadInfo(),
                ]
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($video_id)
    {
        $user      = Auth::guard('web')->user();
        $condition = [
            'video_id' => $video_id ?? '',
            'created_by' => $user->id ?? ''
        ];
        $video = $this->__videoRepo->findVideo($condition);

        if (empty($video)) {
            return abort(404);
        }

        return view('web.folder.detail-video', compact('video'));
    }

    public function update(VideoRequest $request, $video_id)
    {
        try {
            $user      = Auth::guard('web')->user();
            $condition = [
                'video_id'   => $video_id ?? '',
                'created_by' => $user->id ?? '',
            ];
            $video = $this->__videoRepo->findVideo($condition) ?? null;

            if (empty($video)) {
                return $this->responseNotFound();
            }
            
            $data = [
                'title' => $request->title
            ];

            $this->__videoRepo->update($data, $video_id);

            return response()->json([
                'message'   => 'Update Video Success.',
                'status'    => true
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            return response()->json([
                'message'   => $e->getMessage(),
                'status'    => false
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
