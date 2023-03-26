import $ from 'jquery';
import Chart from 'chart.js/dist/chart.min.js';
import ChartDataLabels from 'chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js';
// $(document).ready(function() {
  const plugin = {
    id: 'plugin',
    beforeDraw: (chart, args, opts) => {
      const {
        ctx,
        chartArea: {
          left,
          bottom
        }
      } = chart;

      ctx.beginPath();
      ctx.rect(left, 0, chart.width, bottom);
      ctx.fillStyle = opts.color || 'white'
      ctx.fill();
    },
    defaults: {
      color: '#FFF'
    }
  }
  export function chartConfig(data, labels, colorTeam1, colorTeam2) {
    let config = {
      type: 'bar',
      data: {
        labels: labels,
        datasets : [
          {
            hidden: false,
            backgroundColor: `${colorTeam1}`,
            borderColor: `${colorTeam1}` == '#FFF'? '#CCC':`${colorTeam1}`,
            // colors:`#F00`,
            colors:`${colorTeam1}` === '#FFF'? '#CCC':`${colorTeam1}`,
            data : data.data1,
            maxBarThickness: 34,
          },
          {
            hidden: false,
            backgroundColor: `${colorTeam2}`,
            borderColor: `${colorTeam2}` == '#FFF'? '#CCC':`${colorTeam2}`,
            colors:`${colorTeam2}` == '#FFF'? '#CCC':`${colorTeam2}`,
            data : data.data2,
            maxBarThickness: 34,
          }
        ],
      },
      options: {
        indexAxis: 'y',
        scales: {
          y: {
            afterFit: (scale) => {
              scale.width = 120;
            },
            grid: {
              borderColor: '#333',
              borderWidth: 2,
              drawOnChartArea: false,
              tickColor: 'transparent',
            },
            ticks: {
              font: function(context) {
                var width = context.chart.width;
                var size = 0;
                width < 340 ? size = 11 : size = 14
                  return {
                    size: size,
                  };
              },
              color: '#333'
            },
          },
          x: {
            grid: {
              borderColor: '#C4C4C4',
              lineWidth: 2,
              borderDash: [4,4],
              drawOnChartArea: true,
              borderDashOffset: 2,
              drawBorder: true,
              tickColor: 'transparent',
            },
            ticks: {
              font: function(context) {
                var width = context.chart.width;
                var size = 0;
                width < 340 ? size = 11 : size = 17
                  return {
                    size: size,
                  };
              },
              color: '#333',
              max: 25,
              stepSize: 5,
            },
            min: 0,
            max: 25,
          },
        },
        responsive: true,
        elements: {
          bar: {
            borderWidth: 2,
          }
        },
        plugins: {
          legend: {
            display: false
          },
          datalabels: {
            formatter: (value) => {
              return value !== 0 ?
                value.toLocaleString() :
                '0'
            },
            anchor: 'start',
            align: function(context) {
              return context.dataset.data[context.dataIndex] < 25 ? 'end' : 'start';
            },
            offset: function(context) {
              var width = context.chart.width;
               return context.dataset.data[context.dataIndex] < 25 ? '' : ( context.dataset.data[context.dataIndex] - 25 ) * ((width - 130) / 25 );
              },
            clamp: true,
            font: function(context) {
              var width = context.chart.width;
              var size = 0;
              width < 340 ? size = 12 : size = 20
                return {
                  size: size,
                };
            },
            // color: function(context) {
            //   return context.dataset.data[context.dataIndex] < 25 ? context.dataset.colors : '#333';
            // }
          }
        },
      },
      plugins: [ChartDataLabels, plugin]
    };
    return config;
  };
  // const labels = [
  //   'ゴール数',
  //   'シュート数',
  //   '枠内シュート数',
  //   'カット数',
  //   'ファウル数',
  // ];
  // const labels2 = [
  //   '被ファウル数',
  //   'コーナーキック数',
  //   'ゴールキック',
  //   'フリーキック数',
  //   'クロス数',
  // ];
  // let data2 = {
  //   "data1": [12, 3, 5, 12, 30],
  //   "data2": [8, 11, 5, 8, 60],
  // }
  // let data = {
  //   "data1":[2, 12, 5, 20, 26],
  //   "data2":[1, 14, 6, 22, 60],
  // }
  // if($("#myChart").length) {
  //   const myChart = new Chart(
  //     document.getElementById('myChart').getContext('2d'),
  //     chartConfig(data, labels)
  //   );
  // }
  // if($("#myChart2").length) {
  //   const myChart2 = new Chart(
  //     document.getElementById('myChart2').getContext('2d'),
  //     chartConfig(data2, labels2)
  //   );
  // }
// });
