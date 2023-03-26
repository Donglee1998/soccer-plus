<div class="blockCol2">
    <p class="headline13">チームスタッツ</p>
    <table class="tblStyle04 custom">
        <tr>
            <td class="team1" style="border-left-color: yellow">{{ $team_1->goal ?? '' }}</td>
            <th class="ttl5">得点</th>
            <td class="team2" style="border-right-color: blue">{{ $team_2->goal ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->kick ?? '' }}</td>
            <th class="ttl5">シュート</th>
            <td class="team2">{{ $team_2->kick ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->kick_goal ?? '' }}</td>
            <th class="ttl5">枠内シュート</th>
            <td class="team2">{{ $team_2->kick_goal ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->assist ?? '' }}</td>
            <th class="ttl5">アシスト</th>
            <td class="team2">{{ $team_2->assist ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->last_pass ?? '' }}</td>
            <th class="ttl5">ラストパス</th>
            <td class="team2">{{ $team_2->last_pass ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->cross ?? '' }}</td>
            <th class="ttl5">クロス</th>
            <td class="team2">{{ $team_2->cross ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->pass_dribble ?? '' }}</td>
            <th class="ttl5">ドリブル成功</th>
            <td class="team2">{{ $team_2->pass_dribble ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->fouled ?? '' }}</td>
            <th class="ttl5">被ファウル</th>
            <td class="team2">{{ $team_2->fouled ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->cut_ball ?? '' }}</td>
            <th class="ttl5">カット</th>
            <td class="team2">{{ $team_2->cut_ball ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->clear ?? '' }}</td>
            <th class="ttl5">クリア</th>
            <td class="team2">{{ $team_2->clear ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->block ?? '' }}</td>
            <th class="ttl5">ブロック</th>
            <td class="team2">{{ $team_2->block ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->foul ?? '' }}</td>
            <th class="ttl5">ファウル</th>
            <td class="team2">{{ $team_2->foul ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->second_ball ?? '' }}</td>
            <th class="ttl5">こぼれ球奪取</th>
            <td class="team2">{{ $team_2->second_ball ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->is_pa ?? '' }}</td>
            <th class="ttl5">PA侵入数</th>
            <td class="team2">{{ $team_2->is_pa ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->penalty_golf ?? '' }}</td>
            <th class="ttl5">ゴールキック</th>
            <td class="team2">{{ $team_2->penalty_golf ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->corner_kick ?? '' }}</td>
            <th class="ttl5">コーナーキック</th>
            <td class="team2">{{ $team_2->corner_kick ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->free_kick ?? '' }}</td>
            <th class="ttl5">フリーキック(直接フリーキック)</th>
            <td class="team2">{{ $team_2->free_kick ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->pk ?? '' }}</td>
            <th class="ttl5">PK</th>
            <td class="team2">{{ $team_2->pk ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->tackle_overhead_home ?? '' }}</td>
            <th class="ttl5">自陣空中戦勝利</th>
            <td class="team2">{{ $team_2->tackle_overhead_home ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->tackle_overhead_guest ?? '' }}</td>
            <th class="ttl5">敵陣空中戦勝利</th>
            <td class="team2">{{ $team_2->tackle_overhead_guest ?? '' }}</td>
        </tr>
        <tr>
            <td class="team1">{{ $team_1->save ?? '' }}</td>
            <th class="ttl5">セーブ</th>
            <td class="team2">{{ $team_2->save ?? '' }}</td>
        </tr>
    </table>
</div>
