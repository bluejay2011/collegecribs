@layout('layouts/main')
@section('navigation')
	@parent	
	<li><a href="/home">Home</a></li>	
  	<li><a href="/contact_us">Contact Us</a></li>
  	<li><a href="/listing">Place a Listing</a></li>  		
  	@if(Session::has('username'))
	    @if(Session::get('is_owner') == 1 || Session::get('is_admin') == 1)
	      <li><a class='active' href="/owner">Owner</a></li>
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
				<div class='row'>
					<div class='span2'>
						@if($primary_pic)
							<img class='crib-pic-primary' src="{{$primary_pic}}">
						@else						
							<img data-src="holder.js/160x160/#838B8B:#fff">
						@endif						
					</div>
					<div class='span6'>
						{{ Form::open('owner/save_name_desc', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-name-desc')); }}
						{{ Form::hidden('id', $property['id']); }}
						{{ Form::text('property_name', $property['property_name'] , array('id' => 'crib-property-name', 'placeholder' => "Property Name")); }}			      						      						
						<span class='page-header-description'>					
							{{ Form::textarea("property_description", $property['property_description'], array('id'=>'crib-property-description', 'class'  => 'span9', 'rows' => '3')); }}						
						</span>
						<br />
						<div class="clearfix" style='margin-top: 10px'>							
							<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Update Name and Description</button>
						</div>
						{{ Form::close(); }}
					</div>				
				</div>
			</div>			
		</div>
		<br />			
		<div class='row'>	
			<div class="alert alert-block span11">				
				<span class='my-crib-title'>Other Details</span>				
			</div>						
			<div class='my-crib-gallery span12'>					
				{{ Form::open('owner/save_other_details', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-other-details')); }}				
				{{ Form::hidden('id', $property['id']); }}
					<div class='span5'>						
  						<h4 class='page-sub-header'>Basic Information</h4>								
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Min. Rent in Php</label>
						    <div class="controls">
						    	{{ Form::text('min_rent', number_format($property['rent_min'],2) , array('id' => 'crib-min-rent', 'placeholder' => "10,000.00")); }}						      
						    </div>
						</div>											
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Max. Rent in Php</label>
						    <div class="controls">
						    	{{ Form::text('max_rent', number_format($property['rent_max'],2) , array('id' => 'crib-max-rent', 'placeholder' => "10,000.00")); }}						      						      
						    </div>
						</div>
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Contact Person</label>
						    <div class="controls">
						    	{{ Form::text('contact_person', $property['contact_person'] , array('id' => 'crib-contact-person', 'placeholder' => "Juan Dela Cruz")); }}			      						      
						    </div>
						</div>
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Contact Number</label>
						    <div class="controls">
						    	{{ Form::text('contact_number', $property['contact_number'] , array('id' => 'crib-contact-number', 'placeholder' => "(02) 123-1213")); }}						      						      						      
						    </div>
						</div>								
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Email Address</label>
						    <div class="controls">
						     	{{ Form::text('email', $property['email_address'] , array('id' => 'crib-email', 'placeholder' => "juandelacruz@gmail.com")); }}						      						      						      						      
						    </div>
						</div>					
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Website/FB Page</label>
						    <div class="controls">
						      	{{ Form::text('website', $property['website'] , array('id' => 'crib-email', 'placeholder' => "www.mywebsite.com")); }}						      						      						      						      
						    </div>
						</div>								
					</div>					
					<div class='span6'>
						<h4 class='page-sub-header'>Location</h4>
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Street</label>
						    <div class="controls">
						      	{{ Form::text('address', $property['address'] , array('id' => 'crib-address', 'placeholder' => "Address", "class" => 'input-xlarge')); }}						      						      						      						      
						    </div>
						</div>							
						<div class="control-group">
						    <label class="control-label" for="inputDorm">City/Municipality</label>
						    <div class="controls">
						      {{ Form::text('city', $property['city'] , array('id' => 'crib-city', 'placeholder' => "City", "class" => 'input-xlarge')); }}	
						    </div>
						</div>	
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Province/Region</label>
						    <div class="controls">
						      {{ Form::text('state', $property['state'] , array('id' => 'crib-state', 'placeholder' => "State", "class" => 'input-xlarge')); }}	
						    </div>
						</div>	
						<!-- <div class="control-group">
						    <label class="control-label" for="inputDorm">Country</label>
						    <div class="controls">
						      {{ Form::text('country', $property['country'] , array('id' => 'crib-country', 'placeholder' => "Country", "class" => 'input-xlarge')); }}	
						    </div>
						</div> -->
						<!-- <div class="control-group">
						    <label class="control-label" for="inputDorm">Map</label>
						    <img border="0" src="//maps.googleapis.com/maps/api/staticmap?center=51.477222,0&zoom=14&size=200x200&sensor=false&key=AIzaSyAXxmvsJJzKqKS_IgV9h7hmhfjTpLX9DJo" alt="Greenwich, England">						    
						    <div class="controls">
						      <input type="text" id="dorm-name" placeholder="Still thinking how this will work">
						    </div>
						</div> -->	
					</div>				
				<div class='clearfix'></div><br />
				<div class="">
					<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Update Other Details</button>				
				</div>
				{{ Form::close(); }}
			</div>						
		</div>	
		<!-- <div class='row'>
			<div class="alert alert-block span11">				
				<span class='my-crib-title'>Maps</span>				
			</div>	
			<div class='span12'>									
				<img border="0" src="//maps.googleapis.com/maps/api/staticmap?center=51.477222,0&zoom=14&size=200x200&sensor=false&key=AIzaSyAXxmvsJJzKqKS_IgV9h7hmhfjTpLX9DJo" alt="Greenwich, England">						 				
				<div class='clearfix'></div><br />	
				<div class="">			
					<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Update Map</button>					  	  					
				</div>
			</div>			
		</div> -->
		<div class='clearfix'></div><br />			
		<div class='row'>			
			{{ Form::open_for_files('owner/save_new_images', 'POST', array('class' => '', 'id' => 'frm-images'));}}
			{{ Form::hidden('id', $property['id']); }}
			<div class="alert alert-block span11">				
				<span class='my-crib-title'>Gallery</span>				
			</div>	
			<div class='my-crib-gallery span12'>
				<!-- <span class='my-crib-title'>My Gallery</span><br /><br /> -->
				<div class='span11'>
					@foreach($property_images as $images)
						<img class='crib-pics' src="{{asset('img/property/')}}{{$images->property_id}}/{{$images->name}}">			
					@endforeach
				</div>
				<br />
				<div class='clearfix'></div><br /><br />		
				<label>Add More Photos?</label>
				<input type="file" id="photo" name='photos[]' multiple='multiple'>
				<div class='clearfix'></div><br /><br />		
				<div class="">
					<button type="button" class="btn" id='back-btn'><i class="icon-arrow-left"></i> View Other Cribs</button>		
					<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save New Photos</button>					
				</div>
				
			</div>			
			{{ Form::close(); }}				
			
		</div>			
	</div>
</div>
@endsection
@section('content_js')
<script>
$(function(){
	$( ".crib-pic-primary" ).aeImageResize({ height: 160, width: 160 });  
	$( ".crib-pics" ).aeImageResize({ height: 250, width: 250 });  

	$('#back-btn').click(function(){
		document.location = "{{URL::to_action('owner')}}";
	});
});
</script>
@endsection