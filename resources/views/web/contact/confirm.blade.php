@php
    $purpose_opts  = Config::get('constants.contact.purpose.label');
    $app_type_opts = Config::get('constants.contact.app_type.label');
@endphp
@extends('web.layouts.default', ['title' => 'お問い合わせ 確認画面'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お問い合わせ 確認画面</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お問い合わせ 確認画面</em></li>
            </ul>
            <div class="section03">
                <p class="txtNote">ご記入いただいた内容に、お間違いがないかご確認の上、問題なければ「送信する」ボタンを、<br class="pcDisplay">内容を変更される場合は「変更する」ボタンをクリックしてください。</p>
            </div>
            <form method="post" action="{{route('web.contact.store')}}" onsubmit="return (typeof submitted == 'undefined') ? (submitted = true) : !submitted">
                @csrf
                <div class="section03">
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>お名前</th>
                                    <td>{{ $data['name'] }}</td>
                                    <input type="text" name="name" value="{{ $data['name'] }}" hidden>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $data['email'] }}</td>
                                    <input type="text" name="email" value="{{ $data['email'] }}" hidden>
                                    <input type="text" name="confirm_email" value="{{ $data['confirm_email'] }}" hidden>
                                </tr>
                                <tr>
                                    <th>所属チーム</th>
                                    <td>{{ $data['team'] }}</td>
                                    <input type="text" name="team" value="{{ $data['team'] }}" hidden>
                                </tr>
                                <tr>
                                    <th>お問い合わせ目的</th>
                                    <td>{{ $purpose_opts[$data['purpose']] ?? '' }}</td>
                                    <input type="text" name="purpose" value="{{ $data['purpose'] ?? '' }}" hidden>
                                </tr>
                                @if($data['purpose'] == config('constants.contact.purpose.key.app_using'))
                                <tr>
                                    <th>ご利用アプリ</th>
                                    <td>{{ $app_type_opts[$data['app_type']] ?? '' }}</td>
                                    <input type="text" name="app_type" value="{{ $data['app_type'] ?? '' }}" hidden>
                                </tr>
                                @endif
                                <tr>
                                    <th>お問い合わせ内容</th>
                                    <td>{!! nl2br(e($data['content'])) !!}</td>
                                    <textarea type="text" name="content" hidden>{{ $data['content'] }}</textarea>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="center mb20">
                    <button type="submit" class="btnStrategy big" name="submit" value="done">
                        送信する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="送信する">
                        </span>
                    </button>
                </p>
                <p class="center">
                    <button type="submit" class="btnStrategy bgGray" name="submit" value="back">
                        変更する
                        <span class="positionLeft">
                            <img src="/assets/img/svg/ic_circle_left_gray.svg" alt="アイコンサークル左">
                        </span>
                    </button>
                </p>
            </form>
        </div>
    </div>
@endsection
