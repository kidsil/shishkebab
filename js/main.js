$(document).ready(function() {
	$('table#messages').tablesorter().tablesorterPager({container: $("#pager")});
	$('#spinner').hide();
	$('table#messages').show();
	jQuery('#graph1').highcharts({
		title: {
			text: 'Rate of USD/GBP'
		},
		xAxis: {
			type: 'datetime',
			dateTimeLabelFormats: {
				month: '%d/%m/%Y'
			}
		},
		series: series
	})
});