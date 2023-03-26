<table class="tblStyle04">
    <tr>
        <th class="ttl1" colspan="3">出場選手</th>
    </tr>
    @include('web.pdf_report.includes.teams', ['starting_substitute' => $starting])
    <tr>
        <th class="ttl1" colspan="3">リザーブ</th>
    </tr>
    @include('web.pdf_report.includes.teams', ['starting_substitute' => $substitute])
</table>
