<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

/**
 * Receives the json data, attempts to insert to DB, and returns a response (error/success)
 *
 * @param  String JSON string to insert to DB
 * @return String JSON string to display to the user (error/success)
 */ 
function receiveMessage($data) {
	require_once('db/db.php');
	global $db;
	$return = array();
	$data = @json_decode($data); //how I hate using "@", it is necessary here though
	$last_error = json_last_error();
	$return['status'] = 'error';
	if ( $data == null ) {
		switch ( $last_error ) {
			case JSON_ERROR_NONE:
			default:
				$return['message'] = 'Unknown error occurred (data is empty after json_decode)';
			break;
			case JSON_ERROR_DEPTH:
				$return['message'] = 'Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
				$return['message'] = 'Invalid or malformed JSON';
			break;
			case JSON_ERROR_CTRL_CHAR:
				$return['message'] = 'Control character error, possibly incorrectly encoded';
			break;
			case JSON_ERROR_SYNTAX:
				$return['message'] = 'JSON Syntax error';
			break;
			case JSON_ERROR_UTF8:
				$return['message'] = 'Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
		}
		return json_encode($return);
	}
	$db_return = $db->messages->insert($data);
	//Handling possible errors
	if ($db_return['ok'] == 0) {
		$return['message'] = 'Error on Insert: ' . $db_return['errmsg'];
	} elseif (!empty($db_return['err'])) {
		$return['message'] = 'Error on Insert: ' . $db_return['err'];
	} else {
		$return['status'] = 'success';
	}

	return json_encode($return);
}

if (!empty($_POST['data'])) {
	header('Content-Type: application/json');
	echo receiveMessage($_POST['data']);
}

?>