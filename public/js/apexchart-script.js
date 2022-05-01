var options = {
    series: [{
        name: 'Cash Flow',
        data: [1.45, 5.42, 5.9, -0.42, -12.6, -18.1, -18.2, -14.16, -11.1, -6.09, 0.34, 3.88, 13.07,
            5.8, 2, 7.37, 8.1, 13.57, 15.75, 17.1, 19.8, -27.03, -54.4, -47.2, -43.3, -18.6, -
            48.6, -41.1, -39.6, -37.6, -29.4, -21.4, -2.4
        ]
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            colors: {
                ranges: [{
                    from: -100,
                    to: -46,
                    color: '#F15B46'
                }, {
                    from: -45,
                    to: 0,
                    color: '#FEB019'
                }]
            },
            columnWidth: '80%',
        }
    },
    dataLabels: {
        enabled: false,
    },
    yaxis: {
        title: {
            text: 'Growth',
        },
        labels: {
            formatter: function (y) {
                return y.toFixed(0) + "%";
            }
        }
    },
    xaxis: {
        type: 'datetime',
        categories: [
            '2011-01-01', '2011-02-01', '2011-03-01', '2011-04-01', '2011-05-01', '2011-06-01',
            '2011-07-01', '2011-08-01', '2011-09-01', '2011-10-01', '2011-11-01', '2011-12-01',
            '2012-01-01', '2012-02-01', '2012-03-01', '2012-04-01', '2012-05-01', '2012-06-01',
            '2012-07-01', '2012-08-01', '2012-09-01', '2012-10-01', '2012-11-01', '2012-12-01',
            '2013-01-01', '2013-02-01', '2013-03-01', '2013-04-01', '2013-05-01', '2013-06-01',
            '2013-07-01', '2013-08-01', '2013-09-01'
        ],
        labels: {
            rotate: -90
        }
    }
};

var chart = new ApexCharts(document.querySelector("#dataBuku"), options);
chart.render();



// Data Siswa
var options = {
    series: [{
        name: 'RPL',
        data: [80, 50, 30, 40, 100, 20],
    }, {
        name: 'MMK',
        data: [20, 30, 40, 80, 20, 80],
    }, {
        name: 'TKJ',
        data: [44, 76, 78, 13, 43, 10],
    }],
    chart: {
        height: 230,
        type: 'radar',
        dropShadow: {
            enabled: true,
            blur: 1,
            left: 1,
            top: 1
        }
    },
    // title: {
    //     text: 'Radar Chart - Multi Series'
    // },
    stroke: {
        width: 2
    },
    fill: {
        opacity: 0.1
    },
    markers: {
        size: 0
    },
    xaxis: {
        categories: ['2011', '2012', '2013', '2014', '2015', '2016']
    }
};

var chart = new ApexCharts(document.querySelector("#dataSiswa"), options);
chart.render();



// Data User
var options = {
    series: [{
    name: 'Administrator',
    data: [31, 40, 28, 51, 42, 109, 100]
  }, {
    name: 'Petugas',
    data: [11, 32, 45, 32, 34, 52, 41]
  }],
    chart: {
    height: 270,
    type: 'area'
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth'
  },
  xaxis: {
    type: 'datetime',
    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
  },
  tooltip: {
    x: {
      format: 'dd/MM/yy HH:mm'
    },
  },
  };

  var chart = new ApexCharts(document.querySelector("#dataUser"), options);
  chart.render();
