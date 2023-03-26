@extends('web.layouts.default', ['title' => '作戦ボード一覧'], ['pageName' => 'pageBoard'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="作戦ボード">
        <h1 class="keyvTitle">作戦ボード</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><em>作戦ボード</em></li>
            </ul>
            @php
                $tactic_type = Config::get('constants.tactic_type.label');
            @endphp
            @if (count($data))
                <form action="#" class="handledCheckCtrl">
                    <div class="hdrAllCheck">
                        <label class="ctrCheckbox">
                            <input type="checkbox" class="tactic_checkbox_all">
                            <span class="checkmark jsCheckAll">一括削除</span>
                        </label>
                    </div>

                    <div class="listStrategyBoard list_tactic">
                        @foreach ($data as $tactic)
                            <div class="item">
                                <div class="blockImg">
                                    <label class="ctrCheckbox jsChecked">
                                        <input type="checkbox" name="strategy" value="{{ $tactic->id }}"
                                            class="tactic_checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <img src="{{ !empty($tactic->sheets[0]->sketch) ? $tactic->sheets[0]->sketchUrl() : asset('assets/img/bg_login.jpg') }}" alt="攻撃：攻撃の作戦ボードタイトルが入ます攻撃の作戦ボードタイトルが入ます">
                                </div>
                                <div class="blockContent">
                                    <p class="textDateTime">
                                        <span class="date">{{ format_date($tactic->updated_at, 'Y-m-d H:i') ?? '' }}</span>
                                    </p>
                                    <a href="{{ route('web.board.show', ['board' => $tactic->id]) }}"
                                        class="nameMatch">{{ $tactic_type[$tactic->type] . ':' . $tactic->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="center">
                        <a id="delTactic" class="btnStrategy spW300 disabled">
                            チェックした作戦を削除
                            <span>
                                <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
                            </span>
                        </a>
                    </p>
                </form>
                {!! $data->appends(request()->all())->links('web.commons.pagination') !!}
            @else
                <p class="alert ta">データがありません。</p>
                <!-- / .search alert when no item -->
            @endif
        </div>
        <x-web.web-model-admin-password classTh="jsOkModalTactic" />
    </div>
@endsection
