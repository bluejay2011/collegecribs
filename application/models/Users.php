<?php

class Users extends Eloquent {
	public static $table = 'users';
	public static $hidden = array('password');
	//public static $timestamps = false;

	 public function user_profile()
	{
		return $this->has_one('UserProfiles', 'user_id');
	}
}