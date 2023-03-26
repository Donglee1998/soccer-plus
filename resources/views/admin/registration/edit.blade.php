@php
    $title = '申し込み 詳細/編集';
@endphp
@extends('admin.layouts.default', ['title' => $title])

@section('content')
<section class="section">
    <h2 class="headline headlineFix mb20"><span>{{ $title }}</span></h2>
    <x-admin.admin-form-errors :errors="$errors" />
    <x-admin.admin-form method="post" showBtnSubmit='hidden'>
        <table class="sheet mb20" id="registration">
            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> チーム情報</strong></td>
            <tr class="titleTxt " >
                <th class="left ">ID</th>
                <td>{{ $data['id'] ?? '' }}</td>
            </tr>
            <input type="text" hidden name="data[id]" value="{{old('data.id', $data['id'] ?? '')}}">
            <input type="text" hidden name="data[admin][id]" value="{{old('data.admin.id', $data['admin']['id'] ?? '')}}">
            <input type="text" hidden name="data[viewer][id]" value="{{old('data.viewer.id', $data['viewer']['id'] ?? '')}}">
            <x-admin.admin-form-text label="チーム代表者氏名" require="true" name="data[name]" :value="old('data.name', @$data['name'])"/>
            <x-admin.admin-form-text label="チーム代表者氏(フリガナ)" require="true" name="data[name_furigana]" :value="old('data.name_furigana', @$data['name_furigana'])"/>
            <x-admin.admin-form-text label="メールアドレス" require="true" name="data[registration_email]" :value="old('data.registration_email', @$data['registration_email'])"/>
            <x-admin.admin-form-text label="団体名" require="true" name="data[corp_name]" :value="old('data.corp_name', @$data['corp_name'])"/>
            <x-admin.admin-form-text label="団体名(フリガナ)" require="true" name="data[corp_name_furigana]" :value="old('data.corp_name_furigana', @$data['corp_name_furigana'])"/>
            <x-admin.admin-form-text label="郵便番号" require="true" name="data[zip]" :value="old('data.zip', @$data['zip'])"/>
            <x-admin.admin-form-text label="ご住所" require="true" name="data[address]" :value="old('data.address', @$data['address'])"/>
            <x-admin.admin-form-text label="お電話番号" require="true" name="data[tel]" :value="old('data.tel', @$data['tel'])"/>

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 担当者情報</strong></td>
            <x-admin.admin-form-text label="担当者名" require="true" name="data[pic_name]" :value="old('data.pic_name', @$data['pic_name'])"/>
            <x-admin.admin-form-text label="担当者名(フリガナ)" require="true" name="data[pic_name_furigana]" :value="old('data.pic_name_furigana', @$data['pic_name_furigana'] ?? '')"/>
            <x-admin.admin-form-text label="メールアドレス" require="true" name="data[pic_email]" :value="old('data.pic_email', @$data['pic_email'])"/>
            <x-admin.admin-form-text label="連絡先(携帯電話)" require="true" name="data[pic_mobile]" :value="old('data.pic_mobile', @$data['pic_mobile'])"/>
            <x-admin.admin-form-text label="生年月日" require="true" name="data[pic_birthday]" :value="old('data.pic_birthday', @$data['pic_birthday'])" class="datepicker"/>
            <x-admin.admin-form-radio label="性別" require="true" name="data[pic_gender]" :value="old('data.pic_gender', @$data['pic_gender'])" :option="config('constants.gender.label')"/>
            <x-admin.admin-form-text label="郵便番号" require="true "  name="data[pic_zip]" :value="un_format_zip(old('data.pic_zip', @$data['pic_zip']))"/>
            <x-admin.admin-form-text label="住所" require="true"  name="data[pic_address]"  :value="old('data.pic_address', @$data['pic_address'])"/>
            <x-admin.admin-form-text label="お電話番号" require="true" name="data[pic_tel]" :value="old('data.pic_tel', @$data['pic_tel'])"/>
            <tr class="titleTxt">
                <th class="left w20">プレミアム契約<span class="red">[必須]</span></th>
                <td>
                    <p>
                    1台名
                    @foreach(config('constants.contract_premium1.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium1]" value="{{ $key }}" id="contract_premium1_{{ $key }}" {{ $key == old('data.contract_premium1', @$data['contract_premium1']) ? 'checked' : '' }}>
                        <label for="contract_premium1_{{ $key }}">{{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                    <p>
                    2台名
                    @foreach(config('constants.contract_premium2.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium2]" value="{{ $key }}" id="contract_premium2_{{ $key }}" {{ $key == old('data.contract_premium2', @$data['contract_premium2']) ? 'checked' : '' }}>
                        <label for="contract_premium2_{{ $key }}">{{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                    <p>
                    3台名
                    @foreach(config('constants.contract_premium3.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium3]" value="{{ $key }}" id="contract_premium3_{{ $key }}" {{ $key == old('data.contract_premium3', @$data['contract_premium3']) ? 'checked' : '' }}>
                        <label for="contract_premium3_{{ $key }}">{{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                </td>
            </tr>
            <x-admin.admin-form-checkbox label="オプション契約" name="data[contract_option]" :value="old('data.contract_option', @$data['contract_option'])" :option="config('constants.contract_option.label')" class="contractOption"/>
            <x-admin.admin-form-radio label="支払い方法 1" require="true" name="data[payment_method1]" :value="old('data.payment_method1', @$data['payment_method1'])" :option="config('constants.payment_method1.label')"/>
            <x-admin.admin-form-radio label="支払い方法 2" require="true" name="data[payment_method2]" :value="old('data.payment_method2', @$data['payment_method2'])" :option="config('constants.payment_method2.label')"/>

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 第二連絡先</strong></td>
            <x-admin.admin-form-text label="担当者姓" name="data[contact2_name]" :value="old('data.contact2_name', @$data['contact2_name'])"/>
            <x-admin.admin-form-text label="担当者名(フリガナ)" name="data[contact2_name_furigana]" :value="old('data.contact2_name_furigana', @$data['contact2_name_furigana'])"/>
            <x-admin.admin-form-text label="メールアドレス" name="data[contact2_email]" :value="old('data.contact2_email', @$data['contact2_email'])"/>
            <x-admin.admin-form-text label="連絡先(携帯電話)" name="data[contact2_tel]" :value="old('data.contact2_tel', $data['contact2_tel'] ?? '')"/>

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 送付先</strong></td>
            <x-admin.admin-form-text label="担当者名" require="true" name="data[delivery_name]" :value="old('data.delivery_name', @$data['delivery_name'])"/>
            <x-admin.admin-form-text label="郵便番号" require="true" name="data[delivery_zip]" :value="old('data.delivery_zip',@$data['delivery_zip'])"/>
            <x-admin.admin-form-text label="住所" require="true" name="data[delivery_address]" :value="old('data.delivery_address', @$data['delivery_address'])"/>

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 管理者</strong></td>
            <x-admin.admin-form-text label="メールアドレス" require name="data[email]" :value="old('data.email', @$data['email'])"  />
            <x-admin.admin-form-text label="ID" require name="data[username]" :value="old('data.username', @$data['username'])"/>
            <x-admin.admin-form-text label="パスワード" require="true" name="data[password]" type="password" :value="old('data.password')" :attribute="['old_pass' => $data['password']]"/>

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> webユーザの管理者パスワード </strong></td>
            <x-admin.admin-form-text label="パスワード" require="true" name="data[password_confirm]" type="password" :value="old('data.password_confirm')" :attribute="['old_pass' => $data['password_confirm']]" />

            <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 契約状況</strong></td>
            <x-admin.admin-form-radio label="契約状況" require="true" name="data[contract_status]" :value="old('data.contract_status', @$data['contract_status'])" :option="config('constants.contract_status.label')"/>
        </table>
        <div class="dFlex center">
            <button type="submit" onclick="this.form.action='{{ route('admin.registration.confirm', ['id' => @$data['id']]) }}'" name="submit" value="confirm" data-action="save" id="buttonSubmit" class="auto button inlineBlock blue2 mb0">確認画面へ</button>
            @if(@$data['id'])
                <button type="button" data-url="{{ route('admin.registration.trash', ['id' => $data['id']]) }}" data-action="trash" class="auto button inlineBlock gray2 mb0">削除</button>
            @endif
        </div>
    </x-admin.admin-form>
</section>
@endsection
@push('script')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/registration.js') }}"></script>
    <script type="module" src="{{ get_file_version('/assets/admin/js/views/showpass.js') }}"></script>
@endpush
