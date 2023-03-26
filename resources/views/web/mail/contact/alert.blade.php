【アラートメール】
フォームお問い合わせからデータベースへの保存に失敗しました。

詳細は以下になります。

■発生時間
{{ date('Y/m/d H:i:s') }}

■テーブル名
{{ $table }}

■URL
{{ $url }}

■Error
{{ $error_message }}

■Session data
@foreach ($session_data as $key => $val)
・{{ $key }}
{{ $val }}

@endforeach
