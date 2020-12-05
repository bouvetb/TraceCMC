graphco(0);
function graphco(mois){
	Highcharts.chart('container4', {

    title: {
        text: 'Connexions pendant le mois '
    },
    chart :{
    	width : 800
    },

    yAxis: {
        title: {
            text: 'Nombres de Connexions'
        }
    },

    xAxis: {
        categories: tab_co_moi[mois][1],
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
        name: 'Connexions',
        data: tab_co_moi[mois][0],
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