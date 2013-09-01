<?php

class Contact_Us_Controller extends Base_Controller {

	public function action_index(){
		
		return View::make('contact_us.index');
	}
	
}
?>