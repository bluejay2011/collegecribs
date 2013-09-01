<?php

class Admin_Controller extends Base_Controller {

	public function action_index(){
		
		return View::make('admin.index');
	}	

	public function action_delete_crib(){
		if($_POST['id']) {
			$id = $_POST['id'];			
			$property = Properties::where('id', '=',  $id)->first();			
			if($property) {
				$uploads_dir = "{$_SERVER['DOCUMENT_ROOT']}/img/property/{$id}";
				$affectedRows = Properties::where('id', '=',  $id)->delete();
				if($affectedRows) {
					$primary_image = PropertyImages::where('property_id', '=',  $id)->where('is_primary', '=',  1)->first();			
					if($primary_image) {
						$uploads_thumbnail_file = "{$_SERVER['DOCUMENT_ROOT']}/img/property/thumbnail/{$primary_image->name}";
						PropertyImages::where('property_id', '=',  $id)->delete();
						unlink($uploads_thumbnail_file);
					}
					
					PropertyReviews::where('property_id', '=',  $id)->delete();
					if(is_dir($uploads_dir)) {
						$this->rrmdir($uploads_dir);
					}
				}				

				// TODO: send email
				return Response::json(array('result' => 'success', "id" => $property->id,  'message' => "Successfully removed {$property->property_name}."));					
			}
			else {
				return Response::json(array('result' => 'fail', 'message' => "Property doesn\'t exist"));			
			}
		}
		else {
			return Response::json(array('result' => 'fail'));		
		}
	}

	private function rrmdir($dir) { 
		if (is_dir($dir)) { 
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != "." && $object != "..") { 
		 			if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
				} 
			} 
			reset($objects); 
			rmdir($dir); 
		}	 
	}

	public function action_ads(){
		if($_POST) 
		{
			if($_FILES) {

				if($_FILES['ads']['error'] == UPLOAD_ERR_OK)
				{
					// Validate Files
					$home = URL::home();
					$uploads_dir = "{$_SERVER['DOCUMENT_ROOT']}/img/ads";
					$result = $this->validate_file_upload($_FILES);

					if($result) {

						$ext = substr($_FILES['ads']['name'], strrpos($_FILES['ads']['name'], "."), strlen($_FILES['ads']['name']));
						$name = md5($_FILES['ads']['name'] . date('YmdHis')) . $ext;

						$rs = Ads::where('ads_page_location', '=', $_POST['banner'])->first();
						if($rs) {
							// Remove Old File
							unlink("$uploads_dir/{$rs->name}");

							// Update 							
							$data['name'] = $name;							
							$success = Ads::update($rs->id, $data);
							if($success) {
								move_uploaded_file($_FILES['ads']['tmp_name'], "$uploads_dir/{$name}");	
								Session::flash('status_success', 'Your image is successfully updated');
							}
							else {
								Session::flash('status_error', 'A problem was encountered while trying to upload your image. Please try again later.');
							}							
						}
						else {
							$data['ads_page_location'] = $_POST['banner'];
							$data['name'] = $name;							
							$data['created_at'] = date('Y-m-d H:i:s');
							$data['created_by'] = SESSION::get('username');
							$data['updated_by'] = SESSION::get('username');

							$success = Ads::insert($data);
							if($success) {
								move_uploaded_file($_FILES['ads']['tmp_name'], "$uploads_dir/{$name}");	
								Session::flash('status_success', 'Your image is successfully uploaded');
							}
							else {
								Session::flash('status_error', 'A problem was encountered while trying to upload your image. Please try again later.');
							}
						}																
					}
					else {
						$has_error = true;
						Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
						break;
					}
				}
				else {
					$has_error = true;
					Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
					break;
				}
			}
			//return View::make('admin.ads');
		}
		//else
		//{
			$dir = "/img/ads";			
			$topad = Ads::where('ads_page_location', '=', 'topad')->first();
			$ad1 = Ads::where('ads_page_location', '=', 'ad1')->first();
			$ad2 = Ads::where('ads_page_location', '=', 'ad2')->first();

			//dd($topad);
			return View::make('admin.ads')
				->with('topad', isset($topad)? "{$dir}/{$topad->name}": $topad)
				->with('ad1', isset($ad1)? "{$dir}/{$ad1->name}": $ad1)
				->with('ad2', isset($ad2)? "{$dir}/{$ad2->name}": $ad2);

		//}
		
		
	}	

	private function validate_file_upload($files)
	{
		//is_valid = false;

		return true;
	}

	public function action_owners(){		
		
		$user_profiles = UserProfiles::where('is_owner', '=', 1)->get();		
		foreach($user_profiles as $profile) {
			$ids[] = $profile->user_id;
			$profiles[$profile->user_id] = $profile;
		}

		$users = Users::where_in('id', $ids)->get();		
		$properties = Properties::where('is_approved', '=', 1)->where_in('user_id', $ids)->get();
		$membership_types = MembershipTypes::lists('description', 'id');

		return View::make('admin.owners')
			->with('users', $users)
			->with('profiles', $profiles)
			->with('membership_types', $membership_types)
			->with('properties', $properties);
	}	
	
	public function action_listings() {

		$property = Properties::where('is_approved', '=', 0)->get();
		$membership_types = MembershipTypes::all();
		foreach($membership_types as $type) {
			$mt[$type->id] = $type->description;
		}

		//dd($property);

		return View::make('admin.listings')
			->with('property', $property)
			->with('membership_types', $mt);
	}

	public function action_approve()
	{
		if($_POST) {
			$property = Properties::find($_POST['id']);
			$property->is_approved = 1;
			$property->updated_by = SESSION::get('username');
			
			if($property->save()) {
				// TODO: send email
				return Response::json(array('result' => 'success', "id" => $property->id,  'message' => "Successfully approved {$property->property_name}."));		
			}
			else  {
				return Response::json(array('result' => 'fail'));		
			}
		}
	}

	public function action_disapprove()
	{
		if($_POST) {
			// Action in the future, delete pics. But for now, just do it like approve
			$property = Properties::find($_POST['id']);
			$property->is_approved = 2;
			$property->updated_by = SESSION::get('username');
			
			if($property->save()) {
				// TODO: send email
				return Response::json(array('result' => 'success', "id" => $property->id,  'message' => "Successfully disapproved {$property->property_name}."));		
			}
			else {
				return Response::json(array('result' => 'fail'));		
			}
		}
	}
}
?>