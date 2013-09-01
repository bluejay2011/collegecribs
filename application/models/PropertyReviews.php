<?php

class PropertyReviews extends Eloquent {	
	public static $table = 'property_reviews';
	public static $timestamps = true; //forcing auto
	
	public function Property()
   {
       return $this->belongs_to('Properties');
   }
	 
	public static function getReviews($property_id,$order = "updated_at",$take = 5, $page = 1)
	{
		$offset = $take * ($page - 1);
		$list = array();
		$data = array();
		$revs = PropertyReviews::where("property_id","=", $property_id)
			->order_by($order,"desc")
			->skip($offset)
			->take($take)->get();
		
		foreach($revs as $key => $r)
		{
			$list[$key] = $r->attributes;	
		}
		
		$data["list"] = $list;
		$data["result_count"] =PropertyReviews::where("property_id","=", $property_id)->count();
		$data["pages"] = ceil ( $data["result_count"] / $take ) ;
		$data["page"] = $page;
		return $data;
	} // end function 
	
}