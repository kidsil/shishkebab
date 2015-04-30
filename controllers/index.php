<?php
require_once('main.php'); //yes I know we can do this with an outside file that includes main before all controllers, but lets keep this (relatively) simple
class indexController extends mainController {
	function __construct() {
		global $db;
		$this->messages = $db->messages->find();
		$this->messages_count = $db->messages->count();
		$this->messages_currencies = array();
		//Lets have an array of compared currencies, and make a line out of each of them
		$currencies = array(
			'EUR' => 'GBP',
			'USD' => 'EUR',
			'CAD' => 'AUD',
		);
		foreach ($currencies as $curr1 => $curr2) {
			//Yes I know of the [] shorthand instead of array(), but it's only 5.4+ and I'd rather have a longer version that's more compatible for now
			$currency_data = $db->messages->find( array(
				'$or' => array(
					array( '$and' => array(
						array( 'currencyFrom' => $curr1 ),
						array( 'currencyTo'   => $curr2 ),
					) ),
					array( '$and' => array(
						array( 'currencyFrom' => $curr2 ),
						array( 'currencyTo'   => $curr1 ),
					) )
				)
			) )->sort(array('timePlaced' => 1));
			$message_currency = array(
				'name' => $curr1 . ' / ' . $curr2,
				'data' => array()
			);
			foreach ($currency_data as $message) {
				if (!empty($message['timePlaced']) && !empty($message['rate']) && !empty($message['currencyFrom'])) {
					if ( $message['currencyFrom'] == $curr2 ) {
						$message['rate'] = round(1 / $message['rate'], 2); //to keep rate from Currency1 to Currency2 (e.g. 1 USD = 0.5 GBP, but 1 GBP = 2, so we do 1 / 2  to get the relevant rate)
					}
					$message_currency['data'][] = array( strtotime( $message['timePlaced'] ) * 1000, $message['rate'] ); //why * 1000 ? because JS counts Unix Timestamps in milliseconds, awesome I know
				}
			}
			$this->messages_currencies[] = $message_currency;
		}
	}
}