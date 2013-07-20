<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	public function __construct()
	{
		//Assets
		// Jquery
	    Asset::add('jquery', 'js/jquery-1.9.0.min.js');
	    Asset::add('jquery-ui', 'css/jquery-ui-1.10.0.custom.min.css', 'jquery');
	    // Twitter Bootstrap
	    Asset::add('bootstrap-js', 'js/bootstrap.min.js');
	    Asset::add('bootstrap-css', 'css/bootstrap.min.css', 'bootstrap-js');
	    Asset::add('bootstrap-css-responsive', 'css/bootstrap-responsive.min.css', 'bootstrap-css');
	    // Rating Plugin
	    Asset::add('jquery-rating-js', 'js/jquery.rating.pack.js', 'jquery');
	    Asset::add('jquery-rating-css', 'css/jquery.rating.css', 'jquery');
	    Asset::add('jquery-raty-js', 'js/jquery.raty.min.js', 'jquery');
	    // Image Place Holder
	    Asset::add('holder', 'js/holder.js');
	    // /jQuery Form Wizard
	    Asset::add('wizard-js', 'js/jquery.smartWizard.js', 'jquery');
	    Asset::add('wizard-css', 'css/smart_wizard.css');
	    // Live Validation
	    Asset::add('validation-js', 'js/jquery.validate.min.js', 'jquery');
	    //Asset::add('validation-css', 'css/validation.css');
		// Bootstrap Image Gallery
		Asset::add('bootstrap-image-gallery-min-css','css/bootstrap-image-gallery.min.css');
		Asset::add('load-image-min-js','js/load-image.min.js');
		Asset::add('bootstrap-image-gallery-min-js','js/bootstrap-image-gallery.min.js');
	    // Form Wizard
	    //Asset::add('require-js', 'js/require.js');
	    //Asset::add('wizard-js', 'js/wizard.js', 'require-js');
	    //Asset::add('wizard-css', 'css/wizard.css');
	    // Image Resize
	    Asset::add('resize-js', 'js/jquery.ae.image.resize.min.js', 'jquery');

	    // Generic CSS
	    Asset::add('style', 'css/style.css', 'bootstrap-css');	    
	    parent::__construct();

		$dir = "/img/ads";			
		$topad = Ads::where('ads_page_location', '=', 'topad')->first();
	    View::share('topad', isset($topad)? "{$dir}/{$topad->name}": $topad);
	}

}