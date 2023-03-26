import $ from 'jquery'
import app from './app'
import Splide from '@splidejs/splide'
import './components/biggerlink'
import moment from 'moment';

// ---------------------------------------------------------
// Custom Functions for Front-End
// ---------------------------------------------------------
$(document).ready(function() {
      // accordions
      $(".jsAccordion").click(function (e) {
          var elm = $(this)
          if (elm.next(".jsAccordionBox").is(":visible")) {
              elm.removeClass("active")
                  .next(".jsAccordionBox")
                  .slideUp(200)
          } else {
              elm.next(".jsAccordionBox").slideDown(200)
              elm.addClass("active")
          }
          e.preventDefault()
      })
  // toggle menu
  function handlerNavi() {
    if ($(window).width() > 768) {
      $('.jsContentMenu').removeClass('.jsShowNavi');
      $('.jsMenu').removeClass('active');
      $('.jsContentMenu').css({'transition': 'unset'});
    }
  }
  const btnMenu = $('.jsMenu');
  btnMenu.on('click', function() {
    $(this).toggleClass('active');
    $(this).toggleClass('not-active');
    $('.jsContentMenu').toggleClass('jsShowNavi');
    $('#header').toggleClass('fixed');
    if($(this).parents('#header').length) {
      $('html').toggleClass('noScroll');
    }
    if($('.overlay').length) {
      $('.overlay').fadeToggle('fast');
    }
    if(!$('.jsContentMenu').hasClass('jsShowNavi')) {
      $('.jsContentMenu').css({'transition': 'transform 0.3s linear'});
    }
  });

  let timerResize;
  window.addEventListener('resize', function () {
    clearTimeout(timerResize);
    timerResize = setTimeout(handlerNavi, 300);
  });

  $(".tab a").click(function() {
    var elm = $(this);
    var data = $(this).attr('data-round');
    if (!elm.hasClass("active"))
    {
        elm.siblings().removeClass("active");
        elm.addClass("active");
        elm.parents(".tab").next().children(".tabBox").hide();
        $(this.hash).fadeIn();
        if($('.pagePlayVideo').length) {
          $('.pagePlayVideo').attr('data-round_current', data)
        }
    }
    return false;
  });


    // js check all
    $(".jsCheckAll").on("click", function() {
      var checkAll = !$(this)
        .siblings()
        .is(":checked"),
        listCheckbox = $(this)
        .parents(".handledCheckCtrl")
        .find('.jsChecked input[type="checkbox"]');
      if (checkAll) {
        listCheckbox.each(function() {
          $(this).prop("checked", true);
        });
      } else {
        listCheckbox.each(function() {
          $(this).prop("checked", false);
        });
      }
    });
    $('.jsChecked input[type="checkbox"]').on("change", function() {
      var listCheckbox = $(this)
        .parents(".handledCheckCtrl")
        .find('.jsChecked input[type="checkbox"]'),
        count = 0;
      listCheckbox.each(function() {
        if ($(this).prop("checked")) {
          count++;
          // console.log(count)
        }
      });
      if (count == listCheckbox.length) {
        $(this).parents(".handledCheckCtrl").find('.jsCheckAll')
          .siblings()
          .prop("checked", true);
      } else {
        $(this).parents(".handledCheckCtrl").find('.jsCheckAll')
          .siblings()
          .prop("checked", false);
      }
    });

    if (window.current_page == 'preview_scorebook05') {
      //
      var eleDataZ = '<p class="percent"><span>0</span>%</p><p class="rate">(0/0)</p>';
      $('.handledRemoveZone').on("click", function(e) {
        e.preventDefault();
        $('.handledScore').text('');
        $('.coordinate').remove();
        var actionZone = $(this).attr('data-action');
          if(actionZone == 'show') {
            $('.handledZone').removeClass('active');
            $(this).attr('data-action','remove')
            $(this).find('span').text('全てのZONEを選択')
            $('.handledScore').text('');
            for (var i = 0; i < 6; i++) {
              var classLv  = 'level' + i;
              $('.handledScore').removeClass(classLv);
            }
            $('.coordinate').remove();
          }
          else if (actionZone == 'remove') {
              $('.handledZone').addClass('active');
              $(this).attr('data-action','show')
              if($(this).next().attr('data-action') == 'ratio') {
                $(this).find('span').text('全てのZONEを解除')
                $('.handledScore').append(eleDataZ)
              }
              if($(this).next().attr('data-action') == 'coordinate') {
                for (var i = 0; i < 6; i++) {
                  setCoordinate();
                }
              }
          }
        });
      $('.handledSwitchMode').on("click", function(e) {
        e.preventDefault();
        $('.handledZone').addClass('active');
        $('.handledScore').text('');
        $('.coordinate').remove();
        var actionMode = $(this).attr('data-action');
        if(actionMode == 'ratio') {
          $(this).attr('data-action','coordinate')
          $(this).find('span').text('マップ表示に切り替え')
          $('.coordinate').remove();
          $('.handledScore').text('');
          $('.handledZone').attr('data-action','dataCoordinate')
          for (var i = 0; i < 6; i++) {
            var classLv  = 'level' + i;
            $('.handledScore').removeClass(classLv);
            setCoordinate();
          }
        }
        else if(actionMode == 'coordinate') {
          $(this).attr('data-action','ratio');
          $(this).find('span').text('座標表示に切り替え');
          $('.handledZone').attr('data-action','dataZone')
          $('.handledScore').append(eleDataZ);
        }
      });
      function generateRandomNumb(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
      }
      function setCoordinate() {
        var eleX = '<p class="coordinate"><img src="/assets/img/svg/ic_cross.svg" alt=""></p>'
        $('.blockMap__goal').append(eleX);
        $('.coordinate').each(function(idx){
          var rand = generateRandomNumb(20, 800);
          var rand01 = generateRandomNumb(20, 250);
          var coorX = rand,
              coorY = rand01;
          $(this).css({'top': coorY, 'left': coorX})
        })
      }
      $('.handledZone').on("click", function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.handledScore').text('');
        var data = $(this).attr('data-action');
        if(data == 'dataZone') {
          $('.handledScore').append(eleDataZ)
        }
        else {
          $('.coordinate').remove();
          setCoordinate();
        }
      });
    }

    // js splide
    if($('.jsSplide').length) {
      const splide = new Splide( '.splide', {
        updateOnMove: true,
      });

      splide.on( 'move', function ( data ) {
        document.getElementById("numberSlide").innerHTML = data + 1;
      });
      splide.on( 'pagination:mounted', function ( data ) {
        data.list.classList.add( 'splide__pagination--custom' );

        data.items.forEach( function ( item ) {
          item.button.textContent = String( item.page + 1 );
          document.getElementById("numberAllSlide").innerHTML = item.button.textContent;
        } );
      });

      var thumbnails = new Splide( '.jsSplideText', {
        rewind          : true,
        isNavigation    : true,
        focus           : 'center',
        pagination      : false,
        cover           : true,
        dragMinThreshold: {
          mouse: 4,
          touch: 10,
        },
      } );

      splide.sync( thumbnails );
      splide.mount();
      thumbnails.mount();
    }

    let isDown = false;
    let startX;
    let scrollLeft;

    $('.content').on('mousedown',  '.tblScroll .tblScroll__wrap',function(e) {
      isDown = true;
      $(this).addClass('active');
      startX = e.pageX - $(this).offset().left;
      scrollLeft = $(this).scrollLeft();
  });
    $('.content').on('mouseleave', '.tblScroll .tblScroll__wrap', function() {
      isDown = false;
      $(this).removeClass('active');
    });
    $('.content').on('mouseup', '.tblScroll .tblScroll__wrap', function() {
      isDown = false;
      $(this).removeClass('active');
    });
    $('.content').on('mousemove',  '.tblScroll .tblScroll__wrap',function(e) {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - $(this).offset().left;
      const walk = (x - startX) * 3;
      $(this).scrollLeft(scrollLeft - walk);
    });
    $(".pageTop01 a").click(function(e) {
      e.preventDefault()
      $("html, body").animate({ scrollTop : 0 });
      return false;
    });
    $(window).on('load resize scroll', function() {
      if ($(window).width() >= 768) {
        if ($('.pageTop01').length) {
          var pFoot = $('.staticPageTop').offset().top,
            hFooter = $('#footer').height() + $('.staticPageTop').height,
            scroll = $(window).scrollTop();
          if (scroll < 10) {
            $(".pageTop01").fadeOut(200);
            var pos = $(".pageTop01").offset().top;
          } else {
            $(".pageTop01").fadeIn('fast');
          }
          var pos = $(".pageTop01").offset().top;
          if((scroll + $(window).height()) >= pFoot){
            $(".pageTop01 a").removeClass('fixed');
          }else {
            $(".pageTop01 a").addClass('fixed');
          }
        }
      }
    });
});
  var mainH='',
      ftOffset ='';
      if($('#footer').length) {
        $(window).on('load resize', function() {
          mainH = $('#main').innerHeight() - $('#footer').innerHeight(),
          ftOffset = $('#footer').offset().top;
        })
        $(window).on('load', function() {
          if(mainH > ftOffset ) {
            $('#main').addClass('ftPos');
          }
          else {
            $('#main').removeClass('ftPos');
          }
        })
      }
  // date rang picker
$(function() {
    $('input[name=date_from], input[name=date_to], .jsDatePicker').daterangepicker({
      autoUpdateInput: false,
      singleDatePicker: true,
      locale: {
          cancelLabel: 'リセット',
          applyLabel: '決定',
          daysOfWeek: ['日', '月', '火', '水', '木', '金', '土'],
          monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
          fromLabel: 'From',
          toLabel: 'End',
          format: 'YYYY年MM月DD日'
      }
  });
  $('.jsDatePicker').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY年MM月DD日'));
  });

  $('.jsDatePicker').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
  });
});

function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
var headerH;
$(window).on('load resize', function() {
   headerH = $('#header2').innerHeight();
});
$(window).on('load', function (e) {
    var myhash = '#' + getParameterByName('anc', window.location);
        if (myhash != '#' && $(myhash).length > 0) {
            var offTop = $(myhash).offset().top - headerH;
            $('body, html').animate({
                scrollTop: offTop
            }, 500);
            e.preventDefault();
        }
  if($('.topPage').length > 0) {
    $('.navTop a').each(function() {
      var getAnchor = $(this).attr('href');
          getAnchor = getAnchor.replace('/?anc=','#');
          $(this).attr('href',getAnchor)
   });
   $('.navTop a').on("click", function(e) {
     var anchorLink = $(this).attr('href');
     if (anchorLink != '#') {
       var offTop = $(anchorLink).offset().top - headerH;
       $('body, html').stop().animate({scrollTop:offTop}, 500);
     }
     e.preventDefault();
   });
  }
  if($('.jsAnchorLink').length) {
    $('.jsAnchorLink').on("click", function(e) {
       var anchorLink = $(this).attr('href');
       if (anchorLink != '#') {
         var offTop = $(anchorLink).offset().top - 10;
         $('body, html').stop().animate({scrollTop:offTop}, 500);
       }
       e.preventDefault();
     });
  }
    $('.navTop a').on("click", function() {
      $('.jsMenu').removeClass('active');
      $('.jsMenu').removeClass('not-active');
      $('.jsContentMenu').removeClass('jsShowNavi');
      $('.overlay').fadeOut();
    });
});

const handleViewOption = () => {
  const tableEles = document.querySelectorAll('.jsViewOption');
  if(tableEles){
    tableEles.forEach(tableEle => {
      const labelEles = tableEle.querySelectorAll('.rbCustom');
      const groupEles = tableEle.querySelectorAll('.groupOption');
      const inputEles = tableEle.querySelectorAll('.jsInput');
      if(labelEles && groupEles){
        labelEles.forEach(labelEle => {
          labelEle.addEventListener('click', () => {
            groupEles.forEach(groupEle => {
              groupEle.classList.remove('show');
            });
            if(labelEle.nextElementSibling){
              labelEle.nextElementSibling.classList.add('show');
            }
          })
        })
      }
      inputEles.forEach(inputEle => {
        if(inputEle.checked){
          inputEle.parentElement.nextElementSibling.classList.add('show');
        }
      })
    })
  }
}

const handleChartRate = () => {
  const charts  = document.querySelectorAll('.jsChartRate');
  const chartTotal = document.querySelector('.jsChartRateTotal');
  if(charts && chartTotal){
    const barEleTotal1 = chartTotal.querySelector('.team1');
    const barEleTotal2 = chartTotal.querySelector('.team2');
    const numEleTotal1 = barEleTotal1.querySelector('.num');
    const numEleTotal2 = barEleTotal2.querySelector('.num');
    let totalNum1 = 0;
    charts.forEach(chart => {
      const barEle1 = chart.querySelector('.team1');
      const barEle2 = chart.querySelector('.team2');
      const numEle1 = barEle1.querySelector('.num');
      const numEle2 = barEle2.querySelector('.num');
      const num1 = parseFloat(numEle1.textContent);
      if(0 < num1 < 100){
        numEle2.textContent = 100 - num1;
        barEle1.style.width = num1 + '%';
        barEle2.style.width = (100 - num1) + '%';
      }
      totalNum1 += num1;
    })
    totalNum1 = Math.floor(totalNum1 / 6);
    numEleTotal1.textContent = totalNum1;
    numEleTotal2.textContent = 100 - totalNum1;
    barEleTotal1.style.width = totalNum1 + '%';
    barEleTotal2.style.width = (100 - totalNum1) + '%';
  }
}

const handleChartCompare = () => {
  const charts  = document.querySelectorAll('.jsChartCompare');
  if(charts){
    charts.forEach(chart => {
      const team1Ele = chart.querySelector('.team1'),
            team2Ele = chart.querySelector('.team2'),
            num1Ele = team1Ele.querySelector('.num'),
            num2Ele = team2Ele.querySelector('.num'),
            num1 = parseInt(num1Ele.textContent),
            num2 = parseInt(num2Ele.textContent);
      if( team1Ele && num1 && num1 <= 100 && num1 >= 0 ){
        team1Ele.style.height = num1 + '%';
      }
      if( team2Ele && num2 && num2 <= 100 && num2 >= 0 ){
        team2Ele.style.height = num2 + '%';
      }
    })
  }
}

const dataChartCircle = [40, 10, 90, 90, 10, 110, 20, 10, 10, 20];
const labelsChartCircle = [
  'PK',
  'セットプレー直接',
  'セットプレーから',
  'クロスから',
  'スルーパスから',
  'ショートパスから',
  'ロングパスから',
  'ドリブルから',
  'こぼれ球から',
  'その他',
];

const chartCircle1 = (dataChart, dataLabels) => {
  const chart1 = document.getElementById("chartCirclePie1");
  if(chart1){
    const chartCirclePie1 = new Chart(chart1.getContext('2d'), {
      type: 'pie',
      data: {
        labels: dataLabels,
        datasets: [{
          data: dataChart,
          backgroundColor: [
            '#DC56AA',
            '#A56DBE',
            '#F89191',
            '#F2CD38',
            '#E18D2D',
            '#D6AC56',
            '#5EAC7F',
            '#437FBC',
            '#79B9D5',
            '#CCCCCC',
          ],
          borderWidth: 1,
          hoverOffset: 4,
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  }
}

const chartCircle2 = (dataChart, dataLabels) => {
  const chart2 = document.getElementById("chartCirclePie2");
  if(chart2){
    const chartCirclePie2 = new Chart(chart2.getContext('2d'), {
      type: 'pie',
      data: {
        labels: dataLabels,
        datasets: [{
          data: dataChart,
          backgroundColor: [
            '#DC56AA',
            '#A56DBE',
            '#F89191',
            '#F2CD38',
            '#E18D2D',
            '#D6AC56',
            '#5EAC7F',
            '#437FBC',
            '#79B9D5',
            '#CCCCCC',
          ],
          borderWidth: 1,
          hoverOffset: 4,
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        }
      }
   });
  }
}

window.addEventListener('load', function() {
  handleViewOption();
  handleChartRate();
  handleChartCompare();
  chartCircle1(dataChartCircle, labelsChartCircle);
  chartCircle2(dataChartCircle, labelsChartCircle);
});
