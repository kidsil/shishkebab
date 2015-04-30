$(document).ready(function() {
	$('table#messages').tablesorter().tablesorterPager({container: $("#pager")});
	$('#spinner').hide();
	$('table#messages').show();
	jQuery('#graph1').highcharts({
		title: {
			text: 'Rate of EUR/GBP'
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				month: '%d/%m/%Y'
			}
		},
		series: series1
	});

	jQuery('#graph2').highcharts({
		title: {
			text: 'Rate of Multiple Currencies'
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				month: '%d/%m/%Y'
			}
		},
		series: series2
	})

});