import $ from 'jquery';
import moment from 'moment'
import DataTable from 'datatables.net';
import Log from 'laravel-mix/src/Log';
import 'datatables.net-fixedcolumns';
import {chartConfig} from './components/chart.js';
import {BOX_SCORE_TEAM_COLUMN_NAME, BOX_SCORE_PERSONAL_COLUMN_NAME, ACTION_MAP} from './constants-box-score.js';
import {boxScoreTeamNumber} from './box-scores.js';
import {filterShootChart, analysisArrow} from './filter-shoot-chart.js';

// ---------------------------------------------------------
// Custom Functions for Back-End
// ---------------------------------------------------------
$(document).ready(function() {
  // Dev Code
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    let data_listGlobal= '';
  if (window.current_page == 'period_aggregation_index') {
        $("#check").click(function(){
          $('#errors').empty()
          $('#groups').empty()
          var date_from = document.querySelector("input[name=date_from]").value;
          var date_to = document.querySelector("input[name=date_to]").value;
          date_from = format_date(date_from);
          date_to = format_date(date_to);
          var params = {
              date_from  : date_from,
              date_to : date_to,
              team : document.querySelector("select[name=team]").value,
              type : document.querySelector("select[name=type]").value,
          };
          $.ajax({
            url: "/period_aggregation/period_stat/check",
            type: "post",
            data: params,
            success: function(response) {
              if (response.count) {
                $('#groups').append(`<a class="btnStrategy" id="stat">
                      スタッツを見る
                      <span>
                          <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸チェック">
                      </span>
                  </a>
                  <a class="btnStrategy" id="chart">
                      シュートチャートを見る
                      <span>
                          <img src="/assets/img/svg/ic_circle_right.svg" alt="アイコン丸チェック">
                      </span>
                  </a>`
                );
              } else {
                $("#errors").append(`<li>検索結果がありません。</li>`);
              }
            },
            error: function(err) {
              var html = '';
              $.each(err.responseJSON.errors, function (key, val) {
                  html = html + '<li>'+val+'</li>'
              });
              $("#errors").append(html);
            }
          });
        });
        function format_date(date) {
          if (date == '') {
            return '';
          }else {
            var year = date.substring(0, 4);
            var month = date.substring(5, 7);
            var day = date.substring(8, 10);
            var date = year + "/" + month + "/" + day;

            return date;
          }
        }

        $('body').on('click', '#stat', function(){
            $('#errors').empty()
            var date_from = document.querySelector("input[name=date_from]").value;
            var date_to = document.querySelector("input[name=date_to]").value;
            if(date_from.length != 11 || date_to.length != 11) {
              $("#errors").append(`<li>期間を入力してください。</li>`);
            } else {
              date_from = format_date(date_from);
              date_to = format_date(date_to);
              var params = {
                  date_from  : date_from,
                  date_to : date_to,
                  team : document.querySelector("select[name=team]").value,
                  type : document.querySelector("select[name=type]").value,
              };
              $.ajax({
                url: "/period_aggregation/period_stat/check",
                type: "post",
                data: params,
                success: function(response) {
                  if (response.count) {
                    var team      = document.querySelector("select[name=team]").value;
                    var type      = document.querySelector("select[name=type]").value;
                    window.location.href='/period_aggregation/period_stat?date_from='+date_from+'&date_to='+date_to+'&team='+team+'&type='+type;
                  } else {
                    $("#errors").append(`<li>検索結果がありません。</li>`);
                  }
                },
                error: function(err) {
                  var html = '';
                  $.each(err.responseJSON.errors, function (key, val) {
                      html = html + '<li>'+val+'</li>'
                  });
                  $("#errors").append(html);
                }
              });
            }
        });
        $('body').on('click', '#chart', function(){
            $('#errors').empty()
            var date_from = document.querySelector("input[name=date_from]").value;
            var date_to = document.querySelector("input[name=date_to]").value;
            if(date_from.length != 11 || date_to.length != 11) {
              $("#errors").append(`<li>期間を入力してください。</li>`);
            } else {
              date_from = format_date(date_from);
              date_to = format_date(date_to);
              var params = {
                  date_from  : date_from,
                  date_to : date_to,
                  team : document.querySelector("select[name=team]").value,
                  type : document.querySelector("select[name=type]").value,
              };
            };
            $.ajax({
              url: "/period_aggregation/period_stat/check",
              type: "post",
              data: params,
              success: function(response) {
                var team      = document.querySelector("select[name=team]").value;
                var type      = document.querySelector("select[name=type]").value;
                window.location.href='/period_aggregation/chart?date_from='+date_from+'&date_to='+date_to+'&team='+team+'&type='+type;
              },
              error: function(err) {
                var html = '';
                $.each(err.responseJSON.errors, function (key, val) {
                    html = html + '<li>'+val+'</li>'
                });
                $("#errors").append(html);
              }
            });
        });
  }
  if (window.current_page == 'period_aggregation_stat') {
    var countLoad = 0;
    $('input[name="round"]').change(function() {
      $('#time1').empty();
      $('#time2').empty();
      $('#time3').empty();
      $('#time4').empty();
      $('#time5').empty();
      $('#time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#time'+round).append(html);
      }
      const tabIndex = document.querySelector("select[name=type]").value;

      $("#box_score_team").DataTable().clear().destroy();
      $('#box_score_team thead').hide();
      get_value_box_score_team(tabIndex);

      $("#box_score_personal").DataTable().clear().destroy();
      $('#box_score_personal thead').hide();
      get_value_box_score_personal(tabIndex);

      get_value_box_score_personal_by_match(tabIndex);
    });

    $('body').on('change', 'select[name="type"], input[name="sub_time"]', function() {
        const tabIndex = document.querySelector("select[name=type]").value;

        $("#box_score_team").DataTable().clear().destroy();
        $('#box_score_team thead').hide();
        get_value_box_score_team(tabIndex);

        $("#box_score_personal").DataTable().clear().destroy();
        $('#box_score_personal thead').hide();
        get_value_box_score_personal(tabIndex);

        get_value_box_score_personal_by_match(tabIndex);
    });

    get_value_box_score_team(1);

    function get_value_box_score_team(tabIndex) {
      showPopupLoading(true);
      // $('#box_score_team_loading').html(`<div class="loading">Loading</div>`);
      var round    = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var params = {
          date_from : getUrlVars()["date_from"],
          date_to   : getUrlVars()["date_to"],
          team      : getUrlVars()["team"],
          type      : getUrlVars()["type"],
          team_type : tabIndex,
          round     : round,
          sub_time  : sub_time,
      };
      $.ajax({
          url: "/period_aggregation/period_stat/team",
          type: "post",
          data: params,
          success: function (response) {
            countLoad++;
            const columnSelected = BOX_SCORE_TEAM_COLUMN_NAME[tabIndex];
            let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
              return `<th class="w10">
                          <div class="groupSort" data-column="${key}">
                              ${columnSelected.columns_name[key]}
                              <div class="groupSort__button">
                                  <span class="groupSort__button-arrUp"></span>
                                  <span class="groupSort__button-arrDown"></span>
                              </div>
                          </div>
                      </th>`;
            }).join('');
            htmlColumn = `<tr>
                              <th class="wid308 bg01">
                                  VS ${window.visiting_team}
                              </th>
                              ${htmlColumn}
                          </tr>`;
            $('#box_score_team thead').html(htmlColumn);
            $('#box_score_team thead').show();
            $('#box_score_team_loading').empty();

            if (tabIndex == 1) {
              $("#box_score_team").DataTable({
                "order": [],
                data: response.data,
                ordering: true,
                responsive: true,
                autoWidth: true,
                lengthChange: false,
                searching: false,
                info: false,
                paging: false,
                aoColumns: [
                  {
                      mData: 'conference_name',
                      "className": "wid308",
                      "sortable": false,
                      "render": function (data, type, row) {
                          return `<p class="ttl">
                                  <span class="date">${moment(row.start_date).format('YYYY/MM/DD')}</span>
                                  ${row.team1.name} VS ${row.team2.name}
                              </p>`
                      },
                  },
                  {
                      mData: 'goal',
                      "className": "text-center",
                  },
                  {
                      mData: 'kick',
                      "className": "text-center",
                  },
                  {
                      mData: 'kick_goal',
                      "className": "text-center",
                  },
                  {
                      mData: 'assist',
                      "className": "text-center",
                  },
                  {
                      mData: 'last_pass',
                      "className": "text-center",
                  },
                  {
                      mData: 'cross',
                      "className": "text-center",
                  },
                  {
                      mData: 'pass_dribble',
                      "className": "text-center",
                  },
                  {
                      mData: 'fouled',
                      "className": "text-center",
                  },
                  {
                      mData: 'tackle',
                      "className": "text-center",
                  },
                  {
                      mData: 'clear',
                      "className": "text-center",
                  },
                  {
                      mData: 'block',
                      "className": "text-center",
                  },
                  {
                      mData: 'foul',
                      "className": "text-center",
                  },
                  {
                      mData: 'second_ball',
                      "className": "text-center",
                  },
                  {
                      mData: 'is_pa',
                      "className": "text-center",
                  },
                  {
                      mData: 'penalty_golf',
                      "className": "text-center",
                  },
                  {
                      mData: 'corner_kick',
                      "className": "text-center",
                  },
                  {
                      mData: 'free_kick',
                      "className": "text-center",
                  },
                  {
                      mData: 'pk',
                      "className": "text-center",
                  },
                  {
                      mData: 'tackle_overhead_home',
                      "className": "text-center",
                  },
                  {
                      mData: 'tackle_overhead_guest',
                      "className": "text-center",
                  },
                  {
                      mData: 'save',
                      "className": "text-center",
                  },
                ],
                  drawCallback: () => {
                    $('#box_score_team tbody').append(`
                      <tr class="bg02 line"><td>TOTAL</td>
                        <td>${response.sum.goal}</td><td>${response.sum.kick}</td><td>${response.sum.kick_goal}</td><td>${response.sum.assist}</td>
                        <td>${response.sum.last_pass}</td><td>${response.sum.cross}</td><td>${response.sum.pass_dribble}</td><td>${response.sum.fouled}</td>
                        <td>${response.sum.tackle}</td><td>${response.sum.clear}</td><td>${response.sum.block}</td><td>${response.sum.foul}</td>
                        <td>${response.sum.second_ball}</td><td>${response.sum.is_pa}</td><td>${response.sum.penalty_golf}</td><td>${response.sum.corner_kick}</td>
                        <td>${response.sum.free_kick}</td><td>${response.sum.pk}</td><td>${response.sum.tackle_overhead_home}</td><td>${response.sum.tackle_overhead_guest}</td><td>${response.sum.save}</td>
                      </tr>
                      <tr class="bg03"><td>AVG</td>
                        <td>${response.avg.goal}</td><td>${response.avg.kick}</td><td>${response.avg.kick_goal}</td><td>${response.avg.assist}</td>
                        <td>${response.avg.last_pass}</td><td>${response.avg.cross}</td><td>${response.avg.pass_dribble}</td><td>${response.avg.fouled}</td>
                        <td>${response.avg.tackle}</td><td>${response.avg.clear}</td><td>${response.avg.block}</td><td>${response.avg.foul}</td>
                        <td>${response.avg.second_ball}</td><td>${response.avg.is_pa}</td><td>${response.avg.penalty_golf}</td><td>${response.avg.corner_kick}</td>
                        <td>${response.avg.free_kick}</td><td>${response.avg.pk}</td><td>${response.avg.tackle_overhead_home}</td><td>${response.avg.tackle_overhead_guest}</td><td>${response.avg.save}</td>
                      </tr>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 1,
                  },
              });
            } else {
              $("#box_score_team").DataTable({
                "order": [],
                data: response.data,
                ordering: true,
                responsive: true,
                autoWidth: true,
                lengthChange: false,
                searching: false,
                info: false,
                paging: false,
                aoColumns: [
                  {
                      mData: 'conference_name',
                      "className": "wid308r",
                      "render": function (data, type, row) {
                          return `<p class="ttl">
                                  <span class="date">${moment(row.start_date).format('YYYY/MM/DD')}</span>
                                  ${row.team1.name} VS ${row.team2.name}
                              </p>`
                      },
                  },
                  {
                      mData: 'ratio_goal',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_goal == '--' ? row.ratio_goal : row.ratio_goal + '%';
                      },
                  },
                  {
                      mData: 'ratio_kick_goal',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_kick_goal == '--' ? row.ratio_kick_goal : row.ratio_kick_goal + '%';
                      },
                  },
                  {
                      mData: 'ratio_tackle_overhead_home',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_tackle_overhead_home == '--' ? row.ratio_tackle_overhead_home : row.ratio_tackle_overhead_home + '%';
                      },
                  },
                  {
                      mData: 'ratio_tackle_overhead_guest',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_tackle_overhead_guest == '--' ? row.ratio_tackle_overhead_guest : row.ratio_tackle_overhead_guest + '%';
                      },
                  },
                  {
                      mData: 'ratio_pass_dribble',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_pass_dribble == '--' ? row.ratio_pass_dribble : row.ratio_pass_dribble + '%';
                      },
                  },
                  {
                      mData: 'ratio_cross',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_cross == '--' ? row.ratio_cross : row.ratio_cross + '%';
                      },
                  },
                  {
                      mData: 'ratio_tackle',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_tackle == '--' ? row.ratio_tackle : row.ratio_tackle + '%';
                      },
                  },
                  {
                      mData: 'ratio_clear',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_clear == '--' ? row.ratio_clear : row.ratio_clear + '%';
                      },
                  },
                  {
                      mData: 'ratio_second_ball',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_second_ball == '--' ? row.ratio_second_ball : row.ratio_second_ball + '%';
                      },
                  },
                  {
                      mData: 'ratio_save',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_save == '--' ? row.ratio_save : row.ratio_save + '%';
                      },
                  },
                  {
                      mData: 'ratio_catch_cross',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_catch_cross == '--' ? row.ratio_catch_cross : row.ratio_catch_cross + '%';
                      },
                  },
                  {
                      mData: 'ratio_goal_play',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_goal_play == '--' ? row.ratio_goal_play : row.ratio_goal_play + '%';
                      },
                  },
                  {
                      mData: 'ratio_throw',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_throw == '--' ? row.ratio_throw : row.ratio_throw + '%';
                      },
                  },
                  {
                      mData: 'ratio_lose',
                      "className": "text-center",
                      "render": function (data, type, row) {
                          return row.ratio_lose == '--' ? row.ratio_lose : row.ratio_lose + '%';
                      },
                  },
                ],
                drawCallback: () => {
                  $('#box_score_team tfoot').remove();
                  $('#box_score_team tbody').append(`
                    <tr class="bg03 line"><td class="wid308"><p class="ttl">AVG</p></td>
                    <td>${response.avg.ratio_goal}%</td><td>${response.avg.ratio_kick_goal}%</td><td>${response.avg.ratio_tackle_overhead_home}%</td>
                    <td>${response.avg.ratio_tackle_overhead_guest}%</td><td>${response.avg.ratio_pass_dribble}%</td><td>${response.avg.ratio_cross}%</td>
                    <td>${response.avg.ratio_tackle}%</td><td>${response.avg.ratio_clear}%</td><td>${response.avg.ratio_second_ball}%</td>
                    <td>${response.avg.ratio_save}%</td><td>${response.avg.ratio_catch_cross}%</td><td>${response.avg.ratio_goal_play}%</td>
                    <td>${response.avg.ratio_throw}%</td><td>${response.avg.ratio_lose}%</td>
                    </tr>
                    `);
                },
                fixedColumns: {
                  leftColumns: 1,
                },
              });
            }
          },
          error: function(err) {
          },
          complete: function(data) {
            if (countLoad == 3) {
              countLoad = 0;
              showPopupLoading(false);
            }
          }
      });
    }

    get_value_box_score_personal(1);

    function get_value_box_score_personal(tabIndex) {
      showPopupLoading(true);
      // $('#box_score_personal_loading').html(`<div class="loading">Loading</div>`);
      var round    = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var params = {
          date_from     : getUrlVars()["date_from"],
          date_to       : getUrlVars()["date_to"],
          team          : getUrlVars()["team"],
          type          : getUrlVars()["type"],
          personal_type : tabIndex,
          round         : round,
          sub_time      : sub_time,
      };
      $.ajax({
          url: "/period_aggregation/period_stat/personal",
          type: "post",
          data: params,
          success: function (response) {
            countLoad++;
            const columnSelected = BOX_SCORE_PERSONAL_COLUMN_NAME[tabIndex];
            if (checkMobile()) {
              let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
                  return `<th class="w10">
                              <div class="groupSort" data-column="${key}">
                                  ${columnSelected.columns_name[key]}
                                  <div class="groupSort__button">
                                      <span class="groupSort__button-arrUp"></span>
                                      <span class="groupSort__button-arrDown"></span>
                                  </div>
                              </div>
                          </th>`;
              }).join('');
              htmlColumn = `<tr>
                              <th class="wid86 bg01">
                                  <div class="groupSort">
                                      選手名(No/POS)
                                      <div class="groupSort__button">
                                          <span class="groupSort__button-arrUp"></span>
                                          <span class="groupSort__button-arrDown"></span>
                                      </div>
                                  </div>
                              </th>
                              ${htmlColumn}
                            </tr>`;

              $('#box_score_personal thead').html(htmlColumn);
              $('#box_score_personal thead').show();
              $('#box_score_personal_loading').empty();

              if (tabIndex == 1) {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  aoColumns: [
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return `仮選手(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else if (row.first_name == null && row.last_name == null) {
                            return `?(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else {
                             return `${row.first_name != null ? row.first_name : ''}${row.last_name != null ? ' ' + row.last_name : ''}(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          }
                        },
                    },
                    {
                        mData: 'goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'assist',
                        "className": "text-center",
                    },
                    {
                        mData: 'last_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass_dribble',
                        "className": "text-center",
                    },
                    {
                        mData: 'fouled',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle',
                        "className": "text-center",
                    },
                    {
                        mData: 'steal',
                        "className": "text-center",
                    },
                    {
                        mData: 'intercept',
                        "className": "text-center",
                    },
                    {
                        mData: 'shoot_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'foul',
                        "className": "text-center",
                    },
                    {
                        mData: 'clear',
                        "className": "text-center",
                    },
                    {
                        mData: 'second_ball',
                        "className": "text-center",
                    },
                    {
                        mData: 'corner_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'free_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'pk',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_home',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_guest',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_lose',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_penalty',
                        "className": "text-center",
                    },
                    {
                        mData: 'punching',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'contribute',
                        "className": "text-center",
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg02 line"><td>TOTAL</td>
                        <td>${response.sum.goal}</td><td>${response.sum.kick}</td><td>${response.sum.kick_goal}</td><td>${response.sum.assist}</td>
                        <td>${response.sum.last_pass}</td><td>${response.sum.cross}</td><td>${response.sum.pass_dribble}</td><td>${response.sum.fouled}</td>
                        <td>${response.sum.tackle}</td><td>${response.sum.steal}</td><td>${response.sum.intercept}</td><td>${response.sum.shoot_block}</td>
                        <td>${response.sum.cross_block}</td><td>${response.sum.foul}</td><td>${response.sum.clear}</td><td>${response.sum.second_ball}</td>
                        <td>${response.sum.corner_kick}</td><td>${response.sum.free_kick}</td><td>${response.sum.pk}</td><td>${response.sum.tackle_overhead_home}</td><td>${response.sum.tackle_overhead_guest}</td>
                        <td>${response.sum.guest_kick}</td><td>${response.sum.guest_kick_goal}</td><td>${response.sum.guest_lose}</td><td>${response.sum.save_kick}</td>
                        <td>${response.sum.save_penalty}</td><td>${response.sum.punching}</td><td>${response.sum.pass}</td><td>${response.sum.guest_pass}</td>
                        <td>${response.sum.contribute}</td>
                      </tr>
                      <tr class="bg03"><td>AVG</td>
                        <td>${response.avg.goal}</td><td>${response.avg.kick}</td><td>${response.avg.kick_goal}</td><td>${response.avg.assist}</td>
                        <td>${response.avg.last_pass}</td><td>${response.avg.cross}</td><td>${response.avg.pass_dribble}</td><td>${response.avg.fouled}</td>
                        <td>${response.avg.tackle}</td><td>${response.avg.steal}</td><td>${response.avg.intercept}</td><td>${response.avg.shoot_block}</td>
                        <td>${response.avg.cross_block}</td><td>${response.avg.foul}</td><td>${response.avg.clear}</td><td>${response.avg.second_ball}</td>
                        <td>${response.avg.corner_kick}</td><td>${response.avg.free_kick}</td><td>${response.avg.pk}</td><td>${response.avg.tackle_overhead_home}</td><td>${response.avg.tackle_overhead_guest}</td>
                        <td>${response.avg.guest_kick}</td><td>${response.avg.guest_kick_goal}</td><td>${response.avg.guest_lose}</td><td>${response.avg.save_kick}</td>
                        <td>${response.avg.save_penalty}</td><td>${response.avg.punching}</td><td>${response.avg.pass}</td><td>${response.avg.guest_pass}</td>
                        <td>${response.avg.contribute}</td>
                      </tr>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 1,
                  },
                });
              } else {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  aoColumns: [
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return `仮選手(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else if (row.first_name == null && row.last_name == null) {
                            return `?(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else {
                            return `${row.first_name != null ? row.first_name : ''}${row.last_name != null ? ' ' + row.last_name : ''}(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          }
                        },
                    },
                    {
                        mData: 'ratio_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_kick_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_kick_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_home',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_home + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_guest',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_guest + '%'
                        },
                    },
                    {
                        mData: 'ratio_pass_dribble',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_pass_dribble + '%'
                        },
                    },
                    {
                        mData: 'ratio_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle + '%'
                        },
                    },
                    {
                        mData: 'ratio_clear',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_clear + '%'
                        },
                    },
                    {
                        mData: 'ratio_second_ball',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_second_ball + '%'
                        },
                    },
                    {
                        mData: 'ratio_save',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_save + '%'
                        },
                    },
                    {
                        mData: 'ratio_catch_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_catch_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_lose',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_lose + '%'
                        },
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg03"><tr class="bg03 line"><td>AVG</td>
                      <td>${response.avg.ratio_goal}%</td><td>${response.avg.ratio_kick_goal}%</td><td>${response.avg.ratio_tackle_overhead_home}%</td>
                      <td>${response.avg.ratio_tackle_overhead_guest}%</td><td>${response.avg.ratio_pass_dribble}%</td><td>${response.avg.ratio_cross}%</td>
                      <td>${response.avg.ratio_tackle}%</td><td>${response.avg.ratio_clear}%</td><td>${response.avg.ratio_second_ball}%</td>
                      <td>${response.avg.ratio_save}%</td><td>${response.avg.ratio_catch_cross}%</td><td>${response.avg.ratio_lose}%</td>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 1,
                  },
                });
              }
            } else {
              let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
                  return `<th class="w10">
                              <div class="groupSort" data-column="${key}">
                                  ${columnSelected.columns_name[key]}
                                  <div class="groupSort__button">
                                      <span class="groupSort__button-arrUp"></span>
                                      <span class="groupSort__button-arrDown"></span>
                                  </div>
                              </div>
                          </th>`;
              }).join('');
              htmlColumn = `<tr>
                              <th class="wid86 bg01">
                                  <div class="groupSort">
                                      No.
                                      <div class="groupSort__button">
                                          <span class="groupSort__button-arrUp"></span>
                                          <span class="groupSort__button-arrDown"></span>
                                      </div>
                                  </div>
                              </th>
                              <th class="wid100 bg01">
                                  <div class="groupSort">
                                      POS
                                      <div class="groupSort__button">
                                          <span class="groupSort__button-arrUp"></span>
                                          <span class="groupSort__button-arrDown"></span>
                                      </div>
                                  </div>
                              </th>
                              <th class="wid120 bg01">
                                  <div class="groupSort">
                                      選手名
                                      <div class="groupSort__button">
                                          <span class="groupSort__button-arrUp"></span>
                                          <span class="groupSort__button-arrDown"></span>
                                      </div>
                                    </div>
                                </th>
                              ${htmlColumn}
                            </tr>`;

              $('#box_score_personal thead').html(htmlColumn);
              $('#box_score_personal thead').show();
              $('#box_score_personal_loading').empty();

              if (tabIndex == 1) {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  aoColumns: [
                    {
                        mData: 'number_official',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.number_official) {
                              return row.number_official;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.position_name) {
                              return row.position_name;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return '仮選手';
                          } else if (row.first_name == null && row.last_name == null) {
                            return '?';
                          } else {
                            return (row.first_name != null ? row.first_name : '') + ' ' + (row.last_name != null ? row.last_name : '');
                          }
                        },
                    },
                    {
                        mData: 'goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'assist',
                        "className": "text-center",
                    },
                    {
                        mData: 'last_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass_dribble',
                        "className": "text-center",
                    },
                    {
                        mData: 'fouled',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle',
                        "className": "text-center",
                    },
                    {
                        mData: 'steal',
                        "className": "text-center",
                    },
                    {
                        mData: 'intercept',
                        "className": "text-center",
                    },
                    {
                        mData: 'shoot_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'foul',
                        "className": "text-center",
                    },
                    {
                        mData: 'clear',
                        "className": "text-center",
                    },
                    {
                        mData: 'second_ball',
                        "className": "text-center",
                    },
                    {
                        mData: 'corner_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'free_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'pk',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_home',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_guest',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_lose',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_penalty',
                        "className": "text-center",
                    },
                    {
                        mData: 'punching',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'contribute',
                        "className": "text-center",
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg02 line"><td></td><td></td><td>TOTAL</td>
                        <td>${response.sum.goal}</td><td>${response.sum.kick}</td><td>${response.sum.kick_goal}</td><td>${response.sum.assist}</td>
                        <td>${response.sum.last_pass}</td><td>${response.sum.cross}</td><td>${response.sum.pass_dribble}</td><td>${response.sum.fouled}</td>
                        <td>${response.sum.tackle}</td><td>${response.sum.steal}</td><td>${response.sum.intercept}</td><td>${response.sum.shoot_block}</td>
                        <td>${response.sum.cross_block}</td><td>${response.sum.foul}</td><td>${response.sum.clear}</td><td>${response.sum.second_ball}</td>
                        <td>${response.sum.corner_kick}</td><td>${response.sum.free_kick}</td><td>${response.sum.pk}</td><td>${response.sum.tackle_overhead_home}</td><td>${response.sum.tackle_overhead_guest}</td>
                        <td>${response.sum.guest_kick}</td><td>${response.sum.guest_kick_goal}</td><td>${response.sum.guest_lose}</td><td>${response.sum.save_kick}</td>
                        <td>${response.sum.save_penalty}</td><td>${response.sum.punching}</td><td>${response.sum.pass}</td><td>${response.sum.guest_pass}</td>
                        <td>${response.sum.contribute}</td>
                      </tr>
                      <tr class="bg03"><td>AVG</td>
                        <td>${response.avg.goal}</td><td>${response.avg.kick}</td><td>${response.avg.kick_goal}</td><td>${response.avg.assist}</td>
                        <td>${response.avg.last_pass}</td><td>${response.avg.cross}</td><td>${response.avg.pass_dribble}</td><td>${response.avg.fouled}</td>
                        <td>${response.avg.tackle}</td><td>${response.avg.steal}</td><td>${response.avg.intercept}</td><td>${response.avg.shoot_block}</td>
                        <td>${response.avg.cross_block}</td><td>${response.avg.foul}</td><td>${response.avg.clear}</td><td>${response.avg.second_ball}</td>
                        <td>${response.avg.corner_kick}</td><td>${response.avg.free_kick}</td><td>${response.avg.pk}</td><td>${response.avg.tackle_overhead_home}</td><td>${response.avg.tackle_overhead_guest}</td>
                        <td>${response.avg.guest_kick}</td><td>${response.avg.guest_kick_goal}</td><td>${response.avg.guest_lose}</td><td>${response.avg.save_kick}</td>
                        <td>${response.avg.save_penalty}</td><td>${response.avg.punching}</td><td>${response.avg.pass}</td><td>${response.avg.guest_pass}</td>
                        <td>${response.avg.contribute}</td>
                      </tr>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 3,
                  },
                });
              } else {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  aoColumns: [
                    {
                        mData: 'number_official',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.number_official) {
                              return row.number_official;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.position_name) {
                              return row.position_name;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return '仮選手';
                          } else if (row.first_name == null && row.last_name == null) {
                            return '?';
                          } else {
                            return (row.first_name != null ? row.first_name : '') + ' ' + (row.last_name != null ? row.last_name : '');
                          }
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_home',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_home + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_guest',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_guest + '%'
                        },
                    },
                    {
                        mData: 'ratio_pass_dribble',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_pass_dribble + '%'
                        },
                    },
                    {
                        mData: 'ratio_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle + '%'
                        },
                    },
                    {
                        mData: 'ratio_clear',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_clear + '%'
                        },
                    },
                    {
                        mData: 'ratio_second_ball',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_second_ball + '%'
                        },
                    },
                    {
                        mData: 'ratio_save',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_save + '%'
                        },
                    },
                    {
                        mData: 'ratio_catch_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_catch_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_lose',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_lose + '%'
                        },
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg03"><tr class="bg03 line"><td></td><td></td><td>AVG</td>
                      <td>${response.avg.ratio_goal}%</td><td>${response.avg.ratio_kick_goal}%</td><td>${response.avg.ratio_tackle_overhead_home}%</td>
                      <td>${response.avg.ratio_tackle_overhead_guest}%</td><td>${response.avg.ratio_pass_dribble}%</td><td>${response.avg.ratio_cross}%</td>
                      <td>${response.avg.ratio_tackle}%</td><td>${response.avg.ratio_clear}%</td><td>${response.avg.ratio_second_ball}%</td>
                      <td>${response.avg.ratio_save}%</td><td>${response.avg.ratio_catch_cross}%</td><td>${response.avg.ratio_lose}%</td>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 3,
                  },
                });
              }
            }
          },
          error: function(err) {
          },
          complete: function(data) {
            if (countLoad == 3) {
              countLoad = 0;
              showPopupLoading(false);
            }
          }
      });
    }

    var data_list = '';
    get_value_box_score_personal_by_match(1);
    function get_value_box_score_personal_by_match(tabIndex) {
      showPopupLoading(true);
      // $('.box_score_personal_by_match').html(`<div class="loading">Loading</div>`);
      var round    = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var params = {
          date_from     : getUrlVars()["date_from"],
          date_to       : getUrlVars()["date_to"],
          team          : getUrlVars()["team"],
          type          : getUrlVars()["type"],
          personal_type : tabIndex,
          round         : round,
          sub_time      : sub_time,
      };
      $.ajax({
          url: "/period_aggregation/period_stat/personal_by_match",
          type: "post",
          data: params,
          success: function (response) {
            countLoad++;
            $('.box_score_personal_by_match').empty();
            data_list = response.data;
            data_listGlobal = response.data;
            var no = 0;
            response.data.forEach(function(item) {
              no += 1;
              const columnSelected = BOX_SCORE_PERSONAL_COLUMN_NAME[tabIndex];
              let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
                return `<th class="w10">
                            <div class="groupSort" data-column="${key}">
                                ${columnSelected.columns_name[key]}
                                <div class="groupSort__button">
                                    <span class="groupSort__button-arrUp"></span>
                                    <span class="groupSort__button-arrDown"></span>
                                </div>
                            </div>
                        </th>`;
              }).join('');
              $('.box_score_personal_by_match').append(`
                  <div class="tblScroll pcLeft364">
                    <div class="tblScroll__wrap mb20">
                      <table class="tblList mb0" id="box_score_team_by_match${item.id}">
                        <thead>
                          <tr>
                              <th class="wid50 bg01">
                                  ${item.number_official ? item.number_official : '?'}
                              </th>
                              <th class="wid62 bg01">
                                  ${item.position_name ? item.position_name : '?'}
                              </th>
                              <th class="wid252 bg01">
                                  ${(() => {
                                  if (item.member_id == -1 || item.member_id == -2) {
                                    return '仮選手';
                                  } else if (item.first_name == null && item.last_name == null) {
                                    return '?';
                                  } else {
                                    return (item.first_name != null ? item.first_name : '') + ' ' + (item.last_name != null ? item.last_name : '');
                                  }
                                  })()}
                              </th>
                              ${htmlColumn}
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="right">
                        <a href="#optionFilter" class="btnCmn03 jsAnchorLink">検索条件に戻る<span class="iconArrow"></span></a>
                    </div>
                </div>`);

              const name ='box_score_team_by_match' + item.id;
              if(tabIndex == 1){
                $(`#${name}`).DataTable({
                  data: item.match,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  createdRow: function(row, data, dataIndex){
                      $('td:eq(0)', row).attr('colspan', 3);
                      $('td:eq(1)', row).css('display', 'none');
                      $('td:eq(2)', row).css('display', 'none');
                  },
                  aoColumns: [
                    {
                        mData: 'goal',
                        "className": "text-center",
                        orderable: false,
                        "render": function (data, type, row) {
                            return `<p class="ttl">
                                    <span class="date">${row.start_date}</span>
                                    ${row.team1_name} VS ${row.team2_name}
                                </p>`
                        },
                    },
                    {
                        mData: 'goal',
                        orderable: false,
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return ''
                        },
                    },
                    {
                        mData: 'goal',
                        orderable: false,
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return ''
                        },
                    },
                    {
                        mData: 'goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'assist',
                        "className": "text-center",
                    },
                    {
                        mData: 'last_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass_dribble',
                        "className": "text-center",
                    },
                    {
                        mData: 'fouled',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle',
                        "className": "text-center",
                    },
                    {
                        mData: 'steal',
                        "className": "text-center",
                    },
                    {
                        mData: 'intercept',
                        "className": "text-center",
                    },
                    {
                        mData: 'shoot_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'foul',
                        "className": "text-center",
                    },
                    {
                        mData: 'clear',
                        "className": "text-center",
                    },
                    {
                        mData: 'second_ball',
                        "className": "text-center",
                    },
                    {
                        mData: 'corner_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'free_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'pk',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_home',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_guest',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_lose',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_penalty',
                        "className": "text-center",
                    },
                    {
                        mData: 'punching',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'contribute',
                        "className": "text-center",
                    },
                  ],
                  drawCallback: () => {
                    $(`#${name} tbody`).append(`
                      <tr class="bg02 line"><td class="wid308" colspan="3"><p class="ttl">TOTAL</p></td><td style="display: none;">&nbsp;</td><td style="display: none;">&nbsp;</td>
                      <td>${item.sum_goal}</td><td>${item.sum_kick}</td><td>${item.sum_kick_goal}</td><td>${item.sum_assist}</td>
                      <td>${item.sum_last_pass}</td><td>${item.sum_cross}</td><td>${item.sum_pass_dribble}</td><td>${item.sum_fouled}</td>
                      <td>${item.sum_tackle}</td><td>${item.sum_steal}</td><td>${item.sum_intercept}</td><td>${item.sum_shoot_block}</td>
                      <td>${item.sum_cross_block}</td><td>${item.sum_foul}</td><td>${item.sum_clear}</td><td>${item.sum_second_ball}</td>
                      <td>${item.sum_corner_kick}</td><td>${item.sum_free_kick}</td><td>${item.sum_pk}</td><td>${item.sum_tackle_overhead_home}</td><td>${item.sum_tackle_overhead_guest}</td>
                      <td>${item.sum_guest_kick}</td><td>${item.sum_guest_kick_goal}</td><td>${item.sum_guest_lose}</td><td>${item.sum_save_kick}</td>
                      <td>${item.sum_save_penalty}</td><td>${item.sum_punching}</td><td>${item.sum_pass}</td><td>${item.sum_guest_pass}</td>
                      <td>${item.sum_contribute}</td>
                      </tr>
                      <tr class="bg03"><td class="wid308" colspan="3"><p class="ttl">AVG</p></td><td style="display: none;">&nbsp;</td><td style="display: none;">&nbsp;</td>
                      <td>${item.avg_goal}</td><td>${item.avg_kick}</td><td>${item.avg_kick_goal}</td><td>${item.avg_assist}</td>
                      <td>${item.avg_last_pass}</td><td>${item.avg_cross}</td><td>${item.avg_pass_dribble}</td><td>${item.avg_fouled}</td>
                      <td>${item.avg_tackle}</td><td>${item.avg_steal}</td><td>${item.avg_intercept}</td><td>${item.avg_shoot_block}</td>
                      <td>${item.avg_cross_block}</td><td>${item.avg_foul}</td><td>${item.avg_clear}</td><td>${item.avg_second_ball}</td>
                      <td>${item.avg_corner_kick}</td><td>${item.avg_free_kick}</td><td>${item.avg_pk}</td><td>${item.avg_tackle_overhead_home}</td><td>${item.avg_tackle_overhead_guest}</td>
                      <td>${item.avg_guest_kick}</td><td>${item.avg_guest_kick_goal}</td><td>${item.avg_guest_lose}</td><td>${item.avg_save_kick}</td>
                      <td>${item.avg_save_penalty}</td><td>${item.avg_punching}</td><td>${item.avg_pass}</td><td>${item.avg_guest_pass}</td>
                      <td>${item.avg_contribute}</td>
                      </tr>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 3,
                  },
                });
              }
              else {
                $(`#${name}`).DataTable({
                  data: item.match,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  createdRow: function(row, data, dataIndex){
                      $('td:eq(0)', row).attr('colspan', 3);
                      $('td:eq(1)', row).css('display', 'none');
                      $('td:eq(2)', row).css('display', 'none');
                  },
                  aoColumns: [
                    {
                        mData: 'ratio_goal',
                        "className": "text-center",
                        orderable: false,
                        "render": function (data, type, row) {
                            return `<p class="ttl">
                                    <span class="date">${row.start_date}</span>
                                    ${row.team1_name} VS ${row.team2_name}
                                </p>`
                        },
                    },
                    {
                        mData: 'ratio_goal',
                        orderable: false,
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return ''
                        },
                    },
                    {
                        mData: 'ratio_goal',
                        orderable: false,
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return ''
                        },
                    },
                    {
                        mData: 'ratio_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_goal == '--' ? row.ratio_goal : row.ratio_goal + '%';
                        },
                    },
                    {
                        mData: 'ratio_kick_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_kick_goal == '--' ? row.ratio_kick_goal : row.ratio_kick_goal + '%';
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_home',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_home == '--' ? row.ratio_tackle_overhead_home : row.ratio_tackle_overhead_home + '%';
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_guest',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_guest == '--' ? row.ratio_tackle_overhead_guest : row.ratio_tackle_overhead_guest + '%';
                        },
                    },
                    {
                        mData: 'ratio_pass_dribble',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_pass_dribble == '--' ? row.ratio_pass_dribble : row.ratio_pass_dribble + '%';
                        },
                    },
                    {
                        mData: 'ratio_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_cross == '--' ? row.ratio_cross : row.ratio_cross + '%';
                        },
                    },
                    {
                        mData: 'ratio_tackle',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle == '--' ? row.ratio_tackle : row.ratio_tackle + '%';
                        },
                    },
                    {
                        mData: 'ratio_clear',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_clear == '--' ? row.ratio_clear : row.ratio_clear + '%';
                        },
                    },
                    {
                        mData: 'ratio_second_ball',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_second_ball == '--' ? row.ratio_second_ball : row.ratio_second_ball + '%';
                        },
                    },
                    {
                        mData: 'ratio_save',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_save == '--' ? row.ratio_save : row.ratio_save + '%';
                        },
                    },
                    {
                        mData: 'ratio_catch_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_catch_cross == '--' ? row.ratio_catch_cross : row.ratio_catch_cross + '%';
                        },
                    },
                    {
                        mData: 'ratio_lose',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_lose == '--' ? row.ratio_lose : row.ratio_lose + '%';
                        },
                    },
                  ],
                  drawCallback: () => {
                    $(`#${name} tbody`).append(`
                    <tr class="bg03"><td class="wid308 line" colspan="3"><p class="ttl">AVG</p></td><td style="display: none;">&nbsp;</td><td style="display: none;">&nbsp;</td>
                    <td>${item.avg_ratio_goal}%</td><td>${item.avg_ratio_kick_goal}%</td><td>${item.avg_ratio_tackle_overhead_home}%</td>
                    <td>${item.avg_ratio_tackle_overhead_guest}%</td><td>${item.avg_ratio_pass_dribble}%</td><td>${item.avg_ratio_cross}%</td>
                    <td>${item.avg_ratio_tackle}%</td><td>${item.avg_ratio_clear}%</td><td>${item.avg_ratio_second_ball}%</td>
                    <td>${item.avg_ratio_save}%</td><td>${item.avg_ratio_catch_cross}%</td><td>${item.avg_ratio_lose}%</td>
                    </tr>
                    `);
                  },
                  fixedColumns: {
                    leftColumns: 3,
                  },
                });
              }
            });
          },
          complete: function(data) {
            if (countLoad == 3) {
              countLoad = 0;
              showPopupLoading(false);
            }
          }
      })
    }

    let timeout;
    let resizePC = 0, resizeSP = 0;
    $(window).width() <= 768 ? resizeSP = 1: resizePC = 1;
    $(window).on('resize', function () {
      clearTimeout(timeout);
      timeout = setTimeout(function() {
        if ($(window).width() <= 768) {
          resizePC = 0;
          resizeSP ++;
          if(resizeSP == 1) {
            var table = $(".tblScroll .tblList");
            table.each((index, ele) => {
                $(ele).DataTable().destroy();
                if($(ele).attr('id').match("box_score_team_by_match") != null) {
                    var idSplit = $(ele).attr('id').split('box_score_team_by_match');
                    var data = data_listGlobal.filter(function(e){
                    return e.id == idSplit[1] ? e : null;
                    });
                    let tabIndex = $('#type'+ idSplit[1]+':checked').attr('data-tab');
                    let id = $(ele).attr('id');
                    render_box_score_personal_by_match(tabIndex, data, id);
                }
            })
            let tabIndex2 = $('input[name="team_type"]:checked').attr('data-tab');
            let tabIndex = $('input[name="personal_type"]:checked').attr('data-tab');
            render_box_score_team(tabIndex2);
            render_box_score_personal(tabIndex);
          }
        } else {
          resizeSP = 0;
          resizePC ++;
          if(resizePC == 1) {
            var table = $(".tblScroll .tblList");
            table.each((index, ele) => {
                $(ele).DataTable().destroy();
                if($(ele).attr('id').match("box_score_team_by_match") != null) {
                    var idSplit = $(ele).attr('id').split('box_score_team_by_match');
                    var data = data_listGlobal.filter(function(e){
                    return e.id == idSplit[1] ? e : null;
                    });
                    let tabIndex = $('#type'+ idSplit[1]+':checked').attr('data-tab');
                    let id = $(ele).attr('id');
                    render_box_score_personal_by_match(tabIndex, data, id);
                }
            })
            let tabIndex2 = $('input[name="team_type"]:checked').attr('data-tab');
            let tabIndex = $('input[name="personal_type"]:checked').attr('data-tab');
            render_box_score_team(tabIndex2);
            render_box_score_personal(tabIndex);
          }
        }
      }, 300);
    });
  }

  if (window.current_page == 'scorebook_matches_report') {
    var match_id = document.querySelector("input[name=match_id]").value;

    // First load
    var team_type = $("input[name=team_type]:checked").val();
    var params = {
        round         : '0',
        sub_time      : null,
        team_type     : team_type,
    };
    render_horizontal_chart(params, match_id, '1', team_type);

    // After change team_type
    $('input[name="team_type"]').change(function() {
      $('#team').empty()
      var team_type = $("input[name=team_type]:checked").val();

      var params = {
          round         : '0',
          sub_time      : null,
          team_type     : team_type,
      };
      render_horizontal_chart(params, match_id, '1', team_type)

    })
  }

  if (window.current_page == 'scorebook_matches_stat') {
    var firstLoadStat = 0;

    $('input[name="round"]').change(function() {
      $('#time1').empty();
      $('#time2').empty();
      $('#time3').empty();
      $('#time4').empty();
      $('#time5').empty();
      $('#time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#time'+round).append(html);
      }
      $("#box_score_personal").DataTable().clear().destroy();
      $('#box_score_personal thead').hide();
      const tabIndex = document.querySelector("select[name=personal_type]").value;
      get_value_box_score_personal(tabIndex)
    });

    $('body').on('change', 'select[name="personal"], input[name="sub_time"]', function() {
      $("#box_score_personal").DataTable().clear().destroy();
      $('#box_score_personal thead').hide();
      const tabIndex = document.querySelector("select[name=personal_type]").value;
      get_value_box_score_personal(tabIndex)
    });

    $('body').on('change', 'select[name="personal_type"]', function() {
      $("#box_score_personal").DataTable().clear().destroy();
      $('#box_score_personal thead').hide();
      const tabIndex = document.querySelector("select[name=personal_type]").value;
      get_value_box_score_personal(tabIndex)
    });

    get_value_box_score_personal(1)
    function get_value_box_score_personal(tabIndex) {
      showPopupLoading(true);
      // $('#loading').html(`<div class="loading">Loading</div>`);
      var team          = document.querySelector("select[name=personal]").value;
      var personal_type = document.querySelector("select[name=personal_type]").value;
      var round         = document.querySelector('input[name="round"]:checked').value;
      var sub_time      = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var params = {
          round         : round,
          team          : team,
          sub_time      : sub_time,
          personal_type : personal_type,
      };
      $.ajax({
          url: "/scorebook/matches/"+get_id_url_scorebook_stat()+"/stat/personal",
          type: "post",
          data: params,
          success: function (response) {
            const columnSelected = BOX_SCORE_PERSONAL_COLUMN_NAME[tabIndex];
            if (checkMobile()) {
              let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
                  return `<th class="w10">
                              <div class="groupSort" data-column="${key}">
                                  ${columnSelected.columns_name[key]}
                                  <div class="groupSort__button">
                                      <span class="groupSort__button-arrUp"></span>
                                      <span class="groupSort__button-arrDown"></span>
                                  </div>
                              </div>
                          </th>`;
              }).join('');
              htmlColumn = `<tr>
                              <th class="wid86 bg01">
                                  <div class="groupSort">
                                      選手名(No/POS)
                                      <div class="groupSort__button">
                                          <span class="groupSort__button-arrUp"></span>
                                          <span class="groupSort__button-arrDown"></span>
                                      </div>
                                  </div>
                              </th>
                              <th class="w10">
                                <div class="groupSort" data-column="4">
                                    出場時間
                                    <div class="groupSort__button">
                                        <span class="groupSort__button-arrUp"></span>
                                        <span class="groupSort__button-arrDown"></span>
                                    </div>
                                </div>
                              </th>
                              ${htmlColumn}
                            </tr>`;

              $('#box_score_personal thead').html(htmlColumn);
              $('#box_score_personal thead').show();
              $('#loading').empty();

              if (personal_type == 1) {
                function getNumberOfficial(str) {
                  str = str.split('(').pop();
                  str = str.split('/').shift();
                  return str;
                }

                jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                  "sort-numbers-ignore-text-asc": function (a, b) {
                    a = getNumberOfficial(a);
                    b = getNumberOfficial(b);
                    return sortNumbersIgnoreText(a, b, Number.POSITIVE_INFINITY);
                  },
                  "sort-numbers-ignore-text-desc": function (a, b) {
                    a = getNumberOfficial(a);
                    b = getNumberOfficial(b);
                    return sortNumbersIgnoreText(a, b, Number.NEGATIVE_INFINITY) * -1;
                  }
                });
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  columnDefs: [{ type: 'sort-numbers-ignore-text', targets : 0 }],
                  aoColumns: [
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return `仮選手(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else if (row.first_name == null && row.last_name == null) {
                            return `?(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else {
                            return `${row.first_name != null ? row.first_name : ''}${row.last_name != null ? ' ' + row.last_name : ''}(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        render: function (data, type, row, meta) {
                            return '90分';
                        }
                    },
                    {
                        mData: 'goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'assist',
                        "className": "text-center",
                    },
                    {
                        mData: 'last_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass_dribble',
                        "className": "text-center",
                    },
                    {
                        mData: 'fouled',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle',
                        "className": "text-center",
                    },
                    {
                        mData: 'steal',
                        "className": "text-center",
                    },
                    {
                        mData: 'intercept',
                        "className": "text-center",
                    },
                    {
                        mData: 'shoot_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'foul',
                        "className": "text-center",
                    },
                    {
                        mData: 'clear',
                        "className": "text-center",
                    },
                    {
                        mData: 'second_ball',
                        "className": "text-center",
                    },
                    {
                        mData: 'corner_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'free_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'pk',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_home',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_guest',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_lose',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_penalty',
                        "className": "text-center",
                    },
                    {
                        mData: 'punching',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'contribute',
                        "className": "text-center",
                    },
                  ],
                    drawCallback: () => {
                      $('#box_score_personal tbody').append(`
                        <tr class="bg02 line"><td>TOTALS</td><td></td>
                          <td>${response.sum.goal}</td><td>${response.sum.kick}</td><td>${response.sum.kick_goal}</td><td>${response.sum.assist}</td>
                          <td>${response.sum.last_pass}</td><td>${response.sum.cross}</td><td>${response.sum.pass_dribble}</td><td>${response.sum.fouled}</td>
                          <td>${response.sum.tackle}</td><td>${response.sum.steal}</td><td>${response.sum.intercept}</td><td>${response.sum.shoot_block}</td>
                          <td>${response.sum.cross_block}</td><td>${response.sum.foul}</td><td>${response.sum.clear}</td><td>${response.sum.second_ball}</td>
                          <td>${response.sum.corner_kick}</td><td>${response.sum.free_kick}</td><td>${response.sum.pk}</td><td>${response.sum.tackle_overhead_home}</td>
                          <td>${response.sum.tackle_overhead_guest}</td><td>${response.sum.guest_kick}</td><td>${response.sum.guest_kick_goal}</td><td>${response.sum.guest_lose}</td><td>${response.sum.save_kick}</td>
                          <td>${response.sum.save_penalty}</td><td>${response.sum.punching}</td><td>${response.sum.pass}</td><td>${response.sum.guest_pass}</td>
                          <td>${response.sum.contribute}</td>
                        </tr>
                        <tr class="bg03"><td>AVG</td><td></td>
                          <td>${response.avg.goal}</td><td>${response.avg.kick}</td><td>${response.avg.kick_goal}</td><td>${response.avg.assist}</td>
                          <td>${response.avg.last_pass}</td><td>${response.avg.cross}</td><td>${response.avg.pass_dribble}</td><td>${response.avg.fouled}</td>
                          <td>${response.avg.tackle}</td><td>${response.avg.steal}</td><td>${response.avg.intercept}</td><td>${response.avg.shoot_block}</td>
                          <td>${response.avg.cross_block}</td><td>${response.avg.foul}</td><td>${response.avg.clear}</td><td>${response.avg.second_ball}</td>
                          <td>${response.avg.corner_kick}</td><td>${response.avg.free_kick}</td><td>${response.avg.pk}</td><td>${response.avg.tackle_overhead_home}</td><td>${response.avg.tackle_overhead_guest}</td>
                          <td>${response.avg.guest_kick}</td><td>${response.avg.guest_kick_goal}</td><td>${response.avg.guest_lose}</td><td>${response.avg.save_kick}</td>
                          <td>${response.avg.save_penalty}</td><td>${response.avg.punching}</td><td>${response.avg.pass}</td><td>${response.avg.guest_pass}</td>
                          <td>${response.avg.contribute}</td>
                        </tr>
                        `);
                    },
                    fixedColumns: {
                      leftColumns: 1,
                    },
                });
              } else {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  columnDefs: [{ type: 'sort-numbers-ignore-text', targets : 0 }],
                  aoColumns: [
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return `仮選手(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else if (row.first_name == null && row.last_name == null) {
                            return `?(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          } else {
                            return `${row.first_name != null ? row.first_name : ''}${row.last_name != null ? ' ' + row.last_name : ''}(${row.number_official != null ? row.number_official : '?'}/${row.position_name != null ? row.position_name : '?'})`;
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        render: function (data, type, row, meta) {
                            return '90分';
                        }
                    },
                    {
                        mData: 'ratio_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_kick_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_kick_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_home',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_home + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_guest',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_guest + '%'
                        },
                    },
                    {
                        mData: 'ratio_pass_dribble',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_pass_dribble + '%'
                        },
                    },
                    {
                        mData: 'ratio_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle + '%'
                        },
                    },
                    {
                        mData: 'ratio_clear',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_clear + '%'
                        },
                    },
                    {
                        mData: 'ratio_second_ball',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_second_ball + '%'
                        },
                    },
                    {
                        mData: 'ratio_save',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_save + '%'
                        },
                    },
                    {
                        mData: 'ratio_catch_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_catch_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_lose',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_lose + '%'
                        },
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg03"><tr class="bg03 line"><td>AVG</td><td></td>
                      <td>${response.avg.ratio_goal}%</td><td>${response.avg.ratio_kick_goal}%</td><td>${response.avg.ratio_tackle_overhead_home}%</td>
                      <td>${response.avg.ratio_tackle_overhead_guest}%</td><td>${response.avg.ratio_pass_dribble}%</td><td>${response.avg.ratio_cross}%</td>
                      <td>${response.avg.ratio_tackle}%</td><td>${response.avg.ratio_clear}%</td><td>${response.avg.ratio_second_ball}%</td>
                      <td>${response.avg.ratio_save}%</td><td>${response.avg.ratio_catch_cross}%</td><td>${response.avg.ratio_lose}%</td>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 1,
                  },
                });
              }
            } else {
              let htmlColumn = Object.keys(columnSelected.columns_name).map(key => {
                  return `<th class="w10">
                              <div class="groupSort" data-column="${key}">
                                  ${columnSelected.columns_name[key]}
                                  <div class="groupSort__button">
                                      <span class="groupSort__button-arrUp"></span>
                                      <span class="groupSort__button-arrDown"></span>
                                  </div>
                              </div>
                          </th>`;
              }).join('');
              htmlColumn = `<tr>
                            <th class="wid86 bg01">
                                <div class="groupSort">
                                    No.
                                    <div class="groupSort__button">
                                        <span class="groupSort__button-arrUp"></span>
                                        <span class="groupSort__button-arrDown"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="wid100 bg01">
                                <div class="groupSort">
                                    POS
                                    <div class="groupSort__button">
                                        <span class="groupSort__button-arrUp"></span>
                                        <span class="groupSort__button-arrDown"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="wid120 bg01">
                                <div class="groupSort">
                                    選手名
                                    <div class="groupSort__button">
                                        <span class="groupSort__button-arrUp"></span>
                                        <span class="groupSort__button-arrDown"></span>
                                    </div>
                                </div>
                            </th>
                            <th class="wid120 bg01">
                                <div class="groupSort">
                                    出場時間
                                    <div class="groupSort__button">
                                        <span class="groupSort__button-arrUp"></span>
                                        <span class="groupSort__button-arrDown"></span>
                                    </div>
                                </div>
                              </th>
                              ${htmlColumn}
                            </tr>`;

              $('#box_score_personal thead').html(htmlColumn);
              $('#box_score_personal thead').show();
              $('#loading').empty();

              if (personal_type == 1) {
                jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                  "sort-numbers-ignore-text-asc": function (a, b) {
                    return sortNumbersIgnoreText(a, b, Number.POSITIVE_INFINITY);
                  },
                  "sort-numbers-ignore-text-desc": function (a, b) {
                    return sortNumbersIgnoreText(a, b, Number.NEGATIVE_INFINITY) * -1;
                  }
                });

                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  columnDefs: [{ type: 'sort-numbers-ignore-text', targets : 0 }],
                  aoColumns: [
                    {
                        mData: 'number_official',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.number_official) {
                              return row.number_official;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (type == 'sort') {
                            if (data == 'MF') return 3;
                            else if(data == 'GK') return 1;
                            else if(data == 'DF') return 2;
                            else if(data == 'FW') return 4;
                            else if(data == '?') return 5;
                          } else {
                            if (row.position_name) {
                              return row.position_name;
                            };
                            return '?';
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return '仮選手';
                          } else if (row.first_name == null && row.last_name == null) {
                            return '?';
                          } else {
                            return (row.first_name != null ? row.first_name : '') + ' ' + (row.last_name != null ? row.last_name : '');
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        render: function (data, type, row, meta) {
                            return '90分';
                        }
                    },
                    {
                        mData: 'goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'assist',
                        "className": "text-center",
                    },
                    {
                        mData: 'last_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass_dribble',
                        "className": "text-center",
                    },
                    {
                        mData: 'fouled',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle',
                        "className": "text-center",
                    },
                    {
                        mData: 'steal',
                        "className": "text-center",
                    },
                    {
                        mData: 'intercept',
                        "className": "text-center",
                    },
                    {
                        mData: 'shoot_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'cross_block',
                        "className": "text-center",
                    },
                    {
                        mData: 'foul',
                        "className": "text-center",
                    },
                    {
                        mData: 'clear',
                        "className": "text-center",
                    },
                    {
                        mData: 'second_ball',
                        "className": "text-center",
                    },
                    {
                        mData: 'corner_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'free_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'pk',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_home',
                        "className": "text-center",
                    },
                    {
                        mData: 'tackle_overhead_guest',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_kick_goal',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_lose',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_kick',
                        "className": "text-center",
                    },
                    {
                        mData: 'save_penalty',
                        "className": "text-center",
                    },
                    {
                        mData: 'punching',
                        "className": "text-center",
                    },
                    {
                        mData: 'pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'guest_pass',
                        "className": "text-center",
                    },
                    {
                        mData: 'contribute',
                        "className": "text-center",
                    },
                  ],
                    drawCallback: () => {
                      $('#box_score_personal tbody').append(`
                        <tr class="bg02 line"><td></td><td></td><td>TOTALS</td><td></td>
                          <td>${response.sum.goal}</td><td>${response.sum.kick}</td><td>${response.sum.kick_goal}</td><td>${response.sum.assist}</td>
                          <td>${response.sum.last_pass}</td><td>${response.sum.cross}</td><td>${response.sum.pass_dribble}</td><td>${response.sum.fouled}</td>
                          <td>${response.sum.tackle}</td><td>${response.sum.steal}</td><td>${response.sum.intercept}</td><td>${response.sum.shoot_block}</td>
                          <td>${response.sum.cross_block}</td><td>${response.sum.foul}</td><td>${response.sum.clear}</td><td>${response.sum.second_ball}</td>
                          <td>${response.sum.corner_kick}</td><td>${response.sum.free_kick}</td><td>${response.sum.pk}</td><td>${response.sum.tackle_overhead_home}</td>
                          <td>${response.sum.tackle_overhead_guest}</td><td>${response.sum.guest_kick}</td><td>${response.sum.guest_kick_goal}</td><td>${response.sum.guest_lose}</td><td>${response.sum.save_kick}</td>
                          <td>${response.sum.save_penalty}</td><td>${response.sum.punching}</td><td>${response.sum.pass}</td><td>${response.sum.guest_pass}</td>
                          <td>${response.sum.contribute}</td>
                        </tr>
                        <tr class="bg03"><td></td><td></td><td>AVG</td><td></td>
                          <td>${response.avg.goal}</td><td>${response.avg.kick}</td><td>${response.avg.kick_goal}</td><td>${response.avg.assist}</td>
                          <td>${response.avg.last_pass}</td><td>${response.avg.cross}</td><td>${response.avg.pass_dribble}</td><td>${response.avg.fouled}</td>
                          <td>${response.avg.tackle}</td><td>${response.avg.steal}</td><td>${response.avg.intercept}</td><td>${response.avg.shoot_block}</td>
                          <td>${response.avg.cross_block}</td><td>${response.avg.foul}</td><td>${response.avg.clear}</td><td>${response.avg.second_ball}</td>
                          <td>${response.avg.corner_kick}</td><td>${response.avg.free_kick}</td><td>${response.avg.pk}</td><td>${response.avg.tackle_overhead_home}</td><td>${response.avg.tackle_overhead_guest}</td>
                          <td>${response.avg.guest_kick}</td><td>${response.avg.guest_kick_goal}</td><td>${response.avg.guest_lose}</td><td>${response.avg.save_kick}</td>
                          <td>${response.avg.save_penalty}</td><td>${response.avg.punching}</td><td>${response.avg.pass}</td><td>${response.avg.guest_pass}</td>
                          <td>${response.avg.contribute}</td>
                        </tr>
                        `);
                    },
                    fixedColumns: {
                      leftColumns: 4,
                    },
                });
              } else {
                $("#box_score_personal").DataTable({
                  "order": [],
                  data: response.data,
                  ordering: true,
                  responsive: true,
                  autoWidth: true,
                  lengthChange: false,
                  searching: false,
                  info: false,
                  paging: false,
                  columnDefs: [{ type: 'sort-numbers-ignore-text', targets : 0 }],
                  aoColumns: [
                    {
                        mData: 'number_official',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (row.number_official) {
                              return row.number_official;
                            };
                            return '?';
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            if (type == 'sort') {
                            if (data == 'MF') return 3;
                            else if(data == 'GK') return 1;
                            else if(data == 'DF') return 2;
                            else if(data == 'FW') return 4;
                            else if(data == '?') return 5;
                          } else {
                            if (row.position_name) {
                              return row.position_name;
                            };
                            return '?';
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        "render": function (data, type, row) {
                          if (row.member_id == -1 || row.member_id == -2) {
                            return '仮選手';
                          } else if (row.first_name == null && row.last_name == null) {
                            return '?';
                          } else {
                            return (row.first_name != null ? row.first_name : '') + ' ' + (row.last_name != null ? row.last_name : '');
                          }
                        },
                    },
                    {
                        mData: 'position_name',
                        "className": "text-center",
                        render: function (data, type, row, meta) {
                            return '90分';
                        }
                    },
                    {
                        mData: 'ratio_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_kick_goal',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_kick_goal + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_home',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_home + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle_overhead_guest',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle_overhead_guest + '%'
                        },
                    },
                    {
                        mData: 'ratio_pass_dribble',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_pass_dribble + '%'
                        },
                    },
                    {
                        mData: 'ratio_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_tackle',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_tackle + '%'
                        },
                    },
                    {
                        mData: 'ratio_clear',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_clear + '%'
                        },
                    },
                    {
                        mData: 'ratio_second_ball',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_second_ball + '%'
                        },
                    },
                    {
                        mData: 'ratio_save',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_save + '%'
                        },
                    },
                    {
                        mData: 'ratio_catch_cross',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_catch_cross + '%'
                        },
                    },
                    {
                        mData: 'ratio_lose',
                        "className": "text-center",
                        "render": function (data, type, row) {
                            return row.ratio_lose + '%'
                        },
                    },
                  ],
                  drawCallback: () => {
                    $('#box_score_personal tbody').append(`
                      <tr class="bg03"><tr class="bg03 line"><td></td><td></td><td>AVG</td><td></td>
                      <td>${response.avg.ratio_goal}%</td><td>${response.avg.ratio_kick_goal}%</td><td>${response.avg.ratio_tackle_overhead_home}%</td>
                      <td>${response.avg.ratio_tackle_overhead_guest}%</td><td>${response.avg.ratio_pass_dribble}%</td><td>${response.avg.ratio_cross}%</td>
                      <td>${response.avg.ratio_tackle}%</td><td>${response.avg.ratio_clear}%</td><td>${response.avg.ratio_second_ball}%</td>
                      <td>${response.avg.ratio_save}%</td><td>${response.avg.ratio_catch_cross}%</td><td>${response.avg.ratio_lose}%</td>
                      `);
                  },
                  fixedColumns: {
                    leftColumns: 4,
                  },
                });
              }
            }
          },
          error: function(err) {
          },
          complete: function(data) {
            firstLoadStat = 1;
            showPopupLoading(false);

          }
      });
    };

    $('input[name="round_team"]').change(function() {
      $('#team_time1').empty();
      $('#team_time2').empty();
      $('#team_time3').empty();
      $('#team_time4').empty();
      $('#team_time5').empty();
      $('#team_time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time_team" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_team" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_team" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_team" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#team_time'+round).append(html);
      }
      $('#team').empty()
      const tabIndex = document.querySelector("select[name=team_type]").value;
      get_value_box_score_team(tabIndex);
    });

    $('body').on('change', 'input[name="sub_time_team"]', function() {
      $('#team').empty()
      const tabIndex = document.querySelector("select[name=team_type]").value;
      get_value_box_score_team(tabIndex);
    });

    $('select[name="team_type"]').change(function() {
      $('#team').empty()
      const tabIndex = document.querySelector("select[name=team_type]").value;
      get_value_box_score_team(tabIndex);

    })

    get_value_box_score_team(1);

    let timeout;
    let resizePC = 0, resizeSP = 0;
    $(window).width() <= 768 ? resizeSP = 1: resizePC = 1;
    $(window).on('resize', function () {
      clearTimeout(timeout);
      timeout = setTimeout(function() {
        if ($(window).width() <= 768) {
          resizePC = 0;
          resizeSP ++;
          if(resizeSP == 1) {
            var table = $(".tblScroll .tblList");
            table.each((index, ele) => {
                $(ele).DataTable().destroy();
            })
            let tabIndex = $('input[name="personal_type"]:checked').attr('data-tab');
            render_box_score_personal(tabIndex);
          }
        } else {
          resizeSP = 0;
          resizePC ++;
          if(resizePC == 1) {
            var table = $(".tblScroll .tblList");
            table.each((index, ele) => {
                $(ele).DataTable().destroy();
            })
            let tabIndex = $('input[name="personal_type"]:checked').attr('data-tab');
            render_box_score_personal(tabIndex);
          }
        }
      }, 300);
    });
  }
  if (window.current_page == 'scorebook_matches_chart') {
    var data_stats      = '';
    var data_match      = '';
    var data_team_home  = '';
    var data_team_guest = '';
    var opt_team_home   = '';
    var opt_team_guest  = '';
    var data_team_1     = '';
    var data_team_2     = '';
    var member_team_1   = '';
    var member_team_2   = '';
    var rounds  = {1 : '_1ST', 2 : '_2ND', 3 : '_3RD', 4 : '_4TH', 5 : '_EXT1', 6 : '_EXT2'};
    var items   = {'itemL' : 16, 'itemR': 19, 'itemBot' : 17, 'itemBot last' : 18};
    var zones   = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
    get_value_short_chart();
    function get_value_short_chart() {
      $.ajax({
        url: "/scorebook/matches/"+get_id_url_scorebook_chart()+"/chart/short_chart",
        type: "post",
        success: function(response) {
          data_stats      = response.stats;
          data_match      = response.match;
          data_team_home  = response.arr_member_home;
          data_team_guest = response.arr_member_guest;
          opt_team_home   = response.opt_member_home;
          opt_team_guest  = response.opt_member_guest;
          data_team_1     = response.team_1;
          data_team_2     = response.team_2;
          member_team_1   = response.member_team_1;
          member_team_2   = response.member_team_2;
          //Append name team in HTML select
          $("#team_shoot_chart .option-team-1").text(data_team_1.name);
          $("#team_shoot_chart .option-team-2").text(data_team_2.name);
          render_chart();
          render_short_chart(1);
          render_shoot_chart();
        },
        error: function(err) {
        }
      });
    }
    function get_id_url_scorebook_chart() {
      var url = window.location.href;
      var last = url.indexOf("/chart");
      var first = url.indexOf("matches/");
      var id = url.substring(first+8, last);
      return id;
    }

    const labels = [
      '得点',
      'シュート数',
      '枠内シュート数',
      'カット数',
      'ファウル数',
    ];
    const labels2 = [
      '被ファウル',
      'コーナーキック数',
      'ゴールキック',
      'フリーキック数',
      'クロス数',
    ];

    function render_chart() {
      var round         = document.querySelector('input[name="round"]:checked').value;
      var sub_time      = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
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
      var member_anonymous_id1 = -1;
      var member_anonymous_id2 = -2;
      var box_score_team1      = boxScoreTeamNumber(data_stats, member_team_1, data_team_1, round, time, sub_time, null, member_anonymous_id1);
      var box_score_team2      = boxScoreTeamNumber(data_stats, member_team_2, data_team_2, round, time, sub_time, null, member_anonymous_id2);
      let data = {
        "data1": [box_score_team1.goal, box_score_team1.kick, box_score_team1.kick_goal, box_score_team1.cut_ball, box_score_team1.foul],
        "data2": [box_score_team2.goal, box_score_team2.kick, box_score_team2.kick_goal, box_score_team2.cut_ball, box_score_team2.foul],
      }
      let data2 = {
        "data1": [box_score_team1.fouled, box_score_team1.corner_kick, box_score_team1.penalty_golf, box_score_team1.free_kick, box_score_team1.cross],
        "data2": [box_score_team2.fouled, box_score_team2.corner_kick, box_score_team2.penalty_golf, box_score_team2.free_kick, box_score_team2.cross],
      }
      if($("#myChart").length) {
        const myChart = new Chart(
          document.getElementById('myChart').getContext('2d'),
          chartConfig(data, labels, data_team_1.color_team, data_team_2.color_team)
        );
      }
      if($("#myChart2").length) {
        const myChart2 = new Chart(
          document.getElementById('myChart2').getContext('2d'),
          chartConfig(data2, labels2, data_team_1.color_team, data_team_2.color_team),
        );
      }
    }

    $('input[name="round"]').change(function() {
      $('#team_time1').empty();
      $('#team_time2').empty();
      $('#team_time3').empty();
      $('#team_time4').empty();
      $('#team_time5').empty();
      $('#team_time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#team_time'+round).append(html);
      }
      render_infrastructure_chart();
      render_chart();
    });

    $('body').on('change', 'input[name="sub_time"]', function() {
      render_infrastructure_chart();
      render_chart();
    });

    function render_infrastructure_chart()
    {
      $('#blockChart').empty();
      var html = `<div class="blockChart__item">
                    <canvas id="myChart" width="494" height="560"></canvas>
                </div>
                <div class="blockChart__item">
                    <canvas id="myChart2" width="494" height="560"></canvas>
                </div>`;
      $('#blockChart').append(html);
    }

    $('input[name="round_chart"]').change(function() {
      $('#chart_time1').empty();
      $('#chart_time2').empty();
      $('#chart_time3').empty();
      $('#chart_time4').empty();
      $('#chart_time5').empty();
      $('#chart_time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time_chart" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_chart" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_chart" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_chart" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#chart_time'+round).append(html);
      }
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('body').on('change', 'input[name="sub_time_chart"]', function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('select[name="team"]').change(function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      if (team == '1') {
        let htmlColumn = `<option value="0">全ての選手</option>`
        htmlColumn += Object.values(opt_team_home).map(value => {
          if(value.number_official && (value.first_name || value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
        htmlColumn += `<option value="-1">? 仮選手</option>`
        $('#personal').find('option').remove().end().append(htmlColumn);
      } else {
        let htmlColumn = `<option value="0">全ての選手</option>`
        htmlColumn += Object.values(opt_team_guest).map(value => {
          if(value.number_official && (value.first_name || value.last_name)) {
             return `<option value="${value.member_id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
        htmlColumn += `<option value="-1">? 仮選手</option>`
        $('#personal').find('option').remove().end().append(htmlColumn);
      };
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
          if(actionMode == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        } else if (actionZone == 'remove') {
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        }
    });

    $('select[name="personal"]').change(function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('.handledRemoveZone').on("click", function(e) {
      e.preventDefault();
      var actionZone = $(this).attr('data-action');
        if(actionZone == 'show') {
          $('.handledZone').removeClass('active');
          $(this).attr('data-action','remove')
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = [];
          $(this).find('span').text('全てのZONEを選択')
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
          }
        }
        else if (actionZone == 'remove') {
          $('.handledZone').addClass('active');
          $(this).attr('data-action','show')
          $(this).find('span').text('全てのZONEを解除')
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            renderCoordinate(team, personal);
          }
        }
      });

    $('.handledSwitchMode').on("click", function(e) {
      e.preventDefault();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      if(actionZone == 'show') {
        if ($(this).attr('data-action') == 'ratio') {
          for (var i = 1; i < 6; i++) {
            var classLv  = 'level' + i;
            $('.handledScore').removeClass(classLv);
          }
          $('.handledScore').text('');
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          renderCoordinate(team, personal);
          $(this).attr('data-action','coordinate')
          $(this).find('span').text('マップ表示に切り替え')
        } else if($(this).attr('data-action') == 'coordinate') {
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
          render_short_chart(team, personal);
          $(this).attr('data-action','ratio');
          $(this).find('span').text('座標表示に切り替え');
        }
      } else if (actionZone == 'remove') {
        if ($(this).attr('data-action') == 'ratio') {
          for (var i = 1; i < 6; i++) {
            var classLv  = 'level' + i;
            $('.handledScore').removeClass(classLv);
          }
          $('.handledScore').text('');
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          renderCoordinate(team, personal);
          $(this).attr('data-action','coordinate')
          $(this).find('span').text('マップ表示に切り替え')
        } else if($(this).attr('data-action') == 'coordinate') {
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          render_short_chart(team, personal);
          $(this).attr('data-action','ratio');
          $(this).find('span').text('座標表示に切り替え');
        }
      }
    });

    $('.handledZone').on("click", function(e) {
      e.preventDefault();
      var check = $(this).attr('data-action');
      if(check == 'dataZone') {
        var data = $(this).attr('data-zone');
        var team = $('#team').find(":selected").val();
        var personal = $('#personal').find(":selected").val();
        if ($(this).hasClass( "active" )) {
          zones = zones.filter(e => e !== data);
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        } else {
          zones.push(data);
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        }
        $(this).toggleClass('active');
      }
    });

    function render_short_chart(team, personal = 0) {
      $('#block').empty();
      $('#goalNumber').empty();
      var round = document.querySelector('input[name="round_chart"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time_chart"]:checked').value;
      }
      var html      = '';
      var block     = `<div class="layoutLeft">
                            <div class="layoutItem__zone layout-item__lef">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutTop">
                            <div class="layoutItem__zone layoutItem__lef">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                            <div class="layoutItem__zone layoutItem__right">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutRight">
                            <div class="layoutItem__zone layout-item__bottom">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutMiddle">
                            <div class="goalNumbers" >
                                <div class="goalNumbers__wrap" id="goalNumber">
                                </div>
                            </div>
                        </div>`;
      $('#block').html(block);
      for (var i = 1; i <= 15; i++) {
        html = html + `<div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.ratio)))}">
                            <div class="goalRatio">
                                ${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span>
                            </div>
                            <div class="goalValue">(${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.total))})</div>
                        </div>`;
      };
      $('#goalNumber').html(html);
    }

    function goalNumberAnalysisPersonal(number, team, member, round, sub_time, comp = () => undefined) {
      var counterTotal = 0;
      var counterValue = 0;
      var data_team    = team == 1 ? data_team_home : data_team_guest;
      var anonymous_id = team == 1 ? -1 : -2;
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
      if (member == 0) {
        $.each( data_stats, function( key, stat ) {
          if (round != 0) {
            if (stat.created_at_round == rounds[round]) {
              if (sub_time == 1) {
                if (stat.timer_at <= ms_in_round1) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else if (sub_time == 2) {
                if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else if (sub_time == 3) {
                if (stat.timer_at > ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                  counterTotal ++;

                  if (!!stat.result) {
                      counterValue ++;
                  }
                }
              }
            }
          } else {
            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
              counterTotal ++;

              if (!!stat.result) {
                  counterValue ++;
              }
            }
          }
        });

        return comp({
          ratio: roundNumberProbability(counterValue / counterTotal),
          total: counterTotal,
          value: counterValue,
        });
      } else {
        $.each( data_stats, function( key, stat ) {
          if (round != 0) {
            if (stat.created_at_round == rounds[round]) {
              if (sub_time == 1) {
                if (stat.timer_at <= ms_in_round1) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else if (sub_time == 2) {
                if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else if (sub_time == 3) {
                if (stat.timer_at > ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    counterTotal ++;

                    if (!!stat.result) {
                        counterValue ++;
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                  counterTotal ++;

                  if (!!stat.result) {
                      counterValue ++;
                  }
                }
              }
            }
          } else {
            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
              counterTotal ++;

              if (!!stat.result) {
                  counterValue ++;
              }
            }
          }
        });

        return comp({
          ratio: roundNumberProbability(counterValue / counterTotal),
          total: counterTotal,
          value: counterValue,
        });
      }
    }

    function renderCoordinate(team, member) {
      $('#block').empty();
      $('#goalNumber').empty();
      var round = document.querySelector('input[name="round_chart"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time_chart"]:checked').value;
      }
      var html      = '';
      var block     = '';
      var blockChild = '';

      $.each( items, function( key, item ) {
        if(key == 'itemBot' || key == 'itemBot last') {
          if(key == 'itemBot') {
            blockChild += `
              <div class="layoutItem__zone layoutItem__lef">
                  <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                  </div>
              </div>
            `;
          } else {
            blockChild += `
            <div class="layoutItem__zone layoutItem__right">
                <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                </div>
            </div>
          `;
          }
        } else {
            block += `
              <div class="${key == 'itemL'? 'layoutLeft' : 'layoutRight'}">
                <div class="layoutItem__zone layout-item__lef">
                  <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                  </div>
                </div>
              </div>
            `
        }
      });
      block += `
        <div class="layoutTop">
          ${blockChild}
        </div>
        <div class="layoutMiddle">
          <div class="goalNumbers">
              <div class="goalNumbers__wrap" id="goalNumber">
              </div>
          </div>
        </div>`
      $('#block').html(block);
      for (var i = 1; i <= 15; i++) {
        html = html + `<div
        class="goalNumbers__item goalNumber${i}"></div>`
      };
      $('#goalNumber').html(html);
      for (var i = 1; i <= 19; i++) {
        goalNumberAnalysisCoordinate(i, team, member, round, sub_time)
      };
    }

    function goalNumberAnalysisCoordinate(number, team, member, round, sub_time, comp = () => undefined) {
      if (member == 0) {
        var data_team     = team == 1 ? data_team_home : data_team_guest;
        var anonymous_id  = team == 1 ? -1 : -2;
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
        $.each(data_stats, function(key, stat) {
          if (round != 0) {
            if (stat.created_at_round == rounds[round]) {
              if (sub_time == 1) {
                if (stat.timer_at <= ms_in_round1) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else if (sub_time == 2) {
                if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else if (sub_time == 3) {
                if (stat.timer_at > ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                  setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                }
              }
            }
          } else {
            if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
              setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
            }
          }
        });

      } else {
        $.each(data_stats, function(key, stat) {
          if (round != 0) {
            if (stat.created_at_round == rounds[round]) {
              if (sub_time == 1) {
                if (stat.timer_at <= ms_in_round1) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else if (sub_time == 2) {
                if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else if (sub_time == 3) {
                if (stat.timer_at > ms_in_round2) {
                  if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                    setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                  setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                }
              }
            }
          } else {
          if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
              setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
            }
          }
        });
      }
    }
    /**
     * Shoot chart
     */
    $('input[name="round_shoot_chart"]').change(function() {
      $('#shoot_chart_time1').empty();
      $('#shoot_chart_time2').empty();
      $('#shoot_chart_time3').empty();
      $('#shoot_chart_time4').empty();
      $('#shoot_chart_time5').empty();
      $('#shoot_chart_time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time_shoot_chart" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_shoot_chart" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_shoot_chart" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time_shoot_chart" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#shoot_chart_time'+round).append(html);
      }
      var team = $('#team_shoot_chart').find(":selected").val();
      var personal = $('#personal_shoot_chart').find(":selected").val();
      render_shoot_chart(team, personal);
    });

    $('body').on('change', 'input[name="sub_time_shoot_chart"]', function() {
      var team = $('#team_shoot_chart').find(":selected").val();
      var personal = $('#personal_shoot_chart').find(":selected").val();
      render_shoot_chart(team, personal);
    });

    $('select[name="team_shoot_chart"]').change(function() {
      $('#personal_shoot_chart').find('option').remove(); //Reset select member team
      
      var team = $('#team_shoot_chart').find(":selected").val();
      var personal = $('#personal_shoot_chart').find(":selected").val();
      if (team == '1') {
        let htmlColumn = `<option value="0">全ての選手</option>`
        htmlColumn += Object.values(opt_team_home).map(value => {
          if(value.number_official && (value.first_name || value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
        htmlColumn += `<option value="-1">? 仮選手</option>`
        $('#personal_shoot_chart').find('option').remove().end().append(htmlColumn);
      } else {
        let htmlColumn = `<option value="0">全ての選手</option>`
        htmlColumn += Object.values(opt_team_guest).map(value => {
          if(value.number_official && (value.first_name || value.last_name)) {
             return `<option value="${value.member_id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.member_id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
        htmlColumn += `<option value="-1">? 仮選手</option>`
        $('#personal_shoot_chart').find('option').remove().end().append(htmlColumn);
      };
      render_shoot_chart(team, personal);
    });

    $('select[name="personal_shoot_chart"]').change(function() {
      var team     = $('#team_shoot_chart').find(":selected").val();
      var personal = $('#personal_shoot_chart').find(":selected").val();
      render_shoot_chart(team, personal);
    });

    $("input[name='toggle[]']").change(function() {
      var team     = $('#team_shoot_chart').find(":selected").val();
      var personal = $('#personal_shoot_chart').find(":selected").val();
      if ($(this).is(":checked")) {
        $(this).attr('checked', true);
      } else {
        $(this).removeAttr('checked');
      }
      
      render_shoot_chart(team, personal);
    });

    function render_shoot_chart(team, personal = 0) {
      let shootStats = filterShootChart(team, personal, rounds, data_match, data_stats, member_team_1, member_team_2);
      
      return analysisArrow(team, shootStats);
    }
  }

  if (window.current_page == 'period_aggregation_chart') {

    var data_stats            = '';
    var data_match            = '';
    var data_member_home      = '';
    var data_member_guest     = '';
    var data_member_home_id   = '';
    var data_member_guest_id  = '';
    var rounds            = {1 : '_1ST', 2 : '_2ND', 3 : '_3RD', 4 : '_4TH', 5 : '_EXT1', 6 : '_EXT2'};
    var items             = {'itemL' : 16, 'itemR': 19, 'itemBot' : 17, 'itemBot last' : 18};
    var zones             = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
    get_value_short_chart();
    function get_value_short_chart() {
      var round    = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var params = {
          date_from : getUrlVars()["date_from"],
          date_to   : getUrlVars()["date_to"],
          team      : getUrlVars()["team"],
          type      : getUrlVars()["type"],
      };
      $.ajax({
        url: "/period_aggregation/chart/get_stats",
        type: "post",
        data: params,
        success: function(response) {
          data_stats            = response.stats;
          data_match            = response.match;
          data_team_home        = response.member_home;
          data_team_guest       = response.member_guest;
          data_member_home_id   = response.member_home_id;
          data_member_guest_id  = response.member_guest_id;
          let htmlColumn = `<option value="0">全ての選手</option>`;
          htmlColumn += Object.values(data_team_home).map(value => {
            if(value.number_official && value.first_name || value.last_name) {
               return `<option value="${value.id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
            } else if (value.number_official && !(value.first_name + value.last_name)) {
              return `<option value="${value.id}">${value.number_official+' ?'}</option>`;
            }
          }).join('');
          htmlColumn += `<option value="-1">? 仮選手</option>`;
          $('#personal').find('option').remove().end().append(htmlColumn);
          render_short_chart(1);
        },
        error: function(err) {
        }
      });
    }

    function render_short_chart(team, personal = 0) {
      // $('#block').empty();
      $('#goalNumber').empty();
      var round = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var html      = '';
      var block     = '';
      block += `<div class="layoutLeft">
                            <div class="layoutItem__zone layout-item__lef">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(16, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutTop">
                            <div class="layoutItem__zone layoutItem__lef">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(17, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                            <div class="layoutItem__zone layoutItem__right">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goal-value">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(18, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutRight">
                            <div class="layoutItem__zone layout-item__bottom">
                                <div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.ratio)))}">
                                    <div class="goalRatio">${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span></div>
                                    <div class="goalValue font-barlow-semi">(${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(19, team, personal, round, sub_time, (data) => (data.total))})</div>
                                </div>
                            </div>
                        </div>
                        <div class="layoutMiddle">
                            <div class="goalNumbers" >
                                <div class="goalNumbers__wrap" id="goalNumber">
                                </div>
                            </div>
                        </div>`;
      $('#block').html(block);
      for (var i = 1; i <= 15; i++) {
        html = html + `<div class="goalNumbers__item ${render_color_short_chart(goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.ratio)))}">
                            <div class="goalRatio">
                                ${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.ratio))} <span class="goalValue">%</span>
                            </div>
                            <div class="goalValue">(${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.value))}/${goalNumberAnalysisPersonal(i, team, personal, round, sub_time, (data) => (data.total))})</div>
                        </div>`
      };
      $('#goalNumber').html(html);
    }

    function goalNumberAnalysisPersonal(number, team, member, round, sub_time, comp = () => undefined) {
      var counterTotal = 0;
      var counterValue = 0;
      var data_team    = team == 1 ? data_member_home_id : data_member_guest_id;
      var anonymous_id = team == 1 ? -1 : -2;
      $.each( data_match, function( key_match, match ) {
        var time = null;
        if (round == 1) {
            time = match.round1_time;
        } else if (round == 2) {
            time = match.round2_time;
        } else if (round == 3) {
            time = match.round3_time;
        } else if (round == 4) {
            time = match.round4_time;
        } else if (round == 5 || round == 6) {
            time = match.extra_time;
        }
        var ms_in_round1 = time * 60000 / 3;
        var ms_in_round2 = time * 60000 / 3 * 2;
        var total = 0;
        var value = 0;
        if (member == 0) {
          $.each( data_stats, function( key, stat ) {
            if (stat.match_id == match.id) {
              if (round != 0) {
                if (stat.created_at_round == rounds[round]) {
                  if (sub_time == 1) {
                    if (stat.timer_at <= ms_in_round1) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else if (sub_time == 2) {
                    if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else if (sub_time == 3) {
                    if (stat.timer_at > ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else {
                    if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                      total ++;

                      if (!!stat.result) {
                          value ++;
                      }
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                  total ++;
                  if (!!stat.result) {
                      value ++;
                  }
                }
              }
            }
          });
        } else {
          $.each( data_stats, function( key, stat ) {
            if (stat.match_id == match.id) {
              if (round != 0) {
                if (stat.created_at_round == rounds[round]) {
                  if (sub_time == 1) {
                    if (stat.timer_at <= ms_in_round1) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else if (sub_time == 2) {
                    if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else if (sub_time == 3) {
                    if (stat.timer_at > ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        total ++;

                        if (!!stat.result) {
                            value ++;
                        }
                      }
                    }
                  } else {
                    if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                      total ++;

                      if (!!stat.result) {
                          value ++;
                      }
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                  total ++;

                  if (!!stat.result) {
                      value ++;
                  }
                }
              }
            }
          });
        }
        counterTotal += total;
        counterValue += value;
      });
      return comp({
        ratio: roundNumberProbability(counterValue / counterTotal),
        total: counterTotal,
        value: counterValue,
      });
    }

    function renderCoordinate(team, member) {
      $('#block').empty();
      $('#goalNumber').empty();
      var round = document.querySelector('input[name="round"]:checked').value;
      var sub_time = null;
      if (round != 0) {
        sub_time = document.querySelector('input[name="sub_time"]:checked').value;
      }
      var html      = '';
      var block     = '';
      var blockChild = '';

      $.each( items, function( key, item ) {
        if(key == 'itemBot' || key == 'itemBot last') {
          if(key == 'itemBot') {
            blockChild += `
              <div class="layoutItem__zone layoutItem__lef">
                  <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                  </div>
              </div>
            `;
          } else {
            blockChild += `
            <div class="layoutItem__zone layoutItem__right">
                <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                </div>
            </div>
          `;
          }
        } else {
            block += `
              <div class="${key == 'itemL'? 'layoutLeft' : 'layoutRight'}">
                <div class="layoutItem__zone layout-item__lef">
                  <div class="goalNumbers__item handledScore ${key} goalNumber${item}">
                  </div>
                </div>
              </div>
            `
        }
      });
      block += `
        <div class="layoutTop">
          ${blockChild}
        </div>
        <div class="layoutMiddle">
          <div class="goalNumbers">
              <div class="goalNumbers__wrap" id="goalNumber">
              </div>
          </div>
        </div>`
      $('#block').html(block);
      for (var i = 1; i <= 15; i++) {
        html = html + `<div
        class="goalNumbers__item goalNumber${i}"></div>`
      };
      $('#goalNumber').html(html);
      $('#goalNumber').html(html);
      for (var i = 1; i <= 19; i++) {
        goalNumberAnalysisCoordinate(i, team, member, round, sub_time)
      };
    }

    function goalNumberAnalysisCoordinate(number, team, member, round, sub_time, comp = () => undefined) {
      var data_team    = team == 1 ? data_member_home_id : data_member_guest_id;
      var anonymous_id = team == 1 ? -1 : -2;
      $.each( data_match, function( key_match, match ) {
        var time = null;
        if (round == 1) {
            time = match.round1_time;
        } else if (round == 2) {
            time = match.round2_time;
        } else if (round == 3) {
            time = match.round3_time;
        } else if (round == 4) {
            time = match.round4_time;
        } else if (round == 5 || round == 6) {
            time = match.extra_time;
        }
        var ms_in_round1 = time * 60000 / 3;
        var ms_in_round2 = time * 60000 / 3 * 2;
        var total = 0;
        var value = 0;
        if (member == 0) {
          $.each( data_stats, function( key, stat ) {
            if (stat.match_id == match.id) {
              if (round != 0) {
                if (stat.created_at_round == rounds[round]) {
                  if (sub_time == 1) {
                    if (stat.timer_at <= ms_in_round1) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else if (sub_time == 2) {
                    if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else if (sub_time == 3) {
                    if (stat.timer_at > ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else {
                    if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                      setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (!!data_team.includes(stat.member_id) || stat.member_anonymous_id == anonymous_id) && zones.includes(stat.shoot_area_key)) {
                  setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                }
              }
            }
          });
        } else {
          $.each( data_stats, function( key, stat ) {
            if (stat.match_id == match.id) {
              if (round != 0) {
                if (stat.created_at_round == rounds[round]) {
                  if (sub_time == 1) {
                    if (stat.timer_at <= ms_in_round1) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else if (sub_time == 2) {
                    if (stat.timer_at > ms_in_round1 && stat.timer_at <= ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else if (sub_time == 3) {
                    if (stat.timer_at > ms_in_round2) {
                      if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                        setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                      }
                    }
                  } else {
                    if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                      setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                    }
                  }
                }
              } else {
                if (!! [ACTION_MAP.VALUES.KICK.id, ACTION_MAP.VALUES.PK_FREE_KICK.id].includes(stat.action_id) && stat.ball_goal_number === number && (stat.member_id == member || stat.member_anonymous_id == member) && zones.includes(stat.shoot_area_key)) {
                  setCoordinate(stat.ball_goal_number_coord_x, stat.ball_goal_number_coord_y, number);
                }
              }
            }
          });
        }
      });
    }

    $('input[name="round"]').change(function() {
      $('#time1').empty();
      $('#time2').empty();
      $('#time3').empty();
      $('#time4').empty();
      $('#time5').empty();
      $('#time6').empty();
      const round     = $(this).attr('data-tab');
      var html        = `<label class="rbCustom2">
                            <input type="radio" name="sub_time" value="0" data-tab="0"  checked="checked">
                            <span class="checkmark">ALL</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="1" data-tab="1">
                            <span class="checkmark">3/1</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="2" data-tab="2">
                            <span class="checkmark">3/2</span>
                        </label>
                        <label class="rbCustom2">
                            <input type="radio" name="sub_time" value="3" data-tab="3">
                            <span class="checkmark">3/3</span>
                        </label>`;
      if (round != 0) {
        $('#time'+round).append(html);
      }
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('body').on('change', 'input[name="sub_time"]', function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('select[name="team"]').change(function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      let htmlColumn = `<option value="0">全ての選手</option>`;
      if (team == '1') {
          htmlColumn += Object.values(data_team_home).map(value => {
          if(value.number_official && value.first_name || value.last_name) {
            return `<option value="${value.id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
          htmlColumn += `<option value="-1">? 仮選手</option>`;
        $('#personal').find('option').remove().end().append(htmlColumn);
      } else {
          htmlColumn += Object.values(data_team_guest).map(value => {
          if(value.number_official && value.first_name || value.last_name) {
            return `<option value="${value.id}">${value.number_official} ${value.first_name === null ? '' : value.first_name} ${value.last_name === null ? '' : value.last_name}</option>`;
          } else if (value.number_official && !(value.first_name + value.last_name)) {
            return `<option value="${value.id}">${value.number_official+' ?'}</option>`;
          }
        }).join('');
          htmlColumn += `<option value="-2">? 仮選手</option>`;
        $('#personal').find('option').remove().end().append(htmlColumn);
      };
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
          if(actionMode == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        } else if (actionZone == 'remove') {
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        }
    });

    $('select[name="personal"]').change(function() {
      var team = $('#team').find(":selected").val();
      var personal = $('#personal').find(":selected").val();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      var actionMode = $('.handledSwitchMode').attr('data-action');
      if(actionZone == 'show') {
        if(actionMode == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      } else if (actionZone == 'remove') {
        if($('.handledSwitchMode').attr('data-action') == 'ratio') {
          render_short_chart(team, personal);
        } else {
          $('.coordinate').remove();
          renderCoordinate(team, personal);
        }
      }
    });

    $('.handledRemoveZone').on("click", function(e) {
      e.preventDefault();
      var actionZone = $(this).attr('data-action');
        if(actionZone == 'show') {
          $('.handledZone').removeClass('active');
          $(this).attr('data-action','remove')
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = [];
          $(this).find('span').text('全てのZONEを選択')
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
          }
        }
        else if (actionZone == 'remove') {
          $('.handledZone').addClass('active');
          $(this).attr('data-action','show')
          $(this).find('span').text('全てのZONEを解除')
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            renderCoordinate(team, personal);
          }
        }
      });

    $('.handledSwitchMode').on("click", function(e) {
      e.preventDefault();
      var actionZone = $('.handledRemoveZone').attr('data-action');
      if(actionZone == 'show') {
        if ($(this).attr('data-action') == 'ratio') {
          for (var i = 1; i < 6; i++) {
            var classLv  = 'level' + i;
            $('.handledScore').removeClass(classLv);
          }
          $('.handledScore').text('');
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          renderCoordinate(team, personal);
          $(this).attr('data-action','coordinate')
          $(this).find('span').text('マップ表示に切り替え')
        } else if($(this).attr('data-action') == 'coordinate') {
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          zones = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
          render_short_chart(team, personal);
          $(this).attr('data-action','ratio');
          $(this).find('span').text('座標表示に切り替え');
        }
      } else if (actionZone == 'remove') {
        if ($(this).attr('data-action') == 'ratio') {
          for (var i = 1; i < 6; i++) {
            var classLv  = 'level' + i;
            $('.handledScore').removeClass(classLv);
          }
          $('.handledScore').text('');
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          renderCoordinate(team, personal);
          $(this).attr('data-action','coordinate')
          $(this).find('span').text('マップ表示に切り替え')
        } else if($(this).attr('data-action') == 'coordinate') {
          var team = $('#team').find(":selected").val();
          var personal = $('#personal').find(":selected").val();
          render_short_chart(team, personal);
          $(this).attr('data-action','ratio');
          $(this).find('span').text('座標表示に切り替え');
        }
      }
    });

    $('.handledZone').on("click", function(e) {
      e.preventDefault();
      var check = $(this).attr('data-action');
      if(check == 'dataZone') {
        var data = $(this).attr('data-zone');
        var team = $('#team').find(":selected").val();
        var personal = $('#personal').find(":selected").val();
        if ($(this).hasClass( "active" )) {
          zones = zones.filter(e => e !== data);
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        } else {
          zones.push(data);
          if($('.handledSwitchMode').attr('data-action') == 'ratio') {
            render_short_chart(team, personal);
          } else {
            $('.coordinate').remove();
            renderCoordinate(team, personal);
          }
        }
        $(this).toggleClass('active');
      }
    });
  }

  function render_color_short_chart(ratio) {
    if (ratio > 80) {
      return 'level5';
    } else if (ratio > 60) {
      return 'level4';
    } else if (ratio > 40) {
      return 'level3';
    } else if (ratio > 20) {
      return 'level2';
    } else {
      return '';
    }
  }

  function getUrlVars() {
      var vars = [], hash;
      var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
      for(var i = 0; i < hashes.length; i++)
      {
          hash = hashes[i].split('=');
          vars.push(hash[0]);
          vars[hash[0]] = hash[1];
      }
      return vars;
  }

  function randomString(length, chars) {
    let result = '';
    for (let i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
  }

  function roundNumberProbability(number) {
    if (!number) return 0;
    return +(number * 100).toFixed(0);
  }

  function generateRandomNumb(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
  }

  function setCoordinate(coorX, coorY, number) {
    var eleX = '<p class="coordinate" style="top: '+coorY+'%;left: '+coorX+'%;transform: translate(-50%, -60%)"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>';
    $(`.goalNumber${number}`).append(eleX);
  }

  function get_id_url_scorebook_stat() {
    var url = window.location.href;
    var last = url.indexOf("/stat");
    var first = url.indexOf("matches/");
    var id = url.substring(first+8, last);
    return id;
  }

  function get_value_box_score_team(tabIndex) {
    var team_type     = document.querySelector("select[name=team_type]").value;
    var round         = document.querySelector('input[name="round_team"]:checked').value;
    var sub_time      = null;
    if (round != 0) {
      sub_time = document.querySelector('input[name="sub_time_team"]:checked').value;
    }
    var params = {
        round         : round,
        sub_time      : sub_time,
        team_type     : team_type,
    };
    var match_id = get_id_url_scorebook_stat();
    render_horizontal_chart(params, match_id, tabIndex, team_type)
  }

  function render_horizontal_chart(params, match_id, tabIndex, team_type) {
    const columnSelected = BOX_SCORE_TEAM_COLUMN_NAME[tabIndex];
    if (firstLoadStat == 1) {
      showPopupLoading(true);
    }
    $.ajax({
      url: "/scorebook/matches/"+match_id+"/stat/team",
      type: "post",
      data: params,
      success: function (response) {
        var htmlColumn = '';
        if (team_type == 1) {
          htmlColumn = `<li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.goal}</span>
                                <span class="ttl">${columnSelected.columns_name[1]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.goal}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.kick}</span>
                                <span class="ttl">${columnSelected.columns_name[2]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.kick}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.kick_goal}</span>
                                <span class="ttl">${columnSelected.columns_name[3]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.kick_goal}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.assist}</span>
                                <span class="ttl">${columnSelected.columns_name[4]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.assist}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.last_pass}</span>
                                <span class="ttl">${columnSelected.columns_name[5]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.last_pass}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.cross}</span>
                                <span class="ttl">${columnSelected.columns_name[6]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.cross}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.pass_dribble}</span>
                                <span class="ttl">${columnSelected.columns_name[7]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.pass_dribble}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.fouled}</span>
                                <span class="ttl">${columnSelected.columns_name[8]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_1.fouled}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.cut_ball}</span>
                                <span class="ttl">${columnSelected.columns_name[9]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.cut_ball}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.clear}</span>
                                <span class="ttl">${columnSelected.columns_name[10]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.clear}</span>
                            </li>
                            </li><li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.block}</span>
                                <span class="ttl">${columnSelected.columns_name[11]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.block}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.foul}</span>
                                <span class="ttl">${columnSelected.columns_name[12]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.foul}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.second_ball}</span>
                                <span class="ttl">${columnSelected.columns_name[13]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.second_ball}</span>
                            </li><li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.is_pa}</span>
                                <span class="ttl">${columnSelected.columns_name[14]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.is_pa}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.penalty_golf}</span>
                                <span class="ttl">${columnSelected.columns_name[15]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.penalty_golf}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.corner_kick}</span>
                                <span class="ttl">${columnSelected.columns_name[16]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.corner_kick}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.free_kick}</span>
                                <span class="ttl">${columnSelected.columns_name[17]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.free_kick}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.pk}</span>
                                <span class="ttl">${columnSelected.columns_name[18]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.pk}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.tackle_overhead_home}</span>
                                <span class="ttl">${columnSelected.columns_name[19]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.tackle_overhead_home}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.tackle_overhead_guest}</span>
                                <span class="ttl">${columnSelected.columns_name[20]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.tackle_overhead_guest}</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.save}</span>
                                <span class="ttl">${columnSelected.columns_name[21]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.save}</span>
                            </li>`;
        } else {
          htmlColumn = `<li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_goal}%</span>
                                <span class="ttl">${columnSelected.columns_name[1]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_goal}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_kick_goal}%</span>
                                <span class="ttl">${columnSelected.columns_name[2]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_kick_goal}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_tackle_overhead_home}%</span>
                                <span class="ttl">${columnSelected.columns_name[3]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_tackle_overhead_home}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_tackle_overhead_guest}%</span>
                                <span class="ttl">${columnSelected.columns_name[4]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_tackle_overhead_guest}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_pass_dribble}%</span>
                                <span class="ttl">${columnSelected.columns_name[5]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_pass_dribble}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_cross}%</span>
                                <span class="ttl">${columnSelected.columns_name[6]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_cross}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_tackle}%</span>
                                <span class="ttl">${columnSelected.columns_name[7]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_tackle}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_clear}%</span>
                                <span class="ttl">${columnSelected.columns_name[8]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_clear}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_second_ball}%</span>
                                <span class="ttl">${columnSelected.columns_name[9]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_second_ball}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_save}%</span>
                                <span class="ttl">${columnSelected.columns_name[10]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_save}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_catch_cross}%</span>
                                <span class="ttl">${columnSelected.columns_name[11]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_catch_cross}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_goal_play}%</span>
                                <span class="ttl">${columnSelected.columns_name[12]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_goal_play}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_throw}%</span>
                                <span class="ttl">${columnSelected.columns_name[13]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_throw}%</span>
                            </li>
                            <li class="listResult__item">
                                <span class="result team1 ${response.team_1.class_css}" style="border-color: ${response.team_1.color_team}">${response.team_1.ratio_lose}%</span>
                                <span class="ttl">${columnSelected.columns_name[14]}</span>
                                <span class="result team2 ${response.team_2.class_css}" style="border-color: ${response.team_2.color_team}">${response.team_2.ratio_lose}%</span>
                            </li>`;
        }
        htmlColumn = `<ul class="listResult">
                        ${htmlColumn}
                      </ul>`;

        $('#team').html(htmlColumn);
      },
      complete: function (data) {
        if (firstLoadStat == 1) {
          showPopupLoading(false);
        } 
      }
    });
  }

  function checkMobile()
  {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
  }

  function sortNumbersIgnoreText(a, b, high) {
    if (a === '?') {
      return 2;
    }
    var reg = /((\d+(\.\d*)?)|\.\d+)([eE][+-]?[0-9]+)?/;
    a = a.match(reg);
    a = a !== null ? parseFloat(a[0]) : high;
    b = b.match(reg);
    b = b !== null ? parseFloat(b[0]) : high;
    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
  }
});
