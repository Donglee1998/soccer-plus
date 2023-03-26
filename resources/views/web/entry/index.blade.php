@php
$fields = [
    'name', 'name_furigana', 'registration_email', 'corp_name', 'corp_name_furigana',
    'zip_1', 'zip_2', 'address', 'tel', 'pic_name', 'pic_name_furigana', 'pic_email',
    'pic_mobile', 'pic_birthday_year', 'pic_birthday_month', 'pic_birthday_day',
    'pic_gender', 'pic_zip_1', 'pic_zip_2', 'pic_address', 'pic_tel',
    'contract_premium1', 'contract_premium2', 'contract_premium3', 'contract_option',
    'payment_method1', 'payment_method2', 'contact2_name', 'contact2_name_furigana',
    'contact2_email', 'contact2_tel', 'delivery_name', 'delivery_zip_1', 'delivery_zip_2',
    'delivery_address', 'terms_checkbox',
];
$old = (object) [];
foreach ($fields as $field) {
    if (in_array($field, ['contract_option',])) {
        $old->$field = old($field, $data->$field ?? []);
    } else {
        $old->$field = old($field, $data->$field ?? '');
    }
}
@endphp
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
            <div class="btnDealWrapper section02">
                <a href="#" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    プレミアムチームとは
                </a>
                <a href="#" class="btnDeal">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <g id="Group_28602" data-name="Group 28602" transform="translate(12866 2726)">
                                <g id="Group_28600" data-name="Group 28600" transform="translate(-13932 -4145)">
                                    <circle id="Ellipse_157" data-name="Ellipse 157" cx="13" cy="13" r="13" transform="translate(1066 1419)" fill="#6b64c1"></circle>
                                    <path id="Path_25970" data-name="Path 25970" d="M9.2,4.794H2.15L4.609,7.253a.63.63,0,1,1-.89.891L.185,4.61a.625.625,0,0,1-.042-.047L.127,4.542.106,4.513C.1,4.5.1,4.5.09,4.487L.074,4.461.061,4.433c0-.009-.009-.018-.013-.028s-.007-.019-.01-.028-.007-.02-.011-.03S.022,4.328.02,4.318.014,4.3.012,4.287s0-.023-.005-.034,0-.018,0-.027A.636.636,0,0,1,0,4.1c0-.009,0-.018,0-.027s0-.023.005-.034,0-.021.008-.031,0-.019.007-.029.007-.02.011-.03.006-.019.01-.028L.061,3.9c0-.009.009-.019.014-.028L.09,3.841C.1,3.832.1,3.823.106,3.814l.021-.029.015-.021a.625.625,0,0,1,.042-.047L3.719.184a.63.63,0,0,1,.891.891L2.15,3.534H9.2a.63.63,0,1,1,0,1.259Z" transform="translate(1083.479 1435.931) rotate(180)" fill="#fff"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    利用料金について
                </a>
            </div>
            <form action="{{ route('web.entry.confirm') }}" method="POST" class="section02 jsAutoValidateForm jsAutoScrollToFailedField">
                @csrf
                <div class="section03">
                    <h3 class="headline8">チーム情報</h3>
                    <ul class="form">
                        <li>
                            @if ($errors->has('name'))
                            <span class="err">{{ $errors->get('name')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    チーム代表者氏名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="name" placeholder="例）山田太郎" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="nameInput"
                                    value="{{ $old->name }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('name_furigana'))
                            <span class="err">{{ $errors->get('name_furigana')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    チーム代表者氏名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="name_furigana" placeholder="例）ヤマダタロウ" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="nameFuriganaInput"
                                    value="{{ $old->name_furigana }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('registration_email'))
                            <span class="err">{{ $errors->get('registration_email')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="registration_email" placeholder="例）info@soccer--plus.jp" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="email" id="registrationEmailInput"
                                    value="{{ $old->registration_email }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('corp_name'))
                            <span class="err">{{ $errors->get('corp_name')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    団体名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="corp_name" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="corpNameInput"
                                    value="{{ $old->corp_name }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('corp_name_furigana'))
                            <span class="err">{{ $errors->get('corp_name_furigana')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    団体名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="corp_name_furigana" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="corpNameFuriganaInput"
                                    value="{{ $old->corp_name_furigana }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('zip'))
                            <span class="err">{{ $errors->get('zip')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex postalCode">
                                        <input type="text" name="zip_1" maxlength="3"
                                            class="jsAutoValidateField" data-validate-type="zip_1" id="zip1Input"
                                            value="{{ $old->zip_1 }}">
                                        <span>-</span>
                                        <input type="text" name="zip_2" maxlength="4"
                                            class="jsAutoValidateField" data-validate-type="zip_2" id="zip2Input"
                                        value="{{ $old->zip_2 }}">
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('address'))
                            <span class="err">{{ $errors->get('address')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    ご住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="address" maxlength="255" placeholder="例）東京都大田区千鳥2-17-7"
                                    class="jsAutoValidateField" data-validate-type="text" id="addressInput"
                                    value="{{ $old->address }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('tel'))
                            <span class="err">{{ $errors->get('tel')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    お電話番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="tel" maxlength="255" placeholder="例）03-4376-5171"
                                    class="jsAutoValidateField" data-validate-type="tel" id="telInput"
                                    value="{{ $old->tel }}">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section03">
                    <h3 class="headline8">担当者情報</h3>
                    <ul class="form">
                        <li>
                            @if ($errors->has('pic_name'))
                            <span class="err">{{ $errors->get('pic_name')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_name" placeholder="例）山田太郎" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="picNameInput"
                                    value="{{ $old->pic_name }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_name_furigana'))
                            <span class="err">{{ $errors->get('pic_name_furigana')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名(フリガナ)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_name_furigana" placeholder="例）ヤマダタロウ" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="picNameFuriganaInput"
                                    value="{{ $old->pic_name_furigana }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_email'))
                            <span class="err">{{ $errors->get('pic_email')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    メールアドレス
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_email" placeholder="例）info@soccer--plus.jp" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="email" id="picEmailInput"
                                    value="{{ $old->pic_email }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_mobile'))
                            <span class="err">{{ $errors->get('pic_mobile')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    連絡先(携帯電話)
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_mobile" maxlength="255"
                                    id="picMobileInput" value="{{ $old->pic_mobile }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_birthday'))
                            <span class="err">{{ $errors->get('pic_birthday')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    生年月日
                                    <input type="hidden" name="pic_birthday" value="">
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    <select name="pic_birthday_year" id="#" class="formControl">
                                        <option value="">年</option>
                                        @for ($year = date('Y') - 10; $year >= date('Y') - 70; $year--)
                                        <option value="{{ $year }}"
                                            @if ($old->pic_birthday_year && $old->pic_birthday_year == $year) selected @endif>{{ $year }}</option>
                                        @endfor
                                    </select>/
                                    <select name="pic_birthday_month" id="#" class="formControl">
                                        <option value="">月</option>
                                        @for ($month = 1; $month <= 12; $month++)
                                        @php
                                        $formatted_month = zerofill($month);
                                        @endphp
                                        <option value="{{ $formatted_month }}"
                                            @if ($old->pic_birthday_month && $old->pic_birthday_month == $formatted_month) selected @endif>{{ $formatted_month }}</option>
                                        @endfor
                                    </select>/
                                    <select name="pic_birthday_day" id="#" class="formControl">
                                        <option value="">日</option>
                                        @for ($day = 1; $day <= 31; $day++)
                                        @php
                                        $formatted_day = zerofill($day);
                                        @endphp
                                        <option value="{{ $formatted_day }}"
                                            @if ($old->pic_birthday_day && $old->pic_birthday_day == $formatted_day) selected @endif>{{ $formatted_day }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_gender'))
                            <span class="err">{{ $errors->get('pic_gender')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    性別
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    @foreach ([
                                        '男性' => config('constants.pic_gender.key.male'),
                                        '女性' => config('constants.pic_gender.key.female'),
                                    ] as $label => $val)
                                    <label class="rbCustom">
                                        {{ $label }}
                                        <input type="radio" name="pic_gender" value="{{ $val }}"
                                            @if ($old->pic_gender == $val) checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_zip'))
                            <span class="err">{{ $errors->get('pic_zip')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex postalCode">
                                    <input type="text" name="pic_zip_1" maxlength="3"
                                        class="jsAutoValidateField" data-validate-type="zip_1" id="picZip1Input"
                                        value="{{ $old->pic_zip_1 }}">
                                    <span>-</span>
                                    <input type="text" name="pic_zip_2" maxlength="4"
                                        class="jsAutoValidateField" data-validate-type="zip_2" id="picZip2Input"
                                        value="{{ $old->pic_zip_2 }}">
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_address'))
                            <span class="err">{{ $errors->get('pic_address')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_address" maxlength="255" placeholder="例）東京都大田区千鳥2-17-7"
                                    class="jsAutoValidateField" data-validate-type="text" id="picAddressInput"
                                    value="{{ $old->pic_address }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('pic_tel'))
                            <span class="err">{{ $errors->get('pic_tel')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    お電話番号
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="pic_tel" maxlength="255" placeholder="例）03-4376-5171"
                                    class="jsAutoValidateField" data-validate-type="tel" id="picTelInput"
                                    value="{{ $old->pic_tel }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('contract_premium'))
                            <span class="err">{{ $errors->get('contract_premium')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    プレミアム契約
                                    <span class="require">必須</span>
                                </p>
                                <div class="listRadio">
                                    <div class="dFlex">
                                        <span class="ttl">1台目</span>
                                        @foreach ([
                                            'ホワイト' => config('constants.contract_premium1.key.white'),
                                            'ブラック' => config('constants.contract_premium1.key.black'),
                                        ] as $label => $val)
                                        <label class="rbCustom">
                                            {{ $label }}
                                            <input type="radio" name="contract_premium1" value="{{ $val }}"
                                                @if ($old->contract_premium1 == $val) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="dFlex">
                                        <span class="ttl">2台目</span>
                                        @foreach ([
                                            '希望しない' => config('constants.contract_premium2.key.nothing'),
                                            'ホワイト' => config('constants.contract_premium2.key.white'),
                                            'ブラック' => config('constants.contract_premium2.key.black'),
                                        ] as $label => $val)
                                        <label class="rbCustom">
                                            {{ $label }}
                                            <input type="radio" name="contract_premium2" value="{{ $val }}"
                                                @if ($old->contract_premium2 == $val) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="dFlex">
                                        <span class="ttl">3台目</span>
                                        @foreach ([
                                            '希望しない' => config('constants.contract_premium3.key.nothing'),
                                            'ホワイト' => config('constants.contract_premium3.key.white'),
                                            'ブラック' => config('constants.contract_premium3.key.black'),
                                        ] as $label => $val)
                                        <label class="rbCustom">
                                            {{ $label }}
                                            <input type="radio" name="contract_premium3" value="{{ $val }}"
                                                @if ($old->contract_premium3 == $val) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('contract_option'))
                            <span class="err">{{ $errors->get('contract_option')[0] }}</span>
                            @endif
                            @php
                            $old_contract_option = old('contract_option', $data->contract_option ?? []);
                            @endphp
                            <div class="formInput">
                                <p class="ttl">
                                    オプション契約
                                </p>
                                <ul class="dFlex listCheckBox">
                                    @foreach ([
                                        'オリジナルipadカバー' => config('constants.contract_option.key.original_ipad_cover'),
                                        'エキスパートサーバーモデル' => config('constants.contract_option.key.expert_server_model'),
                                        'タブレットサポート' => config('constants.contract_option.key.tablet_support'),
                                        'タブレット安心サポート' => config('constants.contract_option.key.tablet_relief_support'),
                                        'Play by Play Video' => config('constants.contract_option.key.play_by_play_video'),
                                        'Play by Play Videoライト' => config('constants.contract_option.key.play_by_play_video_lite'),
                                        '請求書発行サービス（電子メール）' => config('constants.contract_option.key.invoicing_service_via_email'),
                                        '領収書発行サービス（電子メール）' =>  config('constants.contract_option.key.receipt_issuance_service_via_email'),
                                    ] as $label => $val)
                                    <li>
                                        <label class="cbCustom style01">
                                            {{ $label }}
                                            <input type="checkbox" name="contract_option[]" value="{{ $val }}"
                                                @if (in_array($val, $old->contract_option)) checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('payment_method1'))
                            <span class="err">{{ $errors->get('payment_method1')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    支払い方法 1
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    @foreach ([
                                        '年払い' => config('constants.payment_method1.key.yearly'),
                                        '半年払い' => config('constants.payment_method1.key.half_yearly'),
                                        '月払い' => config('constants.payment_method1.key.monthly'),
                                    ] as $label => $val)
                                    <label class="rbCustom">
                                        {{ $label }}
                                        <input type="radio" name="payment_method1" value="{{ $val }}"
                                            @if ($old->payment_method1 == $val) checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('payment_method2'))
                            <span class="err">{{ $errors->get('payment_method2')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    支払い方法 2
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex">
                                    @foreach ([
                                        'クレジットカード' => config('constants.payment_method2.key.credit_card'),
                                        '銀行口座自動振替' => config('constants.payment_method2.key.automatic_bank_transfer'),
                                        '銀行振込' => config('constants.payment_method2.key.bank_transfer'),
                                    ] as $label => $val)
                                    <label class="rbCustom">
                                        {{ $label }}
                                        <input type="radio" name="payment_method2" value="{{ $val }}"
                                            @if ($old->payment_method2 == $val) checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section03">
                    <h3 class="headline8">第二連絡先</h3>
                    <ul class="form">
                        <li>
                            @if ($errors->has('contact2_name'))
                            <span class="err">{{ $errors->get('contact2_name')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">担当者名</p>
                                <input type="text" name="contact2_name" placeholder="例）山田太郎" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="contact2NameInput"
                                    value="{{ $old->contact2_name }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('contact2_name_furigana'))
                            <span class="err">{{ $errors->get('contact2_name_furigana')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">担当者名(フリガナ)</p>
                                <input type="text" name="contact2_name_furigana" placeholder="例）ヤマダタロウ" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="contact2NameFuriganaInput"
                                    value="{{ $old->contact2_name_furigana }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('contact2_email'))
                            <span class="err">{{ $errors->get('contact2_email')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">メールアドレス</p>
                                <input type="text" name="contact2_email" placeholder="例）info@soccer--plus.jp" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="email" id="contact2EmailInput"
                                    value="{{ $old->contact2_email }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('contact2_tel'))
                            <span class="err">{{ $errors->get('contact2_tel')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">連絡先(携帯電話)</p>
                                <input type="text" name="contact2_tel" maxlength="255"
                                    id="contact2TelInput" value="{{ $old->contact2_tel }}">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="section01">
                    <h3 class="headline8">送付先</h3>
                    <ul class="form">
                        <li>
                            @if ($errors->has('delivery_name'))
                            <span class="err">{{ $errors->get('delivery_name')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    担当者名
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="delivery_name" placeholder="例）山田太郎" maxlength="255"
                                    class="jsAutoValidateField" data-validate-type="text" id="deliveryNameInput"
                                    value="{{ $old->delivery_name }}">
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('delivery_zip'))
                            <span class="err">{{ $errors->get('delivery_zip')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    郵便番号
                                    <span class="require">必須</span>
                                </p>
                                <div class="dFlex postalCode">
                                    <input type="text" name="delivery_zip_1" maxlength="3"
                                        class="jsAutoValidateField" data-validate-type="zip_1" id="deliveryZip1Input"
                                        value="{{ $old->delivery_zip_1 }}">
                                    <span>-</span>
                                    <input type="text" name="delivery_zip_2" maxlength="4"
                                        class="jsAutoValidateField" data-validate-type="zip_2" id="deliveryZip2Input"
                                        value="{{ $old->delivery_zip_2 }}">
                                </div>
                            </div>
                        </li>
                        <li>
                            @if ($errors->has('delivery_address'))
                            <span class="err">{{ $errors->get('delivery_address')[0] }}</span>
                            @endif
                            <div class="formInput">
                                <p class="ttl">
                                    住所
                                    <span class="require">必須</span>
                                </p>
                                <input type="text" name="delivery_address" maxlength="255" placeholder="例）東京都大田区千鳥2-17-7"
                                    class="jsAutoValidateField" data-validate-type="text" id="deliveryAddressInput"
                                    value="{{ $old->delivery_address }}">
                            </div>
                        </li>
                    </ul>
                </div>
                <p class="confirmForm">
                    <label class="cbCustom style01">
                            <a href="#">
                            「プレミアムチーム」利用規約
                            </a>
                            <input type="checkbox" name="terms_checkbox" id="termsCheckbox" value="1"
                                @if ($old->terms_checkbox == "1") checked @endif>
                            <span class="checkmark"></span>
                        </label>
                    に同意する
                </p>
                <p class="center">
                    <button type="submit" class="btnStrategy jsEnableDependOn" id="confirmButton" enable-depend-on="termsCheckbox">
                        確認する
                        <span>
                            <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸右">
                        </span>
                    </button>
                </p>
            </form>
        </div>
    </div>
@endsection
