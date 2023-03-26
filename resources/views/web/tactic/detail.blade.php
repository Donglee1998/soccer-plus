@extends('web.layouts.default', ['title' => '作戦ボード詳細'], ['pageName' => 'pageBoard'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="作戦ボード">
        <h1 class="keyvTitle">作戦ボード</h1>
    </div>
    <div class="content">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt=""></a><span>/</span></li>
                <li><a href="{{ route('web.board.index') }}">作戦ボード</a><span>/</span></li>
                <li><em>作戦ボード詳細</em></li>
            </ul>
            @php
                $tactic_type    = Config::get('constants.tactic_type.label');
                $tactic_status  = Config::get('constants.tactic_status.label');
                $tactic_pitch   = Config::get('constants.tactic_pitch.label');
            @endphp
            <div class="headline4">
                <h2>{{ !empty($tactic_type[$tactic->type]) ? $tactic_type[$tactic->type]  . ' | ' . $tactic->title : $tactic->title }}</h2>
            </div>
            <table class="tableInfo blockMb40Sp30">
                <tbody>
                    <tr>
                        <td class="fw500 center w200">説明</td>
                        <td>{{ $tactic->explain }}</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">作戦の種類</td>
                        <td>{{ $tactic_type[$tactic->type] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">状況</td>
                        <td>{{ $tactic_status[$tactic->status] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw500 center">コートの種類</td>
                        <td>{{ $tactic_pitch[$tactic->pitch] ?? '' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="splide jsSplide" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ( $tactic->sheets as $sheet)
                                <li class="splide__slide"><img src="{{ $sheet->sketchUrl() }}" alt=""></li>
                            @endforeach
                        </ul>
                </div>
                <div>
                    <div class="ctPagination">
                        <span class="text">シーン</span>
                        <span id="numberSlide" class="bold">1 &nbsp;</span>/<span id="numberAllSlide"></span>
                    </div>
                </div>
            </div>
            <div class="splide jsSplideText" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ( $tactic->sheets as $sheet)
                                <li class="splide__slide txtCm01">{!! nl2br(e($sheet->comment)) !!}</li>
                            @endforeach
                        </ul>
                </div>
            </div>
            <p class="center">
                <a href="{{ url()->previous() }}" class="btnStrategy">
                    作戦ボード一覧に戻る
                    <span class="positionLeft">
                        <img src="/assets/img/svg/ic_circle_left.svg" alt="チーム一覧に戻る">
                    </span>
                </a>
            </p>
        </div>
    </div>
@endsection
