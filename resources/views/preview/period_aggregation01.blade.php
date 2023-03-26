@extends('web.layouts.default', ['title' => '期間別集計'], ['pageName' => 'pagePeriod'])
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/css/datepicker.css') }}">
@endpush
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">期間別集計</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>期間別集計</em></li>
            </ul>
            <h2 class="headline4">期間別集計絞り込み</h2>
            <div class="blockFilter">
                <ul class="blockFilter__name">
                    <li>
                        <span class="ttl">期間(開始日)</span>
                        <div class="select cusInputDate">
                            <input type="text" id="startDate" class="" placeholder="" val="">
                        </div>
                    </li>
                    <li>
                        <span class="ttl">期間(終了日)</span>
                        <div class="select cusInputDate">
                            <input type="text" id="endDate" class="" placeholder="" val="">
                        </div>
                    </li>
                    <li>
                        <span class="ttl">チーム名</span>
                        <select name="" id="" class="select formControl">
                            <option value="">チーム名を選択</option>
                        </select>
                    </li>
                    <li>
                        <span class="ttl">試合の種類</span>
                        <select name="" id="" class="select formControl">
                            <option value="">すべて</option>
                            <option value="">練習試合</option>
                            <option value="">公式試合</option>
                            <option value="">研究用</option>
                        </select>
                    </li>
                </ul>
            </div>
            <p class="btnGroup">
                <a href="/preview/period_aggregation02" class="btnStrategy">
                    スタッツを見る
                    <span>
                        <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸チェック">
                    </span>
                </a>
                <a href="/preview/period_aggregation03" class="btnStrategy">
                    シュートチャートを見る
                    <span>
                        <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸チェック">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection
