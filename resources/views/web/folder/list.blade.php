@extends('web.layouts.default', ['title' => '動画一覧'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">動画一覧</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>動画一覧</em></li>
            </ul>
            <form method="post" action="{{route('web.folder.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="blockUpload mb30">
                    <ul class="blockUpload__name">
                        <li>
                            <span class="ttl">フォルダ名</span>
                            <input type="text" placeholder="フォルダ名を入力して下さい" name="name">
                        </li>
                    </ul>
                    <button class="btnUpload addFolder" type="submit">
                        <em class="add">フォルダを追加</em>
                    </button>
                </div>
                @if ($errors)
                    @foreach($errors->all() as $error)
                        <p class="error block">{{ $error }}</p>
                    @endforeach
                @endif
            </form>
            <table class="tblList handledCheckCtrl table_folder">
                @if (count($folders))
                    <tr>
                        <th class="wid48">
                            <label class="cbCustom">
                                <input type="checkbox" class="folder_checkbox_all">
                                <span class="checkmark jsCheckAll"></span>
                            </label>
                        </th>
                        <th>フォルダ名</th>
                    </tr>
                    @foreach ($folders as $folder)
                        <tr>
                            <td>
                                <label class="cbCustom jsChecked">
                                    <input type="checkbox" name="value_folder[]" value="{{ $folder->id }}" class="folder_checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td><a href="{{ route('web.list.video.folder', ['folder_id' => $folder->id]) }}">{{ $folder->name }}</a></td>
                        </tr>
                    @endforeach
                @else
                    <p class="alert">チームデータがありません。</p>
                    <!-- / .search alert when no item -->
                @endif
            </table>
            <p class="center">
                <a id="delFolder" class="btnStrategy disabled">
                    チェックしたフォルダを削除
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
            {!! $folders->appends(request()->all())->links('web.commons.pagination') !!}
        </div>
        <x-web.web-model-admin-password classTh="jsOkModalFolder" />
    </div>
@endsection
