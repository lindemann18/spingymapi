// JavaScript Document

function CargarInformacionGrafica(TituloPrueba, categoria, fecha1, fecha2, fecha3, resultado1,resultado2,resultado3 )
{
	options={
				 chart: {
                type: 'bar'
            },
            title: {
                text: TituloPrueba //Encabezado de la prueba que se realiza
            },
            subtitle: {
                text: 'BioTest'
            },
            xAxis: {
                categories: categoria, //Categoría de la prueba que se va a realizar
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Resultados',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' Porciento'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: fecha1,
                data: [resultado1]
            }, {
                name: fecha2,
                data: [resultado2]
            }, {
                name: fecha3,
                data: [resultado3]
            }]	
		};
	return options;			
}