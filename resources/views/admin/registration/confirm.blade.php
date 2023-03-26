@extends('admin.layouts.default', ['title' => '申し込み 詳細/編集'])

@section('content')

    <section class="section">
        <h2 class="headline headlineFix mb20"><span>申し込み 詳細/編集</span></h2>
        <x-admin.admin-form-errors :errors="$errors"/>
        <x-admin.admin-form-confirm  method="post" action="{{ route('admin.registration.store', ['id' => isset($data['id']) ? $data['id'] : '']) }}" btn-submit="保存する">
            <table class="sheet mb20">
                <td class="headline2 mt10 pa10" colspan="2"> <strong><span class="square">■</span> チーム</strong> </td>
                @if (isset($data['id']))
                    <tr class="titleTxt " >
                        <th class="left " >ID</th>
                        <td>{{ $data['id'] }}</td>
                    </tr>
                @endif
                <input type="text" hidden name="data[id]" :value="old('data.id', $data['id'])">
                <input type="text" hidden name="data[admin][id]" value="{{old('data.admin.id', $data['admin']['id'] ?? '')}}">
                <input type="text" hidden name="data[viewer][id]" value="{{old('data.viewer.id', $data['viewer']['id'] ?? '')}}">
                <x-admin.admin-form-confirm-field label="チーム代表者氏名" require="true" name="data[name]" :value="old('data.name', $data['name'])"/>
                <x-admin.admin-form-confirm-field label="チーム代表者氏(フリガナ)" require="true" name="data[name_furigana]" :value="old('data.name_furigana', $data['name_furigana'])"/>
                <x-admin.admin-form-confirm-field label="メールアドレス" require="true" name="data[registration_email]" :value="old('data.registration_email', $data['registration_email'])"/>
                <x-admin.admin-form-confirm-field label="団体名" require="true" name="data[corp_name]" :value="old('data.corp_name', $data['corp_name'])"/>
                <x-admin.admin-form-confirm-field label="団体名(フリガナ)" require="true" name="data[corp_name_furigana]" :value="old('data.corp_name_furigana', $data['corp_name_furigana'])"/>
                <x-admin.admin-form-confirm-field label="郵便番号" type="zip" require="true" name="data[zip]" :value="old('data.zip', $data['zip'])"/>
                <x-admin.admin-form-confirm-field label="ご住所" require="true" name="data[address]" :value="old('data.address', $data['address'])"/>
                <x-admin.admin-form-confirm-field label="お電話番号" require="true" name="data[tel]" :value="old('data.tel', $data['tel'])"/>

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 担当者情報</strong></td>
                <x-admin.admin-form-confirm-field label="担当者名" require="true" name="data[pic_name]" :value="old('data.pic_name', $data['pic_name'])"/>
                <x-admin.admin-form-confirm-field label="担当者名(フリガナ)" require="true" name="data[pic_name_furigana]" :value="old('data.pic_name_furigana', $data['pic_name_furigana'])"/>
                <x-admin.admin-form-confirm-field label="メールアドレス" require="true" name="data[pic_email]" :value="old('data.pic_email', $data['pic_email'])"/>
                <x-admin.admin-form-confirm-field label="連絡先(携帯電話)" require="true" name="data[pic_mobile]" :value="old('data.pic_mobile', $data['pic_mobile'])"/>
                <x-admin.admin-form-confirm-field label="生年月日" require="true" name="data[pic_birthday]" :value="old('data.pic_birthday', $data['pic_birthday'])"/>
                <x-admin.admin-form-confirm-field label="性別" type="radio" require="true" name="data[pic_gender]" :value="old('data.pic_gender', $data['pic_gender'] ?? '')" :option="config('constants.gender.label')"/>
                <x-admin.admin-form-confirm-field label="郵便番号" type="zip" require="true" name="data[pic_zip]" :value="old('data.pic_zip', $data['pic_zip'])"/>
                <x-admin.admin-form-confirm-field label="住所" require="true" name="data[pic_address]" :value="old('data.pic_address', $data['pic_address'])"/>
                <x-admin.admin-form-confirm-field label="お電話番号" require="true" name="data[pic_tel]" :value="old('data.pic_tel', $data['pic_tel'])"/>
                <tr class="titleTxt">
                <th class="left w20">プレミアム契約<span class="red">[必須]</span></th>
                <td>
                    <p>
                    1台名
                    @foreach(config('constants.contract_premium1.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium1]" value="{{ $key }}" {{ $key == old('data.contract_premium1', @$data['contract_premium1']) ? 'checked' : '' }} class="noDisplay">
                        <label>{{ $key == old('data.contract_premium1', @$data['contract_premium1']) ? '［◉］' : '［　］' }} {{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                    <p>
                    2台名
                     @foreach(config('constants.contract_premium2.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium2]" value="{{ $key }}" {{ $key == old('data.contract_premium2', @$data['contract_premium2']) ? 'checked' : '' }} class="noDisplay">
                        <label>{{ $key == old('data.contract_premium2', @$data['contract_premium2']) ? '［◉］' : '［　］' }} {{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                    <p>
                    3台名
                     @foreach(config('constants.contract_premium3.label') as $key => $val)
                    <span class="radio contractPremium">
                        <input type="radio" name="data[contract_premium3]" value="{{ $key }}" {{ $key == old('data.contract_premium3', @$data['contract_premium3']) ? 'checked' : '' }} class="noDisplay">
                        <label>{{ $key == old('data.contract_premium3', @$data['contract_premium3']) ? '［◉］' : '［　］' }} {{ $val }}</label>
                    </span>
                    @endforeach
                    </p>
                </td>
            </tr>
                <x-admin.admin-form-confirm-field label="オプション契約" name="data[contract_option]" :value="old('data.contract_option', @$data['contract_option'])" type="checkbox" :option="config('constants.contract_option.label')"/>
                <x-admin.admin-form-confirm-field label="支払い方法1" require="true" name="data[payment_method1]" :value="old('data.payment_method1', $data['payment_method1'] ?? '')" type="radio" :option="config('constants.payment_method1.label')"/>
                <x-admin.admin-form-confirm-field label="支払い方法2" require="true" name="data[payment_method2]" :value="old('data.payment_method2', $data['payment_method2']?? '')" type="radio" :option="config('constants.payment_method2.label')"/>

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 第二連絡先</strong></td>

                <x-admin.admin-form-confirm-field label="担当者姓" name="data[contact2_name]" :value="old('data.contact2_name', $data['contact2_name'])" />
                <x-admin.admin-form-confirm-field label="担当者名(フリガナ)" name="data[contact2_name_furigana]" :value="old('data.contact2_name_furigana', $data['contact2_name_furigana'])"/>
                <x-admin.admin-form-confirm-field label="メールアドレス" name="data[contact2_email]" :value="old('data.contact2_email', $data['contact2_email'])" />
                <x-admin.admin-form-confirm-field label="連絡先(携帯電話)" name="data[contact2_tel]" :value="old('data.contact2_tel', $data['contact2_tel'])"/>

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 送付先</strong></td>
                <x-admin.admin-form-confirm-field label="担当者名" require="true" name="data[delivery_name]" :value="old('data.delivery_name', $data['delivery_name'])" class="datepicker" />
                <x-admin.admin-form-confirm-field label="郵便番号" type="zip" require="true" name="data[delivery_zip]" :value="old('data.delivery_zip', $data['delivery_zip'])"/>
                <x-admin.admin-form-confirm-field label="住所" require="true" name="data[delivery_address]" :value="old('data.delivery_address', $data['delivery_address'])" />

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 管理者</strong></td>
                <x-admin.admin-form-confirm-field  label="メールアドレス" require="true" name="data[email]" :value="old('data.email', $data['email'])"/>
                <x-admin.admin-form-confirm-field  label="ID" require="true" name="data[username]" :value="old('data.username', $data['username'])"/>
                <x-admin.admin-form-confirm-field  label="パスワード" require="true" name="data[password]" type="password" :value="old('data.password', $data['password'])"/>

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> webユーザの管理者パスワード </strong></td>
                <x-admin.admin-form-confirm-field label="パスワード" require="true" name="data[password_confirm]" type="password" :value="old('data.password_confirm',$data['password_confirm'])"/>

                <td class="headline2 mt10 pa10" colspan="2"><strong><span class="square">■</span> 契約状況</strong></td>
                <x-admin.admin-form-confirm-field label="契約状況" require="true" name="data[contract_status]" :value="old('data.contract_status', $data['contract_status'] ?? '')" :option="config('constants.contract_status.label')" type="radio"/>
            </table>
        </x-admin-form-confirm>
    </section>
@endsection
