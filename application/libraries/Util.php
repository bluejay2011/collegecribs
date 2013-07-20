<?php
Class Util {
	
	function __construct() {

	}

	public static function get_hostname() {
		if(isset($_SERVER['HTTPS'])) {
			$host = 'https://';
		}
		else {
			$host = 'http://';
		}

		return $host . $_SERVER["SERVER_NAME"];
	}
}


?>