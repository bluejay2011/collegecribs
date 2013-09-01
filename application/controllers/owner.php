<?php

class Owner_Controller extends Base_Controller {

	public function action_index(){

		if(Session::has('username')) {
			$user = Users::where('username', '=', Session::get('username'))->first()->to_array();			
			$user_profile = UserProfiles::where('user_id', '=', $user['id'])->first()->to_array();	
			$root = Util::get_hostname() . "/img/property";

			$property = Properties::where('user_id', '=', $user['id'])->get();
			if(!empty($property)) {
				$property_keys = array();
				foreach ($property as $value) {
					$property_keys[] = $value->attributes['id'];			
				}	

				$property_images = PropertyImages::where_in('property_id', $property_keys)->where('is_primary', '=', '1')->get();	

				foreach($property_images as $images) {
					$prop_list[$images->attributes['property_id']] = $root . '/' . $images->attributes['property_id']. '/' . $images->attributes['name'];
				}
			}

			$reviews_count = PropertyReviews::where('is_seen',  '=', '0')->group_by('property_id')->order_by('cnt','desc')->get(array('property_id', DB::raw('count(*) as cnt')));
			foreach($reviews_count as $count)
				$rcount[$count->property_id] = $count->cnt;

			return View::make('owner.index')		
				->with('root', $root)	
				->with('user', $user? $user: array())				
				->with('property', $property? $property: array())
				->with('property_images_list', isset($prop_list)? $prop_list: array())
				->with('property_review_count', isset($rcount)? $rcount: array())
				->with('user_profile', $user_profile? $user_profile : array());
		}	
		else {
			Session::flash('status_error', 'Session Expired. Please log in again.');
			return Redirect::to('home');
		}			
	}

	public function action_profile($id){
		$property = Properties::where('id', '=', $id)->first()->to_array();;
		$property_image_primary = PropertyImages::where('property_id', '=', $id)->where('is_primary', '=', '1')->get();		
		$property_images = PropertyImages::where('property_id', '=', $id)->get();		
		$root = Util::get_hostname() . "/img/property";
		$primary_pic = false;

		if(empty($property_image_primary)) {
			if(!empty($property_images)) {				
				$primary_pic = $root.'/'.$property_images[0]->attributes['property_id'].'/'.$property_images[0]->attributes['name'];
			}
		}
		else {
			$primary_pic = $root.'/'.$property_image_primary[0]->attributes['property_id'].'/'.$property_image_primary[0]->attributes['name'];
		}
		
		// Select From database the data of the crib
		return View::make('owner.profile')
			->with('root', $root)
			->with('property', $property)
			->with('primary_pic', $primary_pic)
			->with('property_images', $property_images);
	}

	public function action_save_new_images()
	{		
		if(isset($_FILES)) {
			$property_id = $_POST['id'];

			// Check if there is no existing pictures
			$count = DB::table('property_images')->where('property_id', '=', $property_id)->count();			

			// Start File upload
			$files_count = count($_FILES['photos']['name']);			
			$uploads_dir = "{$_SERVER['DOCUMENT_ROOT']}/img/property/{$property_id}";
			for($ctr = 0; $ctr < $files_count; $ctr++) {
				$photos = $_FILES['photos'];						
				if($photos['error'][$ctr] == UPLOAD_ERR_OK) {
					if(!is_dir($uploads_dir)) {
						mkdir($uploads_dir);
					}
					$image_details['property_id'] = $property_id;
					$image_details['name'] = $photos['name'][$ctr];
					$image_details['description'] = 'some mini bar';	//temp
					$image_details['type'] = $photos['type'][$ctr];
					$image_details['size'] = $photos['size'][$ctr];
					if($count == 0 && $ctr == 0)
						$image_details['is_primary'] = 1;

					$id = DB::table('property_images')->insert_get_id($image_details);
					if($id) {
						move_uploaded_file($photos['tmp_name'][$ctr], "$uploads_dir/{$image_details['name']}");
					}
					else {
						$has_error = true;
						Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
						break;
					}
				}
				
			}					
			
			return Redirect::to_action('owner@profile', array($_POST['id']));	
		}
	}

	public function action_save_other_details()
	{
		if($_POST) {
			$data = $_POST;			
			
			$data['rent_min'] = str_replace(",", "", $data['min_rent']);
			$data['rent_max'] = str_replace(",", "", $data['max_rent']);					
			$data['email_address'] = $data['email'];

			unset($data['min_rent']);
			unset($data['max_rent']);
			unset($data['email']);

			$affected = DB::table('properties')
			    ->where('id', '=', $data['id'])
			    ->update($data);

		   	if($affected) {
				Session::flash('status_success', 'Other Details is saved.');   	
		  	}
		   	else {
		   		Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
		   	}

			return Redirect::to_action('owner@profile', array($data['id']));
		}

	}

	public function action_save_name_desc()
	{
		if($_POST) {
			$data = $_POST;			
			$affected = DB::table('properties')
			    ->where('id', '=', $data['id'])
			    ->update($data);

		   	if($affected) {
				Session::flash('status_success', 'Name and description is successfully saved.');   	
		  	}
		   	else {
		   		Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
		   	}

			return Redirect::to_action('owner@profile', array($data['id']));
		}		
	}
	
	public function action_new_reviews($id)
	{
		if($id) {
			$reviews = PropertyReviews::where('is_seen',  '=', '0')->where('property_id', '=', $id)->get();		
			$property = Properties::where('id', '=', $id)->first();

			$data['is_seen'] = 1;
			$affected = PropertyReviews::where('property_id', '=', $id)->update($data);

			return View::make('owner.new_reviews')
				->with('property', $property)
				->with('reviews', $reviews);			
		}
		else {
			Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
		}
	}
}
?>