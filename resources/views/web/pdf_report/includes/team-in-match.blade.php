<div class="tblStyle03 blockScroll02">
    <table>
        <tr>
            <td class="ttl1 wCol1" rowspan="{{ count($round['stat_score']) + 1 }}">{{ $round['team1'] }}</td>
            <td class="ttl3 wCol2" rowspan="{{ count($round['stat_score']) + 1 }}">{{ $round['team1_score'] }}</td>
            <td class="txt1 wCol3 emptyCell"></td>
            <td class="txt3 wCol4 emptyCell"></td>
            <td class="txt1 wCol3 emptyCell"></td>
            <td class="ttl3 wCol2" rowspan="{{ count($round['stat_score']) + 1 }}">{{ $round['team2_score'] }}</td>
            <td class="ttl1 wCol1" rowspan="{{ count($round['stat_score']) + 1 }}">{{ $round['team2'] }}</td>
        </tr>
        @foreach ($round['stat_score'] as $key => $value)
            @if ($key != '_PK')
            <tr>
                <td class="txt1">{{ $value['team1'] }}</td>
                <td class="txt3">{{ str_replace('_', '', $key) }}</td>
                <td class="txt1">{{ $value['team2'] }}</td>
            </tr>
            @else
            <tr>
                <td class="txt1 highlight">{{ $value['team1'] }}</td>
                <td class="txt3">{{ str_replace('_', '', $key) }}</td>
                <td class="txt1 highlight">{{ $value['team2'] }}</td>
            </tr>
            @endif
        @endforeach
        <tr class="custom">
            <td colspan="2">
                <ul class="listTxt1">
                    @if (!empty($round['stat_goals_team1']))
                        @foreach ($round['stat_goals_team1'] as $value)
                        <li>
                            <p class="ttl">{{ $value['round'] }}：{{ Carbon\Carbon::createFromFormat('i:s', $value['time'])->format('i') }}分</p>
                            <p class="txt">{{ $value['name'] }}@if(!is_null($value['sub_name'] ?? null)){{ $value['sub_name'] ? ' / AST：' . $value['sub_name'] : '' }}@endif</p>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </td>
            <td colspan="3" class="ttl2">得点者</td>
            <td colspan="2">
                <ul class="listTxt2">
                    @if (!empty($round['stat_goals_team2']))
                        @foreach ($round['stat_goals_team2'] as $value)
                        <li>
                            <p class="ttl">{{ $value['round'] }}：{{ Carbon\Carbon::createFromFormat('i:s', $value['time'])->format('i') }}分</span>
                            <p class="txt">{{ $value['name'] }}{{ @$value['sub_name'] ? ' / AST：' . $value['sub_name'] : '' }}</p>
                        </li>
                        @endforeach
                    @endif
                    </ul>
            </td>
        </tr>
    </table>
</div>
