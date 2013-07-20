<?php

class PropertyTypes extends Eloquent {
	public static $table = 'property_types';

	public function property()
	{
		return $this->belongs_to('Properties');
	}
}