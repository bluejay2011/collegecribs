<?php
class Account_Controller extends Base_Controller
{
	public function action_index(){		

		return View::make('account.index');
	}	


	public function action_register(){
		$types = MembershipTypes::all();
		foreach($types as $type) {
			$membership[$type->id] = $type->description;
		}

		return View::make('account.register')->with('membership', $membership);
	}

	public function action_check_username() {
		if($_POST['username']) {
			$user = Users::where('username', '=', $_POST['username'])->count();
		}
		if($user == 0) {
			//$status = 'available';
			echo json_encode(TRUE);
		}
		else {
			echo json_encode(FALSE);
			
			//$status = 'not_available';
		}

		exit();
		//return Response::json(array('status' => $user));
	}

	public function action_fblogin()
	{		
		if($_POST) {

			$details = Users::where('facebook_id', '=', $_POST['userid'])->where('email', '=', $_POST['email'])->first();
			if(!empty($details)) {				
				$details2 = UserProfiles::where('user_id', '=', $details->id)->first();				
				$merged_details = array_merge($details->to_array(), $details2->to_array());
				$this->save_session_details($merged_details);

				$name = $merged_details['first_name'] . ' ' . $merged_details['last_name'];
				$rs['id'] = $merged_details['id'];
				$rs['name'] = $name;

				return Response::json(array('result' => 'success', 'details' => $rs));
				
			} else {
				
				$users = Users::where('email', '=', $_POST['email'])->first();
				if($users) {
					//$users = new Users();
					$users->facebook_id = $_POST['userid'];					
					$users->updated_by = 'SYSTEM';					

					if($users->save()) {
						$details2 = UserProfiles::where('user_id', '=', $users->id)->first();				
						$merged_details = array_merge($users->to_array(), $details2->to_array());
						$this->save_session_details($merged_details);

						return Response::json(array('result' => 'success', 'details' => $merged_details));
					} else {
						return Response::json(array('result' => 'fail', 'message' => 'Error in saving.'));
					}
				} else {
					return Response::json(array('result' => 'fail', 'message' => 'Error in locating details.'));					
				}
			}
			//exit();
		}
	}

	public function action_fbregister()
	{				
		$data['registration'] = $_POST;
		// Verify that only one username exist
		if($data['registration']) {							
			try {					

				// TODO: salt password
				if($data['registration']['fbid']) 
					$details['facebook_id'] = $data['registration']['fbid'];

				$details['username'] = $data['registration']['username'];
				$details['password'] = $password = Hash::make($data['registration']['password']);
				$details['email'] = $data['registration']['email'];
				$details['created_by'] = 'SYSTEM';
				$details['updated_by'] = 'SYSTEM';
				$user = Users::create($details);
				
				if($user) {					
					// Save User Profile					
					$details2['user_id'] = $user->attributes['id'];
					$details2['first_name'] = $data['registration']['firstname'];
					$details2['last_name'] = $data['registration']['lastname'];
					$details2['is_owner'] = isset($data['registration']['is_owner'])? 1 : 0;
					$details2['created_by'] = 'SYSTEM';
					$details2['updated_by'] = 'SYSTEM';
					$details2['contact_number'] = $data['registration']['contact_number'];
					//$details2['address'] = $data['registration']['address'];
					$user_profile = UserProfiles::create($details2);						
				}					

				$merged_details = array_merge($details, $details2);
			}				
			catch(Exception $e) {
				dd('Error: ' .  $e);	
			}

			$this->save_session_details($merged_details);
			Session::flash('status_success', 'Welcome, ' . $merged_details['first_name'] . ' ' . $merged_details['last_name']);
			return Redirect::to('home');				
		}
	}

	private function save_session_details($details) {		
		Session::put('user_id', $details['user_id']);
		Session::put('username', $details['username']);
		Session::put('email', $details['email']);
		Session::put('name', $details['first_name'] . ' ' . $details['last_name'] );
		Session::put('is_owner', $details['is_owner']? true: false);
		Session::put('is_admin', isset($details['is_admin']) && $details['is_admin']? true: false);
	}

	public function action_profile()
	{
		if(Session::has('username')) {
			$user = Users::where('username', '=', Session::get('username'))->first();
			$user = $user->attributes;			
			$user_profile = UserProfiles::where('user_id', '=', $user['id'])->first();
			$user_profile = $user_profile->attributes;

			unset($user['id']);
			unset($user['password']);
			$merged_details = array_merge($user, $user_profile);	

			$types = MembershipTypes::all();
			foreach($types as $type) {
				$membership[$type->id] = $type->description;
			}
		
			return View::make('account.profile')
				->with('membership', $membership)
				->with('details', $merged_details);
		}
		else {
			return Redirect::to('home');
		}
	}

	public function action_sign_in(){
		if($_POST['username'] && $_POST['password']) {						
			// TODO: unsalt password		
			$user = Users::where('username', '=', $_POST['username'])->first();
			// User Exist
			if(isset($user)) {
				$user = $user->attributes;			
				// Validate Username and password
				if ($user['username'] == $_POST['username'] && Hash::check($_POST['password'], $user['password'])) {
				    $user_profile = UserProfiles::where('user_id', '=', $user['id'])->first();
					$user_profile = $user_profile->attributes;

					unset($user['id']);
					unset($user['password']);
					$merged_details = array_merge($user, $user_profile);	

					$this->save_session_details($merged_details);						
					return Response::json(array('result' => 'success'));		
				}
				else {
					return Response::json(array('result' => 'fail', 'message' => 'Incorrect password. Please try again.'));
					//Session::flash('status_error', 'Invalid username/password');
				}
			}
			else {
				return Response::json(array('result' => 'fail', 'message' => 'Username does not exist'));
				//Session::flash('status_error', 'Username does not exist');
			}			
		}
		else {
			return Response::json(array('result' => 'fail', 'message' => 'Please provide username/password'));
			//Session::flash('status_error', 'Please provide username/password');
		}
		//return Redirect::to('home');
	}

	public function action_authenticate(){

	}

	public function action_logout(){
		Session::flush();
		return Redirect::to('home');
	}
}

?>