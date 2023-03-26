import $ from 'jquery';
import {ACTION_MAP} from './constants-box-score.js';

export function filterShootChart(team, personal,rounds, data_match, data_stats, member_team_1, member_team_2) {
    var round    = document.querySelector('input[name="round_shoot_chart"]:checked').value;
    var sub_time = null;
    if (round != 0) {
    sub_time = document.querySelector('input[name="sub_time_shoot_chart"]:checked').value;
    }
    var time = null;
    if (round == 1) {
        time = data_match.round1_time;
    } else if (round == 2) {
        time = data_match.round2_time;
    } else if (round == 3) {
        time = data_match.round3_time;
    } else if (round == 4) {
        time = data_match.round4_time;
    } else if (round == 5 || round == 6) {
        time = data_match.extra_time;
    }
    var ms_in_round1 = time * 60000 / 3;
    var ms_in_round2 = time * 60000 / 3 * 2;
    //Filler action_id = 1, 46 (Kick and PK) with team
    let shootStats = data_stats.filter(function(data) {
        if (team != 2) {//Team 1
            return (data.action_id == ACTION_MAP.VALUES.KICK.id || data.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id) && jQuery.inArray(data.member_id, member_team_1) >= 0;
        } else {
            return (data.action_id == ACTION_MAP.VALUES.KICK.id || data.action_id == ACTION_MAP.VALUES.PK_FREE_KICK.id) && jQuery.inArray(data.member_id, member_team_2) >= 0;
        }
    });
    if (personal == 0) {
    shootStats = shootStats.filter(function(data) {
        if (round != 0) {
            if (data.created_at_round == rounds[round]) {
                if (sub_time == 1) {
                    return data.timer_at <= ms_in_round1;
                } else if (sub_time == 2) {
                    return data.timer_at > ms_in_round1 && data.timer_at <= ms_in_round2;
                } else if (sub_time == 3) {
                    return data.timer_at > ms_in_round2;
                } else {
                    return shootStats;
                }
            }
        } else {
            return shootStats;
        }
    });
    } else {
        shootStats = shootStats.filter(function(data) {
            if (round != 0) {
                if (data.created_at_round == rounds[round]) {
                    if (sub_time == 1) {
                        return data.timer_at <= ms_in_round1 && data.member_id == personal;
                    } else if (sub_time == 2) {
                        return data.timer_at > ms_in_round1 && data.timer_at <= ms_in_round2 && data.member_id == personal;
                    } else if (sub_time == 3) {
                        return data.timer_at > ms_in_round2 && data.member_id == personal;
                    } else {
                        return data.member_id == personal;
                    }
                }
            } else {
                return data.member_id == personal;
            }
        });
    }

    return shootStats;
}

export function analysisArrow(team, shootStats) {
    let analysis = {
        goal : 0,
        save : 0,
        block: 0,
        out  : 0,
    };
    shootStats.forEach(function (stat) {
      let goal_type  = 'goal',
          line_class = 'red',
          start_sign = 'url(#pointStartRed)',
          end_sign   = 'url(#pointEndRed)',
          coord      = {},
          shootX     = 0.0,
          shootY     = 0.0;
      if (!stat.result) {
        if (stat.ball_goal_number > 15) {
          goal_type  = 'out';
          line_class = 'gray';
          start_sign = 'url(#pointStartGray)';
          end_sign   = 'url(#pointEndGray)';
          analysis.out++;
        } else if (stat.action_kick_block_id === 2) {
          goal_type  = 'block';
          line_class = 'green';
          start_sign = 'url(#pointStartGreen)';
          end_sign   = 'url(#pointEndGreen)';
          analysis.block++;
        } else {
          goal_type  = 'save';
          line_class = 'blue';
          start_sign = 'url(#pointStartBlue)';
          end_sign   = 'url(#pointEndBlue)';
          analysis.save++;
        }
      } else {
        analysis.goal++;
      }
      
      if (stat.action_id === ACTION_MAP.VALUES.PK_FREE_KICK.id) {
        coord = {
          x1: '50%',
          y1: '40%',
          x2: getEndLeftPercent(stat),
          y2: '2%',
        };
      } else {
        shootX = team != 2 ? stat.coord_x : 100 - stat.coord_x; //Check analytic pitch with team
        shootY = team != 2 ? stat.coord_y : 100 - stat.coord_y; //Check analytic pitch with team
        coord = {
          x1: getStartLeftPercent(shootY),
          y1: getStartTopPercent(shootX),
          x2: getEndLeftPercent(stat),
          y2: '2%',
        };
      }

      if (coord.y1 === '100%') {
        start_sign          = '';
        const opposite_side = 100 - coord.x2.replace('%', '') - (100 - coord.x1.replace('%', '')),
        adjacent_side       = 100 - shootX,
        tan_acute_angle     = opposite_side / adjacent_side,
        small_adjacent_side = adjacent_side - 25,
        small_opposite_side = tan_acute_angle * small_adjacent_side;
        coord.x1            = getStartLeftPercent(shootY - small_opposite_side);
      }
      stat.shoot_goal_info = {
        goal_type,
        line_class,
        start_sign,
        end_sign,
        coord,
      };
    });
    //Find check box checked and fillter shoot chart with check box
    shootStats = fillterSortArrowWithBox(shootStats);
    analysis   = fillterSortAnalysisWithBox(shootStats);

    return getHtmlShootChart(shootStats, analysis);
}

function getStartLeftPercent(left) {
    return left + '%';
}

function getStartTopPercent(top) {
    if (top < 75) {
      top = 100;
    } else {
      top = (100 - top) * 4;
    }

    return top + '%';
}

function getMargin(ball_goal_coord_x, length) {
  let goal_coord = (ball_goal_coord_x * length) / 100,
    margin = Math.abs(goal_coord) > length ? (goal_coord > 0 ? length : 0) : goal_coord;
  return margin;
}

function getEndLeftPercent(stat) {
    let left_coord;
    if (stat.ball_goal_number <= 15) {
      left_coord = 42 + getMargin(stat.ball_goal_coord_x, 16);
    } else if (stat.ball_goal_type === 0) {
      left_coord = 38.5 + getMargin(stat.ball_goal_coord_x, 23);
    } else if (stat.ball_goal_number === 16) {
      left_coord = 42;
    } else if (stat.ball_goal_number === 17) {
      left_coord = 42 + getMargin(stat.ball_goal_coord_x, 8);
    } else if (stat.ball_goal_number === 18) {
      left_coord = 50 + getMargin(stat.ball_goal_coord_x, 8);
    } else if (stat.ball_goal_number === 19) {
      left_coord = 58;
    }

    return left_coord + '%';
}

function getHtmlShootChart(shootStats, analysis) {
    //Append html for analysis shoot
    let noteShoot  = `<li class="line01">ゴール：<span>${analysis.goal}本</span></li>
    <li class="line02">セーブ：<span>${analysis.save}本</span></li>
    <li class="line03">ブロック：<span>${analysis.block}本</span></li>
    <li class="line04">枠外：<span>${analysis.out}本</span></li>`;
    $('#noteShoot').html(noteShoot);
    //Append html for arrow shhot
    let htmlMapSvgLine = '';
    let htmlMapSvgDefs = `<defs>
    <marker id="pointStartGray" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
        <circle cx="4" cy="4" r="2" stroke="#CCC" fill="#CCC"></circle>
    </marker>
    <marker id="pointEndGray" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
        <path d="M 0 2 L 10 5 L 0 8 z" stroke="#CCC" fill="#CCC"></path>
    </marker>
    <marker id="pointStartGreen" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
        <circle cx="4" cy="4" r="2" stroke="#9BF237" fill="#9BF237"></circle>
    </marker>
    <marker id="pointEndGreen" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
        <path d="M 0 2 L 10 5 L 0 8 z" stroke="#9BF237" fill="#9BF237"></path>
    </marker>
    <marker id="pointStartBlue" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
        <circle cx="4" cy="4" r="2" stroke="#37B7F0" fill="#37B7F0"></circle>
    </marker>
    <marker id="pointEndBlue" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
        <path d="M 0 2 L 10 5 L 0 8 z" stroke="#37B7F0" fill="#37B7F0"></path>
    </marker>
    <marker id="pointStartRed" markerWidth="4" markerHeight="4" viewBox="0 0 8 8" refX="5" refY="4" markerUnits="strokeWidth" orient="auto">
        <circle cx="4" cy="4" r="2" stroke="#FF6565" fill="#FF6565"></circle>
    </marker>
    <marker id="pointEndRed" markerWidth="4" markerHeight="2.8" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" orient="auto">
        <path d="M 0 2 L 10 5 L 0 8 z" stroke="#FF6565" fill="#FF6565"></path>
    </marker>
</defs>`;

    $.each(shootStats, function(index, value) {
      let data = value.shoot_goal_info;
      htmlMapSvgLine += `<line class="${data.line_class}" x1="${data.coord.x1}" y1="${data.coord.y1}" x2="${data.coord.x2}" y2="${data.coord.y2}" marker-end="${data.end_sign}" marker-start="${data.start_sign}"/>`;
    });
    $('#mapSvg').html(htmlMapSvgDefs + htmlMapSvgLine);
}

function fillterSortArrowWithBox(shootStats) {
  let checkboxState = $("input[name='toggle[]']:checked").map(function(){
    return $(this).val();
  }).get();

  return shootStats.filter(function(data) {
    return jQuery.inArray(data.shoot_goal_info.goal_type, checkboxState) >= 0;
  });
}

function fillterSortAnalysisWithBox(shootStats) {
  let analysis = {
    goal : 0,
    save : 0,
    block: 0,
    out  : 0,
  };
  shootStats.forEach(function (stat) {
    if (!stat.result) {
      if (stat.ball_goal_number > 15) {
        analysis.out++;
      } else if (stat.action_kick_block_id === 2) {
        analysis.block++;
      } else {
        analysis.save++;
      }
    } else {
      analysis.goal++;
    }
  });
  
  return analysis;
}
