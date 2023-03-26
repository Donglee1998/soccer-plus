@extends('web.layouts.default', ['title' => 'ゲーム記録'], ['pageName' => 'matchCommentary'])
@section('content')
<div class="keyv">
    <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="スタッツ">
    <h1 class="keyvTitle"><span>ゲーム記録</span>戦評入力</h1>
</div>
<div class="content">
    <div class="inner01">
        <ul class="breadscrumb">
            <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.list') }}">ゲーム記録</a><span>/</span></li>
            <li><a href="{{ route('web.scorebook.matches.report', ['matches_id' => request()->matches_id]) }}">試合レポート</a><span>/</span></li>
            <li><em>戦評入力</em></li>
        </ul>
        <h2 class="headline5 mgb40">戦評入力</h2>
        <form method="post" action="{{route('web.scorebook.matches.comment.edit', ['matches_id' => request()->matches_id])}}">
            @csrf
            <div class="section02">
                <ul class="form style01 setW">
                    <li>
                        <span class="err">{{ $errors->first('title') }}</span>
                        <div class="formInput bg01">
                            <p class="ttl">
                                回戦
                                <span class="noRequire">任意</span>
                            </p>
                            <input type="text" name="title" value="{{ old('title', $data['title'] ?? '') }}" class="{{ empty($errors->first('title')) ? 'valInput' : ''}}">
                        </div>
                    </li>
                    <li>
                        <span class="err">{{ $errors->first('content') }}</span>
                        <div class="formInput bg01">
                            <p class="ttl">
                                戦評
                                <span class="noRequire">任意</span>
                            </p>
                            <textarea type="text" name="content" class="{{ empty($errors->first('content')) ? 'valInput' : ''}}">{{ old('content', $data['content'] ?? '') }}</textarea>
                        </div>
                    </li>
                    <li>
                        <span class="err">{{ $errors->first('name') }}</span>
                        <div class="formInput bg01">
                            <p class="ttl">
                                文責
                                <span class="noRequire">任意</span>
                            </p>
                            <input type="text" name="name" value="{{ old('name', $data['name'] ?? '') }}" class="{{ empty($errors->first('name')) ? 'valInput' : ''}}">
                        </div>
                    </li>
                </ul>
            </div>
            <p class="dFlex cusLay01">
                <a href="{{ url()->previous() }}" class="btnStrategy bgGray resetW300 mb20">
                    試合レポートに戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left_gray.svg" alt="試合レポートに戻る">
                    </span>
                </a>
                <button type="submit" class="btnStrategy resetW300 mb20">
                    更新
                    <span>
                        <img src="/assets/img/svg/ic_circle_check.svg" alt="更新">
                    </span>
                </button>
            </p>
        </form>
    </div>
</div>
@endsection
