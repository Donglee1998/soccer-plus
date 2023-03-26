@php
    $purpose_opts  = Config::get('constants.contact.purpose.label');
    $app_type_opts = Config::get('constants.contact.app_type.label');
@endphp
@extends('web.layouts.default', ['title' => 'お問い合わせ'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お問い合わせ</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お問い合わせ</em></li>
            </ul>
            <section class="section02">
                <p class="txtNote">
                    お問い合わせの際は、特にメールアドレスなど、下記各項目が正しい内容かどうかご確認の上、お問い合わせください。<br>メールアドレス相違の場合は弊社より返信できませんのでご注意ください。<br><br><span>尚、iPadレンタル版アプリ「Soccer Pad2」のみ、 ZOOM等を活用したオンラインでの商品案内を受け付けております。<br>オンラインでのご案内をご希望のお客様は、下記内容をお問い合わせ内容にご明記の上、お問い合わせください。</span>
                </p>

                <ul class="listContent">
                    <li class="txtNote">ご希望の日時 (いくつか候補があればご記載ください。)</li>
                    <li class="txtNote">参加希望人数</li>
                    <li class="txtNote">ご希望の利用プラン (任意)</li>
                    <li class="txtNote">その他、事前にご質問等あればご記載ください。</li>
                </ul>

                <ul class="listContent1">
                    <li class="txtNote1"><span>※</span> 所要時間は30分ほどです。</li>
                    <li class="txtNote1"><span>※</span> App Store版では上記オンラインでの商品紹介は受け付けておりません。</li>
                </ul>
            </section>
            <form method="post" action="{{route('web.contact.store')}}" class="section01">
                @csrf
                <div class="section02">
                    <ul class="form style01">
                        <li>
                            <span class="err">{{ $errors->first('name') }}</span>
                            <div class="formInput">
                                <p class="ttl">
                                    お名前
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="name" class="{{ empty($errors->first('name')) ? 'valInput' : ''}}" value="{{ old('name', $data['name'] ?? '') }}" placeholder="例）山田太郎">
                            </div>
                        </li>
                        <li>
                            <span class="err">{{ $errors->first('email') }}</span>
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="email" class="{{ empty($errors->first('email')) ? 'valInput' : ''}}" value="{{ old('email', $data['email'] ?? '') }}" placeholder="例）info@soccer--plus.jp">
                            </div>
                        </li>
                        <li>
                            <span class="err">{{ $errors->first('confirm_email') }}</span>
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス（確認）
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="confirm_email" class="{{ empty($errors->first('confirm_email')) ? 'valInput' : ''}}" value="{{ old('confirm_email', $data['confirm_email'] ?? '') }}" placeholder="例）info@soccer--plus.jp">
                            </div>
                        </li>
                        <li>
                            <div class="formInput">
                                <p class="ttl">
                                    所属チーム
                                </p>
                                <input type="text" name="team"  placeholder="例）〇〇高校 男子サッカー部" value="{{ old('team', $data['team'] ?? '') }}">
                            </div>
                        </li>
                        <li>
                            <div class="formInput">
                                <p class="ttl">
                                    お問い合わせ目的
                                </p>
                                <select name="purpose" id="purpose" class="formControl">
                                    <option value="" hidden selected>お問い合わせ目的</option>
                                    <option value=""></option>
                                    @foreach ($purpose_opts as $key => $value)
                                        <option {{ (intval(old('purpose', @$data['purpose'])) === $key) ? 'selected':'' }} value="{{ $key }}"> {{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li id="appType" class="{{ old('purpose', @$data['purpose']) != config('constants.contact.purpose.key.app_using') ? 'noDisplay' : ''}}">
                            <div class="formInput">
                                <p class="ttl">
                                    ご利用アプリ
                                </p>
                                <select name="app_type" class="formControl">
                                    <option value="" hidden selected>ご利用頂いているアプリを選択してください</option>
                                    <option value=""></option>
                                    @foreach ($app_type_opts as $key => $value)
                                        <option {{ (intval(old('app_type', @$data['app_type'])) === $key && old('app_type', $data['app_type'] ?? null) !== null) ? 'selected':'' }} value="{{ $key }}"> {{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li>
                            <span class="err">{{ $errors->first('content') }}</span>
                            <div class="formInput">
                                <p class="ttl">
                                    お問い合わせ内容
                                    <span class="require">必須</span>
                                </p>
                                <textarea type="text" class="{{ empty($errors->first('content')) ? 'valInput' : '' }} pt5" name="content">{{ old('content', $data['content'] ?? '') }}</textarea>
                            </div>
                        </li>
                    </ul>
                </div>
                <p class="center">
                    <button type="submit" class="btnStrategy big" value="confirm" name="submit">
                        確認する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸右">
                        </span>
                    </button>
                </p>
            </form>
            <div class="boxedCmn">
                <h2 class="headline6">iPadセットモデル <span>(36か月レンタル版)</span></h2>
                <div class="flexBox">
                    <span class="btnCmn1">専用ダイヤル</span>
                    <a class="phoneNumber" href="tel:0120-945-432">0120-945-432</a>
                </div>
                <span class="receptionistTime">受付時間 10：00～18：00</span>
            </div>
        </div>
    </div>
@endsection
