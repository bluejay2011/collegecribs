@layout('layouts/main')
@section('navigation')
	@parent	
	<li><a href="/home">Home</a></li>	
  	<li class='active'><a href="/contact_us">Contact Us</a></li>
  	<li><a href="/listing">Place a Listing</a></li>
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
		<!-- <div class='row banner'>
			<img data-src="holder.js/1170x300/#838B8B:#fff">
		</div>
		<br /> -->
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>Contact Us</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>
			<form class='form-horizontal'>
				<div class='span12'>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Name</label>
					    <div class="controls">
					      <input type="text" class="input-xlarge" id="name" placeholder="Dormitory Name">
					    </div>
					</div>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Contact Number</label>
					    <div class="controls">
					      <input type="text" class="input-xlarge" id="contact-no" placeholder="0915-1234567" required>
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Email</label>
					    <div class="controls">
					      <input type="email" class="input-xlarge" id="email" placeholder="john.doe@gmail.com">
					    </div>
					</div>						
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Comments/Suggestions</label>
					    <div class="controls">
					    	<textarea class="input-xxlarge" rows="7"></textarea>					      
					    </div>
					</div>									
					
				</div>	

			</form>
			<div class="frm-actions">
				<button type="submit" class="btn btn-primary">Submit</button>					  	  		
			</div>				
		</div>			
	</div>
</div>
@endsection