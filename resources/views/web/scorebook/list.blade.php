@extends('web.layouts.default', ['title' => 'ゲーム記録'], ['pageName' => 'playByPlay'])
@push('css')
<link rel="stylesheet" href="{{ get_file_version('/css/datepicker.css') }}">
@endpush

@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="ゲーム記録">
        <h1 class="keyvTitle">ゲーム記録</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>ゲーム記録</em></li>
            </ul>
                <div class="blockMb40Sp30">
                    <div class="blockSearch">
                        <input type="text" class="searchTerm" value="{{ request()->keyword ?? ''}}" placeholder="キーワードで検索" id="keyword" name='keyword'>
                        <button type="submit" class="searchBtn">
                            <img src="/assets/img/svg/icon_search.svg" alt="search">
                        </button>
                    </div>
                    <div class="blockGameType">
                        @php
                            $type_matchs = Config::get('constants.match_type.label');
                        @endphp
                        <div class="item">
                            <select name="typeMatch" id="typeMatch" class="formControl">
                                <option value=""hidden selected>試合の種類を選択</option>
                                <option value=""></option>
                                @foreach ($type_matchs as $key => $value)
                                    <option {{ request()->type_match == $key?'selected':'' }} value="{{ $key }}"> {{ $value }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="item">
                            <div class="datepickerWrapper">
                                <p class="datepickerInput">
                                    <input value="{{ request()->start_date_match ?? ''}}" class="styleSelect" type="text" id="startDate" name="startDateMatch" readonly="true" autocomplete="off" placeholder="開始日"/>
                                </p>
                                <p class="datepickerInput">
                                    <input value="{{ request()->end_date_match ?? ''}}" class="styleSelect" type="text" id="endDate" name="endDateMatch" readonly="true" autocomplete="off" placeholder="終了日"/>
                                </p>
                            </div>
                        </div>
                        <p class="text"></p>
                    </div>
                </div>

                <section class="matchs">
                    @include('web.scorebook.data-list')
                </section>
            <x-web.web-model-admin-password classTh="jsOkModal" />
        </div>
    </div>
@endsection
