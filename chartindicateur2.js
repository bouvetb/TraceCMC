Highcharts.chart('container', {
    chart: {
        type: 'column',
        width: 1600
    },
    title: {
        text: '% de participation sur le forum'
    },
    xAxis: {
        categories: tab_nom,
        crosshair: true
    },
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: 'pourcentage'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} % </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: ''+nom,
        data: tab_particip
    }]
});

