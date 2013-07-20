<?php
class GenericFunc {
	
	public function __construct()
	{
	}
  
	public static function getLimits($min = 5,$max=20)
	{
		$list = array();
		for ( $i = $min ; $i <= $max ; $i = $i + $min)
		{	
			$list[$i] = $i;
		}
		
		return $list;
	}
  
} // end of class
?>