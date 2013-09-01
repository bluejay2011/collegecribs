<?php

class Crib_Controller extends Base_Controller {

	public function action_profile($id, $name)
	{		
		$order = "updated_at";
		$take = 5;
		$page = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
		$crib = Properties::getCrib($id);
		
		if ( count($crib) >= 1 ) 
		{
			$near = Properties::getNearCrib($id,$crib['city'],$crib['state']);
			$reviews = PropertyReviews::getReviews($id,$order,$take,$page);
			$types= PropertyTypes::all();
			$property_type = array();
			$stars = round(floatval(Properties::find($id)->property_reviews()->avg('stars')),2);
			$count = Properties::find($id)->property_reviews()->count();
			$property_owner = Properties::find($id)->first();
			$property_images = PropertyImages::where('property_id', '=', $id)->get();			

			foreach($types as $type) 
			{
				$property_type[$type->id] = $type->description;
			}
			
			$page = $reviews["result_count"] > 0 ? $page : 0 ;
			
			$is_crib_owner = false;
			if(SESSION::has('user_id')) {
				if(SESSION::get('is_owner') == true && SESSION::get('user_id') == $property_owner->user_id) {
					$is_crib_owner = true;
				}				
			}		

			return View::make('crib.profile')
				->with('crib', $crib)
				->with('near', $near)
				->with('property_type', $property_type)
				->with('property_images', $property_images)
				->with('reviews', $reviews["list"])
				->with('pages',$reviews["pages"])
				->with('page', $page)
				->with('id',$id)
				->with('stars', $stars)
				->with('count', $count)
				->with('result_count', $reviews["result_count"])
				->with('is_crib_owner', $is_crib_owner);
		}
		else
		{
			return View::make('crib.error');
		}
	}	

	public function action_remove_review()
	{
		if($_POST)
		{
			$id = $_POST['id'];
			$result = PropertyReviews::where('id', '=', $id)->delete();

			echo json_encode(array('result' => $result));
			exit();
		}
	}
	
}
?>