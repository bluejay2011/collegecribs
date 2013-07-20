<?php

class UserProfiles extends Eloquent {
	public static $table = 'user_profiles';
	//public static $timestamps = false;

	public function user()
	{
		return $this->belongs_to('Users');
	}
}