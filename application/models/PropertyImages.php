<?php

class PropertyImages extends Eloquent {
	public static $table = 'property_images';

	public function property()
   {
		return $this->belongs_to('Properties');
   }
}