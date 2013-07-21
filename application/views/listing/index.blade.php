@layout('layouts/main')
@section('navigation')
	@parent	
	<li><a href="/home">Home</a></li>	
  	<li><a href="/contact_us">Contact Us</a></li>
  	<li class='active'><a href="/listing">Place a Listing</a></li>
  	@if(Session::has('username'))
	    @if(Session::get('is_owner') == 1 || Session::get('is_admin') == 1)
	      <li><a href="/owner">Owner</a></li>
	    @endif
	    @if(Session::get('is_admin') == 1)
	      <li><a href="/admin">Admin</a></li>
	    @endif
  	@endif
@endsection
@section('content')
<div class='container'>
	<div class='span12'>
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>Place an Ad Form</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>		
		<div class='clearfix'></div>
		<div id='div-listing'>
			{{ Form::open('listing/index', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-listing', 'enctype' => 'multipart/form-data')); }}	
			<input type='hidden' name="issubmit" value="1">
			<div id="wizard" class="swMain" style='padding-left: 3%'>
				<ul>
					<li>
						<a href="#step-1">
					      <label class="stepNumber">1</label>
					      <span class="stepDesc">
					         Step 1<br />
					         <small>Property Information</small>
					      </span>
					  	</a>
					</li>
					<li>
						<a href="#step-2">
					      <label class="stepNumber">2</label>
					      <span class="stepDesc">
					         Step 2<br />
					         <small>Property Location</small>
					      </span>
					  	</a>
					</li>
					<li>
						<a href="#step-3">
					      <label class="stepNumber">3</label>
					      <span class="stepDesc">
					         Step 3<br />
					         <small>Property Photos</small>
					      </span>                   
					   	</a>
					</li>
					
				</ul>			
				<div id="step-1">   
					<h2 class="StepTitle">Step 1 Basic Information</h2>				
					<br />
					<div class="control-group">
					    <label class="control-label" for="propertytype">Property Type</label>
					    <div class="controls">
					      {{ Form::select('data[property_type]', array_merge(array('0'=> 'Select one'),$property_type), '', array('id' => 'property-type')); }}
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="propertyname">Property Name</label>
					    <div class="controls">
					      <input type="text" id="property-name" placeholder="Property Name" name='data[property_name]'>
					    </div>
					</div>								
					<div class="control-group">
					    <label class="control-label" for="propertydescription">Description</label>
					    <div class="controls">
					      <input type="text" id="property-description" placeholder="Property Description" name='data[property_description]'>
					    </div>
					</div>						
					<div class="control-group">
					    <label class="control-label" for="minrent">Minimum Rent in Php</label>
					    <div class="controls">
					      <input type="text" id="min-rent" placeholder="1000" name='data[rent_min]'>
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="maxrent">Maximum Rent in Php</label>
					    <div class="controls">
					      <input type="text" id="max-rent" placeholder="1000" name='data[rent_max]'>
					    </div>
					</div>					
				</div>
				<div id="step-2">
					<h2 class="StepTitle">Step 2 Property Location</h2>
					<br /> 
					<div class="control-group">
						    <label class="control-label" for="address">Address</label>
						    <div class="controls">
						      <input class="input-xxlarge" type="text"  id="address" placeholder="1001 Makati Ave, Salcedo Village" name='data[address]'>
						    </div>
						</div>
						<div class="control-group">
						    <label class="control-label" for="city">City/Municipality</label>
						    <div class="controls">
						      <input type="text" id="city" placeholder="Makati City" name='data[city]'>
						    </div>
						</div>	
						<div class="control-group">
						    <label class="control-label" for="area">Province/Region</label>
						    <div class="controls">
						      <input type="text" id="area" placeholder="Metro Manila" name='data[state]'>
						    </div>
						</div>
						<div class="control-group">
						    <label class="control-label" for="area">Zipcode</label>
						    <div class="controls">
						      <input type="text" id="area" placeholder="1101" name='data[zipcode]'>
						    </div>
						</div>
						<div class="control-group">
						    <label class="control-label" for="googlemaps">Google Maps Input</label>
						    <div class="controls">
						      <input type="text" id="google-maps" placeholder="Still thinking how this will work" name='data[google_maps]'>
						    </div>
						</div>	
				</div>                      
				<div id="step-3">
					<h2 class="StepTitle">Step 3 Upload Photos</h2>   
					<br />
					<div class="control-group">
					    <label class="control-label" for="photo">Select Photo</label>
					    <div class="controls">
					   		
					      	<input type="file" id="photo" name='photos[]' multiple='multiple'>
					      	<!-- <div id="filedrag">or drop files here</div> -->
					    </div>
					</div>	
					<!-- <a href='#'>Attach More</a>	 -->
				</div>			
			</div>
			{{ Form::close(); }}	
		</div>
		<div id='div-listing-no-auth' style='display:none'>
			<h4>I'm sorry but you need to have an account before you can place a listing. <br /><br />Create now by clicking <a href='/account/register'>here</a>!</h4>
		</div>
		<div id='div-listing-not-owner' style='display:none'>
			<h4>You're account type is not allowed to place a listing.</h4>
		</div>
	</div>	
</div>
@endsection
@section('content_js')
<script>
$(function(){
	$('#property-type').css('color', '#aaa');
	$('#wizard').smartWizard({
		onLeaveStep:leaveAStepCallback,
        onFinish:onFinishCallback
    });    
    $('#property-type').change(function(){
    	if($('#property-type').val() == '0') {
    		$('#property-type').css('color', '#aaa');
    	}
    	else {
    		$('#property-type').css('color', '#555');
    	}
    });

	var logged_in = {{$is_logged_in}} ;
	var is_owner = {{$is_owner}} ;

    if(!logged_in) {
    	// show modal dialog     	
    	$('#myModal').modal().show();
    }
    else {    	
    	if(!is_owner) {
    		$('#div-listing').hide();
    		$('#div-listing-not-owner').show();
    	}
    }

    $('#btn-login-close').click(function(){
    	if(!logged_in) {
    		$('#div-listing').hide();
    		if(!is_owner)
    			$('#div-listing-no-auth').show();
    		else
    			$('#div-listing-not-owner').show();
    	}
    });

});
function leaveAStepCallback(obj, context){
	if (context.fromStep > context.toStep) {
        // Going backward
        return true;
    } else {
        // Going forward
        return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
    }    
}

// Your Step validation logic
function validateSteps(stepnumber){
    var isStepValid = true;

    // Clear all Validation
    $('.validate').remove();
    // validate step 1
    if(stepnumber == 1){    	
      	isStepValid = validate_step_1();
    }
    else if(stepnumber == 2) {
    	isStepValid = validate_step_2();	
    }
    // ...      
    console.log('validateSteps; isStepValid:' + isStepValid);
    return isStepValid;
}

function validate_step_1()
{
	var isStepValid = true;
	var words_regex = /^[\w-\s.,]+$/;
    var num_regex = /^[\d.,]+$/;

    if($('#property-type').val() == '0') {
    	show_error('property-type', 'Please select property type');
    	isStepValid = false;      
    }

	if($('#property-name').val() == '') {      	
      	show_error('property-name', 'Please provide property name');
      	isStepValid = false;      	      	
    }
    else if(!words_regex.test($('#property-name').val())) {     
      	show_error('property-name', 'Invalid! Can only use alphanumeric, dot, space and comma.');        
        isStepValid = false;      	      	
    }       

    if($('#property-description').val() == '') {
      	show_error('property-description', 'Please provide property description');
      	isStepValid = false;      	      	      	
    }
    else if(!words_regex.test($('#property-description').val())) {     
      	show_error('property-description', 'Invalid! Can only use alphanumeric, dot, space and comma.');        
        isStepValid = false;      	      	
    }       

    if($('#min-rent').val() == '') {
      	show_error('min-rent', 'Please provide minimum rent');      	
      	isStepValid = false;      	      	
    }
    else if(!num_regex.test($('#min-rent').val())) {     
      	show_error('min-rent', 'Invalid! Can only use numbers.');        
        isStepValid = false;      	      	
    } 

    if($('#max-rent').val() == '') {
      	show_error('max-rent', 'Please provide maximum rent');     
      	isStepValid = false;      	      	
    }
    else if(!num_regex.test($('#max-rent').val())) {     
      	show_error('max-rent', 'Invalid! Can only use numbers.');        
        isStepValid = false;      	      	
    } 
	return isStepValid;
}
function validate_step_2()
{
	var isStepValid = true;
	var words_regex = /^[\w-\s]+$/;
    var num_regex = /^[\d.,]+$/;
    var address_regex = /^[\w-\s.,]+$/;

	if($('#address').val() == '') {      	
      	show_error('address', 'Please provide full address');
      	isStepValid = false;      	      	
    }
    else if(!address_regex.test($('#address').val())) {     
      	show_error('address', 'Invalid! Can only use alphanumeric, dash, space and underscore.');        
        isStepValid = false;      	      	
    }

    if($('#area').val() == '') {      	
      	show_error('area', 'Please provide the area');
      	isStepValid = false;      	      	
    }
    else if(!words_regex.test($('#area').val())) {     
      	show_error('area', 'Invalid! Can only use alphanumeric, dash, space and underscore.');        
        isStepValid = false;      	      	
    }

    if($('#city').val() == '') {      	
      	show_error('city', 'Please provide the city');
      	isStepValid = false;      	      	
    }
    else if(!words_regex.test($('#city').val())) {     
      	show_error('city', 'Invalid! Can only use alphanumeric, dash, space and underscore.');        
        isStepValid = false;      	      	
    }

    if($('#google-maps').val() == '') {      	
      	show_error('google-maps', 'Please provide address for google maps location.');
      	isStepValid = false;      	      	
    }
    else if(!address_regex.test($('#google-maps').val())) {     
      	show_error('google-maps', 'Invalid! Can only use alphanumeric, dash, space and underscore.');        
        isStepValid = false;      	      	
    }

	return isStepValid;
}

function show_error(elem, message) {
	$("<span class='validate error_message'>" + message + "</span>").insertAfter('#' + elem);
}
   
function onFinishCallback(){
   console.log('onFinishCallback');
   if(validateAllSteps()){
   		console.log('Submit Form');
    	$('#frm-listing').submit();
   }
}
   

function validateAllSteps(){
	console.log('validateAllSteps');
    var isStepValid = true;
    // all step validation logic     
    return isStepValid;
}          
</script>
@endsection