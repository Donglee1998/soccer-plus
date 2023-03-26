<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ @$title }}｜サッカープラス - Soccer-Plus -</title>
    @include('web.includes.meta')
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/style.min.css') }}">
    @stack('css')
    @stack('js')
</head>
<body class="{{ @$pageName }}">
@if(Auth::guard('web')->check())
    <div id="wrapper" class="twoCol">
        @include('web.includes.header')
        <main id="main" class="innerMain">
            @include('web.includes.breadcrumb')
            @yield("content")
            @include('web.includes.footer')
        </main>
    </div>
@else
    <div id="wrapper">
        @include('web.includes.header2')
        <main id="main">
            @include('web.includes.breadcrumb')
            @yield("content")
            @include('web.includes.footer')
        </main>
    </div>
@endif
    @php
    $app_config = (object) [
        'AWS_URL' => config('filesystems.disks.s3.url'),
    ];
    @endphp
    <script>
        document.app_config = JSON.parse(decodeURIComponent('{{ rawurlencode(json_encode($app_config)) }}'));
    </script>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>
