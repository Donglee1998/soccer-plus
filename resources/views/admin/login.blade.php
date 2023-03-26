<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="utf-8">
<meta content="width=1000" name="viewport">
<meta content="noindex,nofollow" name="robots">
<title>管理画面 | サッカープラス</title>
<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
<link rel="stylesheet" type="text/css" href="{{ get_file_version('/assets/admin/css/font-awesome.min.css') }}" media="all">
<link href="{{ get_file_version('/assets/admin/css/common.css') }}" media="all" rel="stylesheet">
<link href="{{ get_file_version('/assets/admin/css/admin.css') }}" media="all" rel="stylesheet">
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="{{ get_file_version('/assets/admin/js/admin.js') }}"></script>
<!--[if lt IE 9]>
<script src="/assets/admin/js/html5shiv-printshiv.js"></script>
<![endif]-->
</head>
<body id="pageAdminLogin">
    <div class="radius5" id="loginWrapper">
        <h2 class="mb20 center">
            <img src="/assets/admin/img/admin/logo/logo_01.png"  alt="logo_01"></a>
        </h2>
        <form action="{{ route('admin.login') }}" class="mb20" id="loginForm" method="post" name="loginForm" onsubmit="return (typeof submitted == 'undefined') ? (submitted = true) : !submitted">
            @csrf
            @if (count($errors))
            <ul class="error">
                @foreach($errors->messages() as $error)
                <li><i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ $error[0] }}</li>
                @endforeach
            </ul>
            @endif
            <p class="mb5">
                <input class="loginInput {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" placeholder="ログインID" type="text" value="">
            </p>
            <p class="mb5">
                <input class="loginInput {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="パスワード" type="password" value="" autocomplete="off">
            </p>
            <p class="mb10">
                <span class="checkbox">
                    <input {{ old('remember')=='on' ? 'checked' : '' }} type="checkbox" name="remember" id="rememberme">
                    <label for="rememberme">ログイン状態を保存する</label>
                </span>
            </p>
            <p class="submit">
                <button class="button login auto mb0" id="loginBtn" type="submit">ログイン</button>
            </p>
        </form>
    </div>
</body>
</html>
