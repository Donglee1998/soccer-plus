@extends('web.layouts.default', ['title' => '動画再生時の編集'], ['pageName' => 'playByPlay'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
    <h1 class="keyvTitle"><span>ゲーム記録</span>Play by Play Video</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.list') }}">ゲーム記録</a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.matches.video', ['matches_id'=> $stat->match_id]) }}">Play by Play Video</a><span>/</span></li>
            <li><em>動画再生時の編集</em></li>
        </ul>
        <div class="blockFilter">
            <ul class="blockFilter__name">
                <li>
                    <span class="ttl">フォルダ名</span>
                    <select name="folder_id" id="folderStat" class="select formControl">
                        <option value="">フォルダ名がはいります</option>
                        @php
                            $folder_id = $stat->statsVideos->video->folder_id ?? '';
                        @endphp
                        @foreach ($folders as $key => $folder)
                            <option {{ $folder_id == $folder->id ? 'selected' : '' }} value="{{ $folder->id }}"> {{ $folder->name }} </option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <span class="ttl">動画</span>
                    <select name="video_id" id="videoStat" class="select formControl">
                        <option value="">動画タイトルがはいります</option>
                        @php
                            $video_id = $stat->statsVideos->video_id ?? '';
                        @endphp
                        @foreach ($videos as $key => $video)
                            <option {{ $video_id == $video->id ? 'selected' : '' }} value="{{ $video->id }}" data-url="{{$video->url}}"> {{ $video->title }}</option>
                        @endforeach
                    </select>
                </li>
            </ul>
        </div>
        @error('video_id')
            <p class="error block">{{ $message }}</p>
        @enderror
        <div id="showVideo show">
            <div class="blockVideo">
                <p class="timeVideo">動画時間&nbsp;<span class="time" id="playVideoStat_timer">00:00</span></p>
                <div class="video">
                    @php
                        $startTime = time_to_sec($stat->statsVideos->time_start_play ?? 0);
                        $endTime   = time_to_sec($stat->statsVideos->time_stop_play ?? 0);
                    @endphp
                    <video id="playVideoStat" loop muted autoplay controls data-start="{{ $startTime }}" data-stop="{{ $endTime  }}"
                        class="jsMainVideo">
                        <source id="playVideoStatSource" src="{{$stat->statsVideos?->video?->url}}" type="video/mp4">
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
        <h2 class="headline9"><span>{{$stat->member?->number_practice}}番</span> / <span>{{$stat->member?->full_name}}</span> / <span>{{ get_action_name_by_id($stat->action_id) }}</span></h2>
        <div class="timeMatch">スコア入力時
            <span class="ml20">{{ Str::replace('_','', $stat->created_at_round) }}</span>
            <span>{{ implode(':',parse_duration($stat->timer_at > 0 ? $stat->timer_at / 1000 : 0)) }}</span>
        </div>
        <form method="post" action="{{ route('web.scorebook.matches.update', ['matches_id' => $match->id, 'stat_id' => $stat->id]) }}">
            @csrf
            <input type="hidden" id="video_id" name="video_id" value="{{ old('video_id', $stat->statsVideos?->video_id) }}">
            <div class="editPlayVid">
                    <div class="item">
                        <label class="labelTxt" for="timeStartPlay">再生時</label>
                        <div class="inputBox">
                            <input type="text" id="timeStartPlay" class="formControl" name="time_start_play" value="{{ old('time_start_play', $stat->statsVideos?->time_start_play) }}">
                            @error('time_start_play')
                                <p class="error block">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="item">
                        <label class="cbCustom style01">
                            <input type="checkbox" name="replace_next_flg" value="1">
                            <span class="checkmark"></span>
                        </label>
                        このプレイを基準に他のプレイの再生も設定する
                    </div>
                    <div class="item">
                        <label class="labelTxt" for="timeStopPlay">プレイ終了時</label>
                        <div class="inputBox">
                            <input type="text" id="timeStopPlay" class="formControl" name="time_stop_play" value="{{ old('time_stop_play', $stat->statsVideos?->time_stop_play) }}">
                            @error('time_stop_play')
                                <p class="error block">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="item">
                        <textarea class="formControl" name="comment" id="comment" cols="30" rows="10" placeholder="コメント記入">{{ old('comment', $stat->statsVideos?->comment) }}</textarea>
                        @error('comment')
                            <span class="error block">{{ $message }}</span>
                        @enderror
                    </div>
            </div>
            <p class="dFlex cusLay">
                <a href="{{ route('web.scorebook.matches.video', ['matches_id'=> $stat->match_id]) }}" class="btnStrategy bgGray resetW300">
                    キャンセル
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="キャンセル">
                    </span>
                </a>
                <button type="submit" class="btnStrategy resetW300">
                    修正保存
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="修正保存">
                    </span>
                </button>
            </p>
        </form>
    </div>
</div>
@endsection
