var globalView;
var regiaoView;
$(document).ready(function() {
	
	 globalView = new Highcharts.Chart({
			chart: {
				renderTo: 'container',
				defaultSeriesType: 'line'
			},
			title: {
				text: 'Relátorio de Acesso Anual',
				x: -20 //center
			},
			subtitle: {
				text: 'Fonte: Google Analytics',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 
					'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
			},
			yAxis: {
				title: {
					text: 'Número de Visitas'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				formatter: function() {
		                return '<b>'+ this.series.name +'</b><br/>'+
						this.x +': '+ this.y ;
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 100,
				borderWidth: 0
			},
			series: []
		});
	
	 regiaoView = new Highcharts.Chart({
		chart: {
			renderTo: 'mapa',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: ''
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y + ' visita(s)';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					color: '#000000',
					connectorColor: '#000000',
					formatter: function() {
						return '<b>'+ this.point.name +'</b>: '+ this.y + ' visita(s)';
					}
				}
			}
		},
	    series: []
	});
});

