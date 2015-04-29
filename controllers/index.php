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
			'usd' => 'gbp',
			'usd' => 'eur',
			'cad' => 'aud',
		);
		//Yes I know of the [] shorthand instead of array(), but it's only 5.4+ and I'd rather have a longer version that's more compatible for now
		$messages_usd_gbp = $db->messages->find( array(
			'$or' => array(
				array( '$and' => array(
					array( 'currencyFrom' => 'USD' ),
					array( 'currencyTo'   => 'GBP' ),
				) ),
				array( '$and' => array(
					array( 'currencyFrom' => 'GBP' ),
					array( 'currencyTo'   => 'USD' ),
				) )
			)
		) )->sort(array('timePlaced' => 1));
		$this->messages_usd_gbp = array(
			'name' => 'USD / GBP',
			'data' => array()
		);
		foreach ($messages_usd_gbp as $message) {
			if (!empty($message['timePlaced']) && !empty($message['rate']) && !empty($message['currencyFrom'])) {
				if ( $message['currencyFrom'] == 'GBP' ) {
					$message['rate'] = 1 / $message['rate']; //to keep rate from USD to GBP (e.g. 1 USD = 0.5 GBP, but 1 GBP = 2, so we do 1 / 2  to get the relevant rate)
				}
				$this->messages_usd_gbp['data'][] = array( strtotime( $message['timePlaced'] ), $message['rate'] );
			}
		}
		$this->messages_currencies[] = $this->messages_usd_gbp;
	}
}