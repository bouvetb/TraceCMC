graphconsult(0);
function graphconsult(mois){
	Highcharts.chart('container7', {

    title: {
        text: 'Consultation pendant le mois ' +intToMonth2(mois)
    },
    chart :{
    	width : 800
    },

    yAxis: {
        title: {
            text: 'Nombre de consultation'
        }
    },

    xAxis: {
        categories: tab_consultMois[mois][1],
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
        name: 'Consultation(s)',
        data: tab_consultMois[mois][0],
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