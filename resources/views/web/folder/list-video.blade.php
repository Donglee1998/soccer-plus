@extends('web.layouts.default', ['title' => '動画フォルダ'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle pcDisplay"><span>動画一覧</span>フォルダ情報</h1>
        <h1 class="keyvTitle spDisplay"><span>動画一覧</span>フォルダ情報</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><a href="{{ route('web.team.album') }}">動画一覧</a><span>/</span></li>
                <li class="pcDisplay nameFolder"><em>{{ $data->folder->name ?? null }}</em></li>
                <li class="spDisplay nameFolder"><em>動画情報</em></li>
            </ul>
            <h2 class="headline4 style01">
                <span class="txt nameFolder">{{ $data->folder->name ?? null }}</span>
                <a href="#modalEdit" class="btnEdit jsModal">
                    <svg class="icon">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_pen" />
                    </svg>
                </a>
            </h2>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="folder_id" id="folderIdHiddenInput" hidden value="{{ $data->folder->id ?? null }}">
                <div class="blockUpload">
                    <ul class="blockUpload__name">
                        <li>
                            <span class="ttl">動画ファイル</span>
                            <span class="cusInputFile center active">
                                <input type="file" name="video" id="fileUpload">
                                <span class="subTxt nameFile" id="fileUploadName">ファイルを選択</span>
                            </span>
                        </li>
                        <li>
                            <span class="ttl">動画タイトル</span>
                            <input type="text" class="center" name="title" id="titleInput">
                        </li>
                    </ul>
                    <button class="btnUpload jsChunkUploadPrepare jsChunkUploadButton" type="button"
                        data-upload-url="{{ route('web.ajax.chunk-video.store') }}"
                        data-validate-url="{{ route('web.ajax.chunk-video.album-validate') }}"
                        data-progress-url="{{ route('web.ajax.chunk-video.progress') }}"
                        data-save-url="{{ route('web.ajax.chunk-video.album-save') }}"
                        data-process-type="album"
                        data-chunk-mb="{{ config('constants.pbpv.space_upload.chunk_mb') }}"
                        data-file-types="{{ implode(',', config('constants.pbpv.valid_video_types')) }}"
                        data-assign-upload-id="fileUpload">
                        <em class="add">動画を追加</em>
                    </button>
                </div>
            </form>
            <div class="mb20">
                <p class="error block mt5" id="titleErrorMessage"></p>
                <p class="error block mt5" id="typeErrorMessage"></p>
                <p class="error block mt5" id="sizeErrorMessage"></p>
            </div>
            <div class="blockProgress">
                <div class="progressBar">
                    <span class="progressBar__ttl">ディスク使用状況</span>
                    <span class="progressBar__percent">
                        <span class="percent jsSpaceUploadPercent" style="width: {{ $data->space_upload_info->used_percent }}%"></span>
                    </span>
                </div>
                <div class="progressDetail">
                    <span class="progressDetail__txt purple">使用領域：<span class="jsSpaceUploadUsed">{{ $data->space_upload_info->used_mb }}</span> MB</span>
                     / 
                     <span class="progressDetail__txt">空き領域：{{ $data->space_upload_info->space }} {{ $data->space_upload_info->unit }}</span>
                </div>
            </div>
            @if (count($data->videos))
                <table class="tblList handledCheckCtrl table_video">
                    <tr>
                        <th class="wid48">
                            <label class="cbCustom">
                                <input type="checkbox" class="video_checkbox_all">
                                <span class="checkmark jsCheckAll"></span>
                            </label>
                        </th>
                        <th class="wid110 center">サムネイル</th>
                        <th>動画タイトル</th>
                    </tr>
                    @foreach ($data->videos as $video)
                        <tr>
                            <td>
                                <label class="cbCustom jsChecked">
                                    <input type="checkbox" name="video_id[]" value="{{ $video->id }}" class="video_checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td class="rePadd">
                                <a href="{{ route('web.show.video', ['video_id' => $video->id]) }}">
                                    <img src="{{ $video->path_url }}" alt="home">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('web.show.video', ['video_id' => $video->id]) }}">
                                    {{ $video->title }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p class="alert">チームデータがありません。</p>
                <!-- / .search alert when no item -->
            @endif
            <p class="center">
                <a class="btnStrategy disabled" id="delVideo">
                    チェックした動画を削除
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
            {!! $data->videos->appends(request()->all())->links('web.commons.pagination') !!}
        </div>
        <x-web.web-model-admin-password classTh="jsOkModalVideo" />
        <x-web.web-model-edit classTh="jsOkModalEditFolder" title="フォルダ名の編集">
            <input name="folder_id" value="{{ $data->folder->id ?? '' }}" hidden>
            <input name="folder_name" value="{{ $data->folder->name ?? '' }}">
        </x-web.web-model-edit>

        @include('web.includes.overlay-modal')
    </div>
@endsection
