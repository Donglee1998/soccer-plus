■ フォーム内容

・お名前
{{ $contact->name }}

・メールアドレス
{{ $contact->email }}

・所属チーム
{{ $contact->team }}

・お問い合わせ目的
{{ !empty($contact->purpose) ? config('constants.contact.purpose.label.' . $contact->purpose) : '' }}
@if ($contact->purpose == config('constants.contact.purpose.key.app_using'))

・ご利用アプリ
{{ !empty($contact->app_type) ? config('constants.contact.app_type.label.' . $contact->app_type) : '' }}
@endif

・お問い合わせ内容
{{ $contact->content }}
