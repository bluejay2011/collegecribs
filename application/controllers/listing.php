<?php

class Listing_Controller extends Base_Controller {

	public function action_index()
	{

		$types = PropertyTypes::all();

		foreach($types as $type) {			
			$property_type[$type->attributes['id']] = $type->attributes['description'];
		}

		$is_logged_in = SESSION::has('username');
		$is_owner = SESSION::get('is_owner');

		
		/*if ( empty($is_logged_in) )
		{
			// TODO: inform user to login
			return Redirect::home();
		}*/

		if($_POST) {
			
			$has_error = false;
			// TODO: Search if property name doenst exist yet
			$is_existing = DB::table('properties')->where('property_name', '=', $_POST['data']['property_name'])->count();
			//dd(str_replace(",", "", $_POST['data']['min_rent']));
			if($is_existing == 0) {

				// Get User
				$user = Users::where('username', '=',  SESSION::get('username'))->first();
				$user_profile = UserProfiles::where('user_id', '=',  $user->attributes['id'])->first();
		

				// Save details
				$details['user_id'] = $user->attributes['id']; 
				$details['property_type_id'] = $_POST['data']['property_type'];
				$details['property_name'] = $_POST['data']['property_name'];
				$details['property_description'] = $_POST['data']['property_description'];
				$details['address'] = $_POST['data']['address'];
				$details['state'] = $_POST['data']['state'];
				$details['city'] = $_POST['data']['city'];
				$details['map_long'] = 0; 	// TODO: GET REAL LONGITUDE
				$details['map_lat'] = 0;	// TODO: GET REAL LATITUDE
				$details['rent_min'] = str_replace(",", "", $_POST['data']['rent_min']);
				$details['rent_max'] = str_replace(",", "", $_POST['data']['rent_max']);
				$details['zip_code'] = $_POST['data']['zipcode'];
				$details['contact_number'] = $user_profile->attributes['contact_number'];
				$details['contact_person'] = ' '; // TODO: ADD FIELDS FOR CONTACT PERSON
				$details['email_address'] = $user->attributes['email'];
				$details['is_approved'] = '0';
				$details['updated_by'] = $details['created_by'] = Session::has('username')? Session::get('username'): 'anonymous';
				
				$property_id = Properties::create($details)->get_id();
				
				if($property_id) {
					// Save Files [Optional]
					if(isset($_FILES)){
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
								$image_details['description'] = 'some mini bar';	//TODO: SOME TEMPORARY DATA
								$image_details['type'] = $photos['type'][$ctr];
								$image_details['size'] = $photos['size'][$ctr];
								$image_details['updated_by'] = $image_details['created_by'] = Session::has('username')? Session::get('username'): 'anonymous';
								if($ctr == 0) {
									$image_details['is_primary'] = 1;									
								}
								else {
									$image_details['is_primary'] = 0;										
								}

								$id = PropertyImages::create($image_details)->get_id();
									
								if($id) {
									move_uploaded_file($photos['tmp_name'][$ctr], "$uploads_dir/{$image_details['name']}");

									if($ctr == 0) {
										// Picture for the front page
										$thumbnail_dir = "{$_SERVER['DOCUMENT_ROOT']}/img/property/{$property_id}/{$image_details['name']}";		
										$success = Resizer::open( $thumbnail_dir )
											->resize( 300 , 100 , 'exact' )
											->save( "{$_SERVER['DOCUMENT_ROOT']}/img/property/thumbnail/{$image_details['name']}" , 90 );
									}
								}
								else {
									$has_error = true;
									Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
									break;
								}
							}
							
						}		
					}
				}
				else {
					$has_error = true;
					Session::flash('status_error', 'A problem was encountered while trying to save data. Please try again.');
				}
				if($has_error == false) {
					Session::flash('status_success', 'Your listing has been submitted. It will be pending for approval. Thank you!');
				}
			}
			else {
				$has_error = true;
				Session::flash('status_error', 'The property you have chosen is already in our listing');
			}
		}

		return View::make('listing.index')
			->with('property_type', $property_type)
			->with('is_owner', $is_owner? '1': '0')
			->with('is_logged_in', empty($is_logged_in)? '0': '1');
			
	}

}