@extends('web.layouts.default', ['title' => 'お申込みフォーム'], ['pageName' => 'videoList'])
@section('content')
    <div class="keyv">
        <img class="keyvImage" src="/assets/img/common/keyv_detail.jpg" alt="プレミアチームのご案内">
        <h1 class="keyvTitle">お申込みフォーム</h1>
    </div>
    <div class="content pbSp30">
        <div class="inner01">
            <ul class="breadscrumb">
                <li><a href="/"><img src="/assets/img/svg/icon_home.svg" alt="home"></a><span>/</span></li>
                <li><em>お申込みフォーム</em></li>
            </ul>
            <div class="headline4">
                <h2>サッカープラス プレミアムチームのお申込み</h2>
            </div>
            <div class="section03">
                <p class="txtNote">ご記入いただいた内容に、お間違いがないかご確認の上、問題なければ「送信する」ボタンを、<br class="pcDisplay">
            内容を変更される場合は「変更する」ボタンをクリックしてください。</p>
            </div>
            <form action="#" method="POST" onsubmit="return (typeof submitted == 'undefined') ? (submitted = true) : !submitted">
                @csrf
                @foreach ($data as $field => $val)
                @if (in_array($field, ['contract_option']))
                    @foreach ($val as $option_val)
                    <input type="hidden" name="{{ $field }}[]" value="{{ $option_val }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $field }}" value="{{ $val }}">
                @endif
                @endforeach
                <div class="section03">
                    <h3 class="headline8 mb0">チーム情報</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>チーム代表者氏名</th>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <th>チーム代表者氏名(フリガナ)</th>
                                    <td>{{ $data->name_furigana }}</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $data->registration_email }}</td>
                                </tr>
                                <tr>
                                    <th>団体名</th>
                                    <td>{{ $data->corp_name }}</td>
                                </tr>
                                <tr>
                                    <th>団体名(フリガナ)</th>
                                    <td>{{ $data->corp_name_furigana }}</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>{{ merge_zip($data->zip_1, $data->zip_2) }}</td>
                                </tr>
                                <tr>
                                    <th>ご住所</th>
                                    <td>{{ $data->address }}</td>
                                </tr>
                                <tr>
                                    <th>お電話番号</th>
                                    <td>{{ $data->tel }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">担当者情報</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>{{ $data->pic_name }}</td>
                                </tr>
                                <tr>
                                    <th>担当者名(フリガナ)</th>
                                    <td>{{ $data->pic_name_furigana }}</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $data->pic_email }}</td>
                                </tr>
                                <tr>
                                    <th>連絡先(携帯電話)</th>
                                    <td>{{ $data->pic_mobile }}</td>
                                </tr>
                                <tr>
                                    <th>生年月日</th>
                                    <td>{{ $data->pic_birthday_year }}年{{ $data->pic_birthday_month }}月{{ $data->pic_birthday_day }}日</td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>{{ config('constants.pic_gender.label.' .  $data->pic_gender) }}</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>{{ merge_zip($data->pic_zip_1, $data->pic_zip_2) }}</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>{{ $data->pic_address }}</td>
                                </tr>
                                <tr>
                                    <th>お電話番号</th>
                                    <td>{{ $data->pic_tel }}</td>
                                </tr>
                                <tr>
                                    <th>プレミアム契約</th>
                                    <td>
                                        <span class="mr10 inlineBlock">1台目　{{ !empty($data->contract_premium1) ? config('constants.contract_premium1.label.' . $data->contract_premium1) : 'なし' }}</span>
                                        <span class="mr10 inlineBlock">2台目　{{ !empty($data->contract_premium2) ? config('constants.contract_premium2.label.' . $data->contract_premium2) : 'なし' }}</span>
                                        <span class="inlineBlock">3台目　{{ !empty($data->contract_premium3) ? config('constants.contract_premium3.label.' . $data->contract_premium3) : 'なし' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>オプション契約</th>
                                    @php
                                    $option_labels = [];
                                    foreach ($data->contract_option as $option_key) {
                                        $option_labels[] = config('constants.contract_option.label.' . $option_key);
                                    }
                                    @endphp
                                    <td>{{ implode('、', $option_labels) }}</td>
                                </tr>
                                <tr>
                                    <th>支払い方法 1</th>
                                    <td>{{ config('constants.payment_method1.label.' . $data->payment_method1 ) }}</td>
                                </tr>
                                <tr>
                                    <th>支払い方法 2</th>
                                    <td>{{ config('constants.payment_method2.label.' . $data->payment_method2 ) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">第二連絡先</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>{{ $data->contact2_name }}</td>
                                </tr>
                                <tr>
                                    <th>担当者名(フリガナ)</th>
                                    <td>{{ $data->contact2_name_furigana }}</td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $data->contact2_email }}</td>
                                </tr>
                                <tr>
                                    <th>連絡先(携帯電話)</th>
                                    <td>{{ $data->contact2_tel }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section03">
                    <h3 class="headline8 mb0">送付先</h3>
                    <div class="tblStyle02">
                        <table>
                            <tbody>
                                <tr>
                                    <th>担当者名</th>
                                    <td>{{ $data->delivery_name }}</td>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <td>{{ merge_zip($data->delivery_zip_1, $data->delivery_zip_2) }}</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>{{ $data->delivery_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="center mb20">
                    <button class="btnStrategy big jsDynamicFormAction" data-action="{{ route('web.entry.thanks') }}">
                        送信する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="送信する">
                        </span>
                    </button>
                </p>
                <p class="center">
                    <button class="btnStrategy bgGray jsDynamicFormAction" data-action="{{ route('web.entry.index_post') }}">
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
