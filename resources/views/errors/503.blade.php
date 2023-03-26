<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>サッカープラス - Soccer-Plus -</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/style.min.css') }}">
    @stack('css')
    @stack('js')
</head>
<body>
    <div id="wrapper">
        <main id="main">
            <div class="teaserContainer">
                <div class="teaserContent">
                    <div class="teaserHead">
                        <h1 class="logo"><img src="/assets/img/svg/logo.svg" alt="SOCCER PLUS"></h1>
                    </div>
                    <div class="info">
                        <p class="ttl">
                            <img src="/assets/img/teaser/txt01_teaser.svg" alt="">
                        </p>
                        <p class="date"><span>2023</span>年<span>4</span>月<span>1</span>日公開予定</p>
                        <p class="copyright">
                            <img src="/assets/img/teaser/txt03_teaser.svg" alt="">
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ get_file_version('/assets/js/bundle.min.js') }}"></script>
</body>
</html>
