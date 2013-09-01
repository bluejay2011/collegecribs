<?php

class Review_Controller extends Base_Controller {

	public function action_index(){
		
		return View::make('review.index');
	}
	
	public function action_create($id) {		
		$crib = Properties::where('id', '=', $id)->first();		

		if($_POST) {			
			$data['property_id'] = $_POST['id'];
			$data['user_id'] = SESSION::get('user_id');
			$data['title'] = $_POST['title'];
			$data['description'] = $_POST['review'];
			$data['stars'] = $_POST['score'];
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['created_by'] = SESSION::get('username');
			$data['updated_by'] = SESSION::get('username');

			$success = PropertyReviews::insert($data);
			if($success) {
				Session::flash('status_success', 'Your review is successfully posted. Thank you!');
			}
			else {
				Session::flash('status_error', 'A problem was encountered while trying to save your review. Please try again later.');
			}
		}
		return View::make('review.create')
			->with('crib', $crib);
	}
}
?>