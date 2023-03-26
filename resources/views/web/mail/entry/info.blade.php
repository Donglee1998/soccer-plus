■ フォーム内容

【チーム情報】

・チーム代表者氏名
{{ $entry->name }}

・チーム代表者氏名(フリガナ)
{{ $entry->name_furigana }}

・メールアドレス
{{ $entry->registration_email }}

・団体名
{{ $entry->corp_name }}

・団体名(フリガナ)
{{ $entry->corp_name_furigana }}

・郵便番号
{{ $entry->zip }}

・ご住所
{{ $entry->address }}

・お電話番号
{{ $entry->tel }}

【担当者情報】

・担当者名
{{ $entry->pic_name }}

・担当者名(フリガナ)
{{ $entry->pic_name_furigana }}

・メールアドレス
{{ $entry->pic_email }}

・連絡先(携帯電話)
{{ $entry->pic_mobile }}

・生年月日
{{ $entry->pic_birthday }}

・性別
{{ config('constants.pic_gender.label.' .  $entry->pic_gender) }}

・郵便番号
{{ $entry->pic_zip }}

・住所
{{ $entry->pic_address }}

・お電話番号
{{ $entry->pic_tel }}

・プレミアム契約
1台目　{{ !empty($entry->contract_premium1) ? config('constants.contract_premium1.label.' . $entry->contract_premium1) : 'なし' }}
2台目　{{ !empty($entry->contract_premium2) ? config('constants.contract_premium2.label.' . $entry->contract_premium2) : 'なし' }}
3台目　{{ !empty($entry->contract_premium3) ? config('constants.contract_premium3.label.' . $entry->contract_premium3) : 'なし' }}

・オプション契約
@php
$option_labels = [];
foreach (json_decode($entry->contract_option, true) as $option_key) {
    $option_labels[] = config('constants.contract_option.label.' . $option_key);
}
@endphp
{{ implode('、', $option_labels) }}

・支払い方法 1
{{ config('constants.payment_method1.label.' . $entry->payment_method1) }}

・支払い方法 2
{{ config('constants.payment_method2.label.' . $entry->payment_method2) }}

【第二連絡先】

・担当者名
{{ $entry->contact2_name }}

・担当者名(フリガナ)
{{ $entry->contact2_name_furigana }}

・メールアドレス
{{ $entry->contact2_email }}

・連絡先(携帯電話)
{{ $entry->contact2_tel }}

【送付先】

・担当者名
{{ $entry->delivery_name }}

・郵便番号
{{ $entry->delivery_zip }}

・住所
{{ $entry->delivery_address }}
