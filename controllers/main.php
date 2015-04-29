<?php
abstract class mainController {
	public function renderView() {
		ob_start();
		require_once('views/' . str_replace( 'controller', '', strtolower(get_class( $this )) ) . '.php'); //looking for views/main.php in this case
		echo ob_get_clean();
	}
}