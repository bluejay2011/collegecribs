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

	public static function image_link($url = '', $img = '', $alt = '', $param = array(), $active = true, $ssl = false)
    {
        $url    = $ssl ? URL::to_secure($url) : URL::to($url);  
        $img     = HTML::image($img, $alt);
        $link     = $active ? HTML::link($url, '::replace::', $param) : $img;
        return str_replace('::replace::', $img, $link);
    }

}


?>