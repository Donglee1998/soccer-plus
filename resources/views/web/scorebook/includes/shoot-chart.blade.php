<div class="section03">
    <h2 class="headline5 mgb40">シュートチャート</h2>
    <div class="playControl">
        <div class="item">
            <div class="groupCtrl">
                <select name="team_shoot_chart" id="team_shoot_chart" class="formControl">
                    <option value="1" class="option-team-1">自チーム</option>
                    <option value="2" class="option-team-2">相手チーム</option>
                </select>
                <select name="personal_shoot_chart" id="personal_shoot_chart" class="formControl">
                    <option value="0">全ての選手</option>
                    @foreach($member_home as $key => $value)
                    @if($value['number_official'] && ($value['first_name'] || $value['last_name']))
                        <option value="{{ $value['member_id'] }}">{{ $value['number_official'] . ' ' . $value['first_name'] . ' ' . $value['last_name'] }}</option>
                    @elseif ($value['number_official'] && !$value['first_name'] && !$value['last_name']) {
                        <option value="{{ $value['member_id'] }}">{{ $value['number_official'] . ' ?'}}</option>
                    @endif
                    @endforeach
                    <option value="-1">? 仮選手</option>
                </select>
            </div>
        </div>
    </div>
    <div class="groupOptionFilter">
        <div class="tblTime jsViewOption">
            <div class="itemHead">時間別で見る</div>
            <div class="item">
                <label class="rbCustom">
                    TOTAL
                    <input type="radio" name="round_shoot_chart" value="0" data-tab="0" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div>
            @if($match->round1_time)
            <div class="item">
                <label class="rbCustom">
                    1ST
                    <input type="radio" name="round_shoot_chart" value="1" data-tab="1">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time1">
                </div>
            </div>
            @endif
            @if($match->round2_time)
            <div class="item">
                <label class="rbCustom">
                    2ND
                    <input type="radio" name="round_shoot_chart" value="2" data-tab="2">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time2">
                </div>
            </div>
            @endif
            @if($match->round3_time)
            <div class="item">
                <label class="rbCustom">
                    3RD
                    <input type="radio" name="round_shoot_chart" value="3" data-tab="3">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time3">
                </div>
            </div>
            @endif
            @if($match->round4_time)
            <div class="item">
                <label class="rbCustom">
                    4TH
                    <input type="radio" name="round_shoot_chart" value="4" data-tab="4">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time4">
                </div>
            </div>
            @endif
            @if($match->extra_time)
            <div class="item">
                <label class="rbCustom">
                    EXT1
                    <input type="radio" name="round_shoot_chart" value="5" data-tab="5">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time5">
                </div>
            </div>
            <div class="item">
                <label class="rbCustom">
                    EXT2
                    <input type="radio" name="round_shoot_chart" value="6" data-tab="6">
                    <span class="checkmark"></span>
                </label>
                <div class="groupOption ml10" id="shoot_chart_time6">
                </div>
            </div>
            @endif
            <div class="item spNone"></div>
        </div>
    </div>
    <div class="blockScroll01 section03">
        <div class="toggleDisplay checkLstBox">
            <p class="ttl">ゴール種別 /</p>
            <p class="ckCustomBox checkNote01">
                <label class="ckCustom">
                    <input type="checkbox" name="toggle[]" checked="checked" value="goal">
                    <span class="checkmark"></span>
                    ゴール
                </label>
            </p>
            <p class="ckCustomBox checkNote02">
                <label class="ckCustom">
                    <input type="checkbox" name="toggle[]" checked="checked" value="save">
                    <span class="checkmark"></span>
                    セーブ
                </label>
            </p>
            <p class="ckCustomBox checkNote03">
                <label class="ckCustom">
                    <input type="checkbox" name="toggle[]" checked="checked" value="block">
                    <span class="checkmark"></span>
                    ブロック
                </label>
            </p>
            <p class="ckCustomBox checkNote04">
                <label class="ckCustom">
                    <input type="checkbox" name="toggle[]" checked="checked" value="out">
                    <span class="checkmark"></span>
                    枠外
                </label>
            </p>
        </div>
    </div>
    <div class="chartStatMap2">
        <p class="imgGoal"><img src="/assets/img/svg/bg_match_goal_2.svg" alt=""></p>
        <div class="wrap">
            <svg class="mapSvg" id="mapSvg">
            </svg>
            <p class="imgMap"><img src="/assets/img/svg/bg_match_2.svg" alt=""></p>
        </div>
    </div>
    <ul class="noteShoot" id="noteShoot">
    </ul>
    <p class="center">
        <a href="/preview/teams01" class="btnStrategy resetW300">
            期間別集計トップに戻る
            <span class="positionLeft">
                <img src="/assets/img/svg/ic_circle_left.svg" alt="期間別集計トップに戻る">
            </span>
        </a>
    </p>
</div>