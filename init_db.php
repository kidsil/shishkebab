<?php
/* initialize db with dummy data */
require_once('db/db.php');

$messages = array();
$num_of_msgs = 60; //Number of messages to insert
$currencies = array( 'EUR', 'USD', 'GBP', 'CAD', 'AUD' );
$countries = array( 'FR', 'US', 'GB', 'CA', 'AU' );
for ($i = 0; $i < $num_of_msgs; $i++) {
	$random_time = rand(1425168000, 1427846400); //generate unix timestamp from March 1st 2015, to April 1st 2015
	$random_currencies = array_rand($currencies, 2);
	$messages[] = array(
		'userId' => rand(100000,999999), //generates a random 6-digit number (no need to mess around with mt_rand(), we're just inserting some test data)
		'currencyFrom' => $currencies[$random_currencies[0]], //random currency
		'currencyTo'=> $currencies[$random_currencies[1]], //random currency
		'amountSell'=> rand(1,1000), //generates a random number between 1 and 1000 
		'amountBuy'=> rand(10,9999) / 10, //generates a random number between 10 and 9999 and divides by 10 (because I want some bloody cents!)
		'rate'=> rand(5,15) / 10, //generates a number between 5 and 15, and divides it by 10 (so it's 0.5 to 1.5), just to give some random rates.
		'timePlaced' => date('d-M-y H:i:s', $random_time), //generates a date format from the $random_time generated (e.g. 13-Mar-15 12:42:35)
		'originatingCountry' => $countries[array_rand($countries)]
	);
}
global $db;
$db_return = $db->messages->batchInsert($messages);

$return['status'] = 'error';
if ($db_return['ok'] == 0) {
	$return['message'] = 'Error on Insert: ' . $db_return['errmsg'];
} elseif (!empty($db_return['err'])) {
	$return['message'] = 'Error on Insert: ' . $db_return['err'];
} else {
	$return['status'] = 'success';
	$return['message'] = 'Wrote ' . $num_of_msgs . ' new messages to DB';
}
header('Content-Type: application/json');
echo json_encode($return);

?>