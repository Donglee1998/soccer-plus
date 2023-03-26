<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" lang="ja" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>試合レポートPDF｜サッカープラス - Soccer-Plus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Lato:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/style.min.css') }}">
</head>
<body class="pageReport">
    {{-- 001 --}}
    @include('web.pdf_report.kickball_changeplayers', ['data_001' => $kick_ball_change_players])
    {{-- 002 --}}
    @include('web.pdf_report.ballcontrolpercentage_teamstats', [
        'match'             => $match,
        'round'             => $round,
        'ball_control_rate' => $ball_control_rate,
        'starting1'         => $starting1,
        'substitute1'       => $substitute1,
        'starting2'         => $starting2,
        'substitute2'       => $substitute2,
        'team_1'            => $team_1,
        'team_2'            => $team_2,
        'comment'           => $comment
    ])
    {{-- 003 --}}
    @include('web.pdf_report.startinglineup_verticalchart', ['data_003' => $starting_line_up_vertical_charts])
    {{-- 004 --}}
    @include('web.pdf_report.analysischart_hometeam', ['data_004' => $analysis_chart_teams])
    {{-- 005 --}}
    @include('web.pdf_report.analysischart_awayteam', ['data_004' => $analysis_chart_teams])
</body>
<script>
    window.onload = function() { window.print(); }
</script>
</html>
