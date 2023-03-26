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
            <ul class="breadscrumb inner01">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><a href="#"></a>期間別集計</li>
            </ul>
            <h2 class="headline4">期間別集計絞り込み</h2>
            <ul style="color: red" id="errors">
            </ul>
            <div class="blockFilter" style="margin-top: 10px">
                <ul class="blockFilter__name">
                    <li>
                        <span class="ttl">期間(開始日)</span>
                        <div class="select cusInputDate">
                            <input type="text" id="startDate" name="date_from" class="jsDatePicker" placeholder="" val="">
                        </div>
                    </li>
                    <li>
                        <span class="ttl">期間(終了日)</span>
                        <div class="select cusInputDate">
                            <input type="text" id="endDate" name="date_to" class="jsDatePicker" placeholder="" val="">
                        </div>
                    </li>
                    <li>
                        <span class="ttl">チーム名</span>
                        <select name="team" id="team" class="select formControl">
                            <option value="">チーム名を選択</option>
                            @foreach($team as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <span class="ttl">試合の種類</span>
                        <select name="type" id="" class="select formControl">
                            @foreach($type as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="blockBtn">
                        <button type="submit" id="check" class="btnUpload">検索</button>
                    </li>
                </ul>
            </div>
            <p class="btnGroup" id="groups">
            </p>
        </div>
    </div>
<script type="text/javascript">
    window.current_page = 'period_aggregation_index';
</script>
@endsection
