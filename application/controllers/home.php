<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index()
	{

		$types = PropertyTypes::all();
		$property_type[0] = "Any Type";
		foreach($types as $type) {
			$property_type[$type->id] = $type->description;
		}
		 
		$crib_ads = Properties::getRandomCribs();

		$dir = "/img/ads";			
		//$topad = Ads::where('ads_page_location', '=', 'topad')->first();
		$ad1 = Ads::where('ads_page_location', '=', 'ad1')->first();
		$ad2 = Ads::where('ads_page_location', '=', 'ad2')->first();	

		$property = Properties::where('membership_type_id', '=', 1)->where('is_approved', '=', 1)->lists('property_name', 'id');
		$keys = array_keys($property);				
		$carousel2 = PropertyImages::where_in('property_id', $keys)->where('is_primary', '=', 1)->get();

		//dd($carousel2);
		foreach($carousel2 as $carousel) {
			//var_dump($carousel);
			$wheel[$carousel->property_id] = $carousel->attributes;
			$wheel[$carousel->property_id]['property_name'] = $property[$carousel->property_id];
		}

		//dd($crib_ads);
		return View::make('home.index')
			->with('property_type', $property_type)
			->with('crib_ads', $crib_ads)
			->with('carousel', $wheel)			
			->with('ad1', isset($ad1)? "{$dir}/{$ad1->name}": $ad1)
			->with('ad2', isset($ad2)? "{$dir}/{$ad2->name}": $ad2);
	}
	
}