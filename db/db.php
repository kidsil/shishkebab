<?php
//Checking if config.php was included, if not, require it
if (!isset($config))
	require_once('config.php');

$connection_string = sprintf('mongodb://%s:%d/%s', $config['db']['host'], $config['db']['port'], $config['db']['dbname']);
$m = new MongoClient($connection_string);
$GLOBALS['db'] = $m->selectDB($config['db']['host']);


?>
