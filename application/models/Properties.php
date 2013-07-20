<?php

class Properties extends Eloquent {	
	public static $table = 'properties';
	public static $timestamps = true; //forcing auto
	
	public function property_reviews()
	{
		return $this->has_many('PropertyReviews', 'property_id');
	}


	public function property_images()
	{
		return $this->has_many('PropertyImages', 'property_id');
	}
	 
	public static function search($prop= array(),$limit = 5, $page = 1)
	{
		#todo make this search more flexible	
		$offset = $limit * ($page - 1);
		
		if ( ! isset( $prop["property_type"] ) )
			$prop["property_type"] = 0;
			
		if ( $prop['property_type'] == 0 ) 
		{
			$con = ">=";
			$val = $prop['property_type'];
		}
		else
		{
			$con = "=";
			$val = $prop['property_type'];
		}
		
		if ( $prop['rent_min'] + $prop['rent_max'] == 0 )
		{
			$prop['rent_max'] = 9999999;
		}
		else if ( $prop['rent_min'] > 0 && $prop['rent_max'] == 0 )
		{ 
			$prop['rent_max'] = 9999999;
		}
		
		$p = DB::query("SELECT * FROM properties 
					WHERE is_approved = 1
					AND property_type_id {$con} {$val}
					AND rent_min >= {$prop['rent_min']} 
					AND rent_max <= {$prop['rent_max']}
					AND ( property_description like '%{$prop['address']}%'					
					 OR address like '%{$prop['address']}%'
					 OR city like '%{$prop['address']}%'
					 OR state like '%{$prop['address']}%'
					 OR zip_code like '%{$prop['address']}%' )
					ORDER BY updated_at DESC
					LIMIT {$limit} OFFSET {$offset}  ") ;		
			
		$list = array();
		foreach($p as $key => $value)
		{ 
			$list[$value->id] = $value;
		}
		
		$p = DB::query("SELECT count(*) as ct FROM properties 
					WHERE is_approved = 1
					AND property_type_id {$con} {$val}
					AND rent_min >= {$prop['rent_min']} 
					AND rent_max <= {$prop['rent_max']}
					AND ( property_description like '%{$prop['address']}%'
					 OR address like '%{$prop['address']}%'
					 OR city like '%{$prop['address']}%'
					 OR state like '%{$prop['address']}%'
					 OR zip_code like '%{$prop['address']}%' )") ;		
		
		$data = array();
		$data["list"] = $list;
		$data["result_count"] = $p[0]->ct;
		$data["pages"] = ceil ( $p[0]->ct / $limit ) ;
		$data["page"] = $page;
		return $data;
	} // end of search
	
	public static function getProperty($id)
	{
		$list = array();
		$p = Properties::find($id);
		
		if ( isset($p) )
		{
			$list = $p->attributes;
			$list["address_line1"] = ucwords($list['address']);
			$list["address_line2"] = ucwords("{$list['city']}, {$list['state']}");
			$list["address_full"] = "{$list['address_line1']}, {$list['address_line2']}";
			$list["contact_full"] = "{$list['contact_number']} look for {$list['contact_person']}";
		}
		
		return $list;
	} // end of getProperty
	
	public static function getCrib($id)
	{
		return Properties::getProperty($id);
	} // end of getCrib // alias of getProperty
	
	public static function getNearProperty($crib_id,$city,$state, $take = 3)
	{
		$list = array();
		$id = array();
		
		$order = ( rand(1,4) > 2  ) ? "updated_at" : "id" ;
		$sort = ( rand(1,4) > 2 ) ? "ASC" :  "DESC" ;
		
		$id[] = intval($crib_id); // dont include reference crib
		$crib = Properties::where("city", "like", "%{$city}%")
			->where_not_in("id", $id)
			->order_by( $order , $sort)
			->take($take)->get();	
			
		foreach ($crib as $key => $value)
		{	
			$id[] = $value->attributes['id'];
			$value->attributes["review_count"] = Properties::find($value->attributes['id'])->property_reviews()->count();
			$list[$value->attributes['id']] =  $value->attributes;
		}
		
		// if cribs near city not enough, look for near state
		if ( $take - count($crib) > 0 )
		{
			$order = ( rand(1,4) > 2  ) ? "updated_at" : "id" ;
			$sort = ( rand(1,4) > 2 ) ? "ASC" :  "DESC" ;
		
			$take = $take - count($crib);
			$crib = Properties::where("state", "like", "%{$state}%")
				->where_not_in("id", $id)
				->order_by($order, $sort)
				->take($take)->get();
				
			foreach ($crib as $key => $value)
			{	
				$value->attributes["review_count"] = Properties::find($value->attributes['id'])->property_reviews()->count();
				$list[$value->attributes['id']] =  $value->attributes;
			}
		}
	
		return $list;
	} // end of getNearProperty
	
	public static function getNearCrib($crib_id,$city,$state, $take = 3)
	{
		return Properties::getNearProperty($crib_id,$city,$state, $take);
	} // end of getNearCrib // alias of getNearProperty
	
	public static function getRandomProperties($take = 3)
	{
		//todo make logic random
		$list = array();
		
		$count = Properties::where("id", ">", 0)->count();
		$offset = ( $count > $take ) ? rand(0, $count - $take) : 0 ;
		$order = ( rand(1,4) > 2  ) ? "updated_at" : "id" ;
		$sort = ( rand(1,4) > 2 ) ? "ASC" :  "DESC" ;
		
		$crib = Properties::where("id", ">", 0)
			->where("is_approved", "=", 1)
			->order_by($order, $sort)
			->skip($offset)
			->take($take)->get();
			
		foreach ($crib as $key => $value)
		{	
			$crib_image = PropertyImages::where("property_id", '=', $value->id)->where('is_primary', '=', '1')->first();			
			$rate = PropertyReviews::where("property_id", '=', $value->id)->avg('stars');	

			$list[$value->attributes['id']] =  $value->attributes;
			$list[$value->attributes['id']]['thumbnail'] =  $crib_image->name;
			$list[$value->attributes['id']]['rate'] =  isset($rate) ? $rate : 0;
		}
			
		return $list;
	} // end of getRandomProperties
	
	public static function getRandomCribs($take = 3)
	{
		return Properties::getRandomProperties($take);
	} // end of getRandomCribs // alias of getRandomProperties
	
}