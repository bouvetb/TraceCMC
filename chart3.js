graphmess(0);
function graphmess(mois){
	Highcharts.chart('container3', {

    title: {
        text: 'Messages pendant le mois '
    },
    chart :{
    	width : 800
    },

    yAxis: {
        title: {
            text: 'Nombres de Messages'
        }
    },

    xAxis: {
        categories: tab_ms_moi[mois][1],
        crosshair: true
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
           
        }
    },

    series: [{
        name: 'Messages',
        data: tab_ms_moi[mois][0],
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 300
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
}