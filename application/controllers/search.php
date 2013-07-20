<?php

class search_Controller extends Base_Controller {

	public function action_index()
	{
		$fitler = array();
		$filter["rent_min"] = isset($_POST["rent_min"]) ? floatval($_POST["rent_min"]) : 0 ;
		$filter["rent_max"] = isset($_POST["rent_max"]) ? floatval($_POST["rent_max"]) : 0 ;
		$filter["address"] = isset($_POST["address"]) ? strtolower($_POST["address"]) : null ;
		$filter["property_type"] = isset($_POST["property_type"]) ? intval($_POST["property_type"]) : null ;
		$limit = isset($_POST["limit"]) ? intval($_POST["limit"]) : 5;
		$page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
				
		$property = Properties::search($filter, $limit, $page);
		$limits = GenericFunc::getLimits();	
		$page = $property["result_count"] > 0 ? $page : 0 ;
		
		$types = PropertyTypes::all();
		$property_type[0] = "Any Type";
		foreach($types as $type) {
			$property_type[$type->id] = $type->description;
		}
		
		return View::make('search.index')->with('property', $property["list"])
			->with('pages', $property["pages"])
			->with('page',  $page)
			->with('limit', $limit)
			->with('result_count', $property["result_count"])
			->with('property_type', $property_type)
			->with('property_type_val', $filter["property_type"])
			->with('rent_min_val', $filter["rent_min"] == 0 ? null : $filter["rent_min"] )
			->with('rent_max_val', $filter["rent_max"] == 0 ? null : $filter["rent_max"])
			->with('address_val', $filter["address"])
			->with("limits", $limits)
			->with("limit", $limit);
	}

}