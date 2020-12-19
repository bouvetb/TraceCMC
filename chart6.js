Highcharts.chart('container6', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Nombre de consulation de cours par Mois'
    },
    xAxis: {
        categories: tab_dateConsult,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nombres'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Consultation(s)</b></td></tr>',
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
        data: tab_nbConsult
    }]
});




