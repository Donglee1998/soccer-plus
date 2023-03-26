@extends('web.layouts.login', ['title' => 'Teaser'])
@section('content')
<div class="teaserContainer">
    <div class="teaserContent">
        <div class="teaserHead">
            <h1 class="logo"><img src="/assets/img/svg/logo.svg" alt="SOCCER PLUS"></h1>
        </div>
        <div class="info">
            <p class="ttl">
                <img src="/assets/img/teaser/txt01_teaser.svg" alt="">
            </p>
            <p class="date"><span>2023</span>年<span>4</span>月<span>1</span>日公開予定</p>
            <p class="copyright">
                <img src="/assets/img/teaser/txt03_teaser.svg" alt="">
            </p>
        </div>
    </div>
</div>
@endsection
