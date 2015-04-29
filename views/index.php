<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.21.5/addons/pager/jquery.tablesorter.pager.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	<body>
		<h1>Messages Info</h1>
		<h2>Messages Table (<?php echo $this->messages_count ?>)</h2>
		<div class="table-wrapper">
			<div id="spinner"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span></div>
			<table class="table table-hover table-bordered" id="messages">
				<thead>
					<tr>
						<th>userId <span class="glyphicon glyphicon-sort"></span></th>
						<th>currencyFrom <span class="glyphicon glyphicon-sort"></span></th>
						<th>currencyTo <span class="glyphicon glyphicon-sort"></span></th>
						<th>amountSell <span class="glyphicon glyphicon-sort"></span></th>
						<th>amountBuy <span class="glyphicon glyphicon-sort"></span></th>
						<th>rate <span class="glyphicon glyphicon-sort"></span></th>
						<th>timePlaced <span class="glyphicon glyphicon-sort"></span></th>
						<th>originatingCountry <span class="glyphicon glyphicon-sort"></span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $this->messages as $message ): ?>
						<tr>
							<td><?php echo isset($message['userId']) ? $message['userId'] : '' ?> </td>
							<td><?php echo isset($message['currencyFrom']) ? $message['currencyFrom'] : '' ?> </td>
							<td><?php echo isset($message['currencyTo']) ? $message['currencyTo'] : '' ?> </td>
							<td><?php echo isset($message['amountSell']) ? $message['amountSell'] : '' ?> </td>
							<td><?php echo isset($message['amountBuy']) ? $message['amountBuy'] : '' ?> </td>
							<td><?php echo isset($message['rate']) ? $message['rate'] : '' ?> </td>
							<td><?php echo isset($message['timePlaced']) ? $message['timePlaced'] : '' ?> </td>
							<td><?php echo isset($message['originatingCountry']) ? $message['originatingCountry'] : '' ?> </td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div id="pager">
				<span class="glyphicon glyphicon-menu-left prev"></span>
				<span class="glyphicon glyphicon-menu-right next"></span>
				<select class="pagesize">
					<option selected="selected" value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option  value="40">40</option>
				</select>
			</div>
		</div>
		<h2>Messages Graphs</h2>
		<div id="graph1"></div>
		<script type="text/javascript">
			var series = <?php echo json_encode( $this->messages_currencies ) ?>;
		</script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.21.5/js/jquery.tablesorter.min.js"></script>
		<script>window.jQuery.tablesorter || document.write('<script src="js/jquery.tablesorter.min.js"><\/script>')</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.21.5/addons/pager/jquery.tablesorter.pager.js"></script>
		<script>window.jQuery.tablesorterPager || document.write('<script src="js/jquery.tablesorter.pager.min.js"><\/script>')</script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script>typeof jQuery().modal == 'function' || document.write('<script src="js/bootstrap.min.js"><\/script>')</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/highcharts/4.1.5/highcharts.js" charset="utf-8"></script>
		<script>window.jQuery().highcharts || document.write('<script src="js/highcharts.js"><\/script>')</script>
		<script src="js/main.js"></script>
	</body>
</html>
