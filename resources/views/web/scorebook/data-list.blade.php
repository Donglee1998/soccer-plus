@php
    $count_match = count($matchs);
@endphp
<div class="blockScroll {{ $count_match <= 0 ? 'of-h' : ''}}">
    @if ($count_match)
        <table class="tblList tbCenter reset02 handledCheckCtrl table_match">
            <tr>
                <th class="wid48">
                    <label class="cbCustom">
                        <input type="checkbox" class="match_checkbox_all">
                        <span class="checkmark jsCheckAll"></span>
                    </label>
                </th>
                <th class="wid125Sp95">試合日</th>
                <th class="wid95">試合種類</th>
                <th colspan="3">スコア</th>
                <th class="wid100">詳細</th>
            </tr>
            @foreach ($matchs as $match)
                @php
                    $date = strtotime($match->start_date);
                    $day = date('d', $date);
                    $month = date('m', $date);
                    $years = date('Y', $date);
                    $type_matchs = Config::get('constants.match_type.label');
                @endphp
                <tr>
                    <td class="rePadding jsChecked">
                        <label class="cbCustom">
                            <input type="checkbox" name="value_match[]" value="{{ $match->id }}" class="match_checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td class="ws-n">{{ $years }}年{{ $month }}月{{ $day }}日</td>
                    <td>{{ $type_matchs[$match->type] }}</td>
                    <td class="wb">{{ $match->team1->name ?? null }}</td>
                    <td class="wid80"><span class="fS20">{{ $match->team1_score }}-{{ $match->team2_score }}</span></td>
                    <td class="wb">{{ $match->team2->name ?? null }}</td>
                    <td>
                        <a href="{{ route('web.scorebook.matches.report', ['matches_id' => $match->id]) }}" class="btnPlay">詳細</a>
                    </td>
                </tr>
                @endforeach
        </table>
    @else
        <p class="alert">検索結果がありません。</p>
    @endif
</div>

<p class="center">
    <button id="delMatch" class="btnStrategy jsModalPassword disabled">
        チェックしたフォルダを削除
        <span>
            <img src="/assets/img/svg/ic_circle_check.svg" alt="アイコン丸チェック">
        </span>
    </button>
</p>
</form>
{!! $matchs->appends(request()->all())->links('web.commons.pagination') !!}
