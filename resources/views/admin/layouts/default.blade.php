<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=1000">
<meta name="robots" content="noindex,nofollow">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ @$title }}｜{{ config('constants.site_title') }}</title>
<!-- Stylesheet -->
<link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/common.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/admin.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/font-awesome.min.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/formValidator/validationEngine.jquery.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/formValidator/validationTemplate.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/jquery.toast.min.css') }}" media="all">
<link rel="stylesheet" href="{{ get_file_version('/assets/admin/css/colorbox.css') }}" media="all">
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css">
@stack('css')
<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=false"></script>
<script src="/assets/admin/js/formValidator/jquery.validationEngine.js"></script>
<script src="/assets/admin/js/formValidator/jquery.validationEngine-ja.js"></script>
<script src="/assets/admin/js/jquery.colorbox.js"></script>
<script src="/assets/admin/js/jquery.toast.min.js"></script>
<script src="/assets/admin/js/jquery.cookie.min.js"></script>
<script src="{{ get_file_version('/assets/admin/js/script.js') }}"></script>
<script src="{{ get_file_version('/assets/admin/js/admin.js') }}"></script>
@stack('js')
<!--[if lt IE 9]>
<script src="/js/html5shiv-printshiv.js"></script>
<![endif]-->
</head>
<body id="pageAdminHome">
<noscript>
    <p id="noScript">JavaScriptが無効です。正しくサイトを表示するためには、JavaScriptを有効にする必要があります。</p>
</noscript>


<div id="wrapper">
    <div id="container">
        @include('admin.includes.header')
        <!-- / #header -->

        <div id="contents" class="clearfix">
            <div id="main">
                @yield('breadcrumb')
                <!-- / .breadcrumbs -->

                @yield("content")

                <p id="pageTop" class="pageTop"><a href="#wrapper">ページの先頭へ</a></p>
            <!-- / #content -->
            </div>
            <!-- / #main -->

            @include('admin.includes.nav')
            <!-- / #side -->
        </div>
        <!-- / #contents -->
        <div id="footer">
            <small>COPYRIGHT &copy; CYBRiDGE CORPORATION. ALL RIGHTS RESERVED.</small>
        </div>
    </div>
    <!-- / #container -->
</div>
<!-- / #wrapper -->
@stack('script')
</body>
</html>
