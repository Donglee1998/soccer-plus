<div id="tab_{{ $key }}" class="tabBox" {!! $loop->first ? 'style="display: block;"' : '' !!}>
    <div id="uploadBox_{{ $key }}" class="uploadBox" @if(count($statVideoArgs[$key])) style="display: none;" @endif>
        <input id="uploadVideo_{{ $key }}" class="jsChunkUploadPrepare" type="file"
            data-upload-url="{{ route('web.ajax.chunk-video.store') }}"
            data-validate-url="{{ route('web.ajax.chunk-video.play-validate') }}"
            data-progress-url="{{ route('web.ajax.chunk-video.progress') }}"
            data-save-url="{{ route('web.ajax.chunk-video.album-save') }}"
            data-process-type="play{{ $key }}"
            data-chunk-mb="{{ config('constants.pbpv.space_upload.chunk_mb') }}"
            data-file-types="{{ implode(',', config('constants.pbpv.valid_video_types')) }}"
            data-assign-upload-id="uploadVideo_{{ $key }}">
        <p class="ttl pcDisplay">動画ファイルを<br>ドロップしてアップロード</p>
        <p class="ttl spDisplay">動画ファイルをアップロード</p>
        <p class="txt">または</p>
        <label for="uploadVideo_{{ $key }}" class="fileUpload">
            <span>ファイルを選択</span>
        </label>
        <p class="note">最大アップロードサイズ:<span>○○ MB</span></p>
        <a href="javascript:void(0)" class="btnOpenPopup fileUpload">アップロード済みの動画から選択する</a>
    </div>
    <div class="showVideo showVideo_{{ $key }}" @if(!count($statVideoArgs[$key])) style="display: none;" @endif>
        <div class="blockVideo">
            <p class="timeVideo">動画時間&nbsp;<span class="time" id="myvideo_{{ $key }}_timer">00:00</span></p>
            <div class="video">
                <video controls id="myvideo_{{ $key }}" class="jsMainVideo">
                    @if(count($statVideoArgs[$key]))
                    @foreach ($statVideoArgs[$key] as $video)
                    <source src="{{$video->video->url}}" type="video/mp4">
                    @endforeach
                    @else
                    <source src="" type="video/mp4">
                    <source src="" type="video/ogg">
                    @endif
                </video>
            </div>
            <button class="btnDelete">
                <svg class="icon">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_close" />
                </svg>
                <span class="txt">動画を非表示にする</span>
            </button>
        </div>
    </div>
    <form action="">
        <div class="playControl col2">
            <div class="item">
                <div class="groupCtrl">
                    <select name="" class="formControl jsSelectSortBy" data-round="_{{ $key }}">
                        <option value="">並び順を選択</option>
                        <option value="id">通常表示</option>
                        <option value="member">選手毎ソート</option>
                        <option value="action">プレイ種類ソート</option>
                    </select>
                    <select name="" class="formControl jsSelectSortItem" data-round="_{{ $key }}">
                        <option value="">選手を選択</option>
                    </select>
                </div>
            </div>
            <div id="groupBtn_{{ $key }}" class="item" @if (!count($statVideoArgs[$key])) style="display: none;" @endif>
                <div class="groupCtrl">
                    <a class="btnCtrl jsPlaySelectedStats" href="javascript:void(0);"
                        data-video_id="myvideo_{{ $key }}"
                        data-round="{{ $key }}">チェックしたプレイを再生</a>
                    <a class="btnCtrl jsModal" href="#myModal3"
                        onclick="$('#playTimeRoundHidden').val('{{ $key }}'); $('#errorPlayTime').text('').removeClass('block');">再生時間の一括変更</a>
                </div>
            </div>
        </div>
        <div class="dataTimeContent">
            <p class="ttl">{{ $key }}</p>
            <div class="blockScroll">
                <table class="tblList style01 mb0 handledCheckCtrl statList_{{$key}}">
                    <tr>
                        <th class="w7">
                            <label class="cbCustom">
                                <input type="checkbox">
                                <span class="checkmark jsCheckAll"></span>
                            </label>
                        </th>
                        <th class="w10">TIME</th>
                        <th>{{ $matches->team1->name }}</th>
                        <th class="w6 textCenter">GOAL</th>
                        <th>{{ $matches->team2->name }}</th>
                        <th class="w10">再生時間</th>
                        <th class="w10 textCenter">操作</th>
                    </tr>
                    @php
                    $_pk_turn_team1 = 1;
                    $_pk_turn_team2 = 1;
                    @endphp
                    @foreach ($stats as $stat)
                    <tr class="stat_{{ $stat->id }} jsStatRow" data-stat_id="{{ $stat->id }}" data-timer_at="{{ $stat->timer_at }}"
                        data-member_id="{{ $stat->member->id ?? ($stat->member_anonymous_id ? '?' : '') }}" data-action_id="{{ $stat->action_id }}">
                        <td class="rePadding jsChecked" title="{{ $stat->id }}">
                            <label class="cbCustom">
                                <input type="checkbox" class="statCheckbox" value="{{ $stat->id }}" data-member_id="{{ $stat->member?->id }}" data-action_id="{{ $stat->action_id }}">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>{{ implode(':', parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0, false)) }}</td>
                        <td>
                        @php
                            $_action = get_action_name_by_id($stat->action_id);
                            $_result = get_action_result_label($stat->action_id, $stat->result);
                        @endphp
                            @if($stat->member?->team_id == $matches->team_id1)
                                @php
                                    $_number = get_display_number($matches->type, $stat->member?->number_official, $stat->member?->number_practice);
                                    $_full_name = $stat->member?->full_name;
                                @endphp
                                @if ($key !== 'PK')
                                    {{ $_number }} / {{ $_full_name }} / {{ $_action }}{{ $_result }}
                                @else
                                    {{ $_number }} / {{ $_full_name }} / {{ $_action }}{{ $_pk_turn_team1++ }}回目 {{ $_result }}
                                @endif
                            @elseif (is_anonymous_stat_belong_to_team($matches->team_id1, $team_home_id, $stat->member_anonymous_id)) 
                                ? / ? / {{ $_action }}{{ $_result }}
                            @endif
                        </td>
                        <td class="textCenter">
                            @if(in_array($stat->action_id, config('constants.pbpv.goal_actions')) && $stat->result == 1)
                                <span><img src="/assets/img/svg/ic_ball.svg" alt=""></span>
                            @endif
                        </td>
                        <td>
                        @php
                            $_action = get_action_name_by_id($stat->action_id);
                            $_result = get_action_result_label($stat->action_id, $stat->result);
                        @endphp
                            @if($stat->member?->team_id == $matches->team_id2)
                                @php
                                    $_number = get_display_number($matches->type, $stat->member?->number_official, $stat->member?->number_practice);
                                    $_full_name = $stat->member?->full_name;
                                @endphp
                                @if ($key !== 'PK')
                                    {{ $_number }} / {{ $_full_name }} / {{ $_action }}{{ $_result }}
                                @else
                                    {{ $_number }} / {{ $_full_name }} / {{ $_action }}{{ $_pk_turn_team2++ }}回目 {{ $_result }}
                                @endif
                            @elseif (is_anonymous_stat_belong_to_team($matches->team_id2, $team_home_id, $stat->member_anonymous_id))
                                ? / ? / {{ $_action }}{{ $_result }}
                            @endif
                        </td>
                        @php
                            $startTime = time_to_sec($stat->statsVideos->time_start_play ?? '');
                            $endTime   = time_to_sec($stat->statsVideos->time_stop_play ?? '');
                        @endphp
                        <td class="time_start_play" data-start="{{$startTime}}" data-end="{{$endTime}}">
                            {{$stat->statsVideos?->time_start_play}}
                        </td>
                        <td class="edit_play_video">
                            @php
                                $route        = route('web.scorebook.matches.edit', ['matches_id'=> $stat->match_id, 'stat_id' => $stat->id]);
                                $statsVideoId = $stat->statsVideos->id ?? '';
                            @endphp
                            @if ($statsVideoId)
                            <p class="btnPlay cusLay">
                                <a href="#" class="playType01 jsPlayVideo" data-type="01"
                                    data-time_start="{{ $startTime }}"
                                    data-time_stop="{{ $endTime }}"
                                    data-video_id="myvideo_{{ $key }}">
                                    <svg class="icon iconPlay">
                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_play" />
                                    </svg>
                                    <a href="{{$route}}" class="editLink">編集</a>
                                </a>
                            </p>
                            @else
                            <p class="btnPlay cusLay">
                                <a href="#" class="playType03 jsPlayVideo" data-type="03">
                                    <svg class="icon iconPlay">
                                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_play" />
                                    </svg>
                                    <a href="{{$route}}" class="editLink">編集</a>
                                </a>
                            </p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <p class="center">
            <a href="javascript:void(0)" class="btnRemoveStatPlayVideo btnStrategy cus-mw pcDisplayInlineFlex">
                チェックしたプレイの動画を解除
                <span>
                    <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                </span>
            </a>
            <a href="javascript:void(0)" class="btnRemoveStatPlayVideo btnStrategy cus-mw spDisplayInlineFlex">
                チェックしたプレイを削除
                <span>
                    <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                </span>
            </a>
        </p>
    </form>
</div>