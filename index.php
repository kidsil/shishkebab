<?php
//TODO: implementation of an actual routing system on version 1.5
require_once('db/db.php');
require_once('controllers/index.php');
$index = new indexController();
$index->renderView();