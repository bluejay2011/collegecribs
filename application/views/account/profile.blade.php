@layout('layouts/main')
@section('navigation')
	@parent	
	<li class='active'><a href="/home">Home</a></li>	
  	<li><a href="/contact_us">Contact Us</a></li>
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
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>My Profile Page</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>	
			 <form class='form-horizontal'>
				<div class='span6'>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Username</label>
					    <div class="controls">
					      <input type="text" id="dorm-name" placeholder="Username" disabled value="{{$details['username']}}">
					    </div>
					</div>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Full Name</label>
					    <div class="controls">
					      <input type="text" id="dorm-name" placeholder="Full Name" value="{{$details['first_name']}}">
					    </div>
					</div>						
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Email</label>
					    <div class="controls">
					      <input type="text" id="dorm-name" placeholder="john.doe@gmail.com" value="{{$details['email']}}">
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Contact Number</label>
					    <div class="controls">
					      <input type="text" id="dorm-name" value="{{$details['contact_number']}}">
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Is Owner</label>
					    <div class="controls">
					      <input type="checkbox" id="dorm-name" {{$details['is_owner']? 'checked': ''}}>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Membership Type</label>
					    <div class="controls">
					      {{ Form::select('size', $membership, $details['membership_type_id']); }}
					    </div>
					</div>	
					<div class="control-group">
						<div class="controls">
							<a href="#" class="btn btn-primary">Save details</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('content_js')
<script>
$(function(){
	$('.carousel').carousel();
  //$('.star').rating();
  $('.star-small').raty({   
    path  : '/img/raty',
    readOnly: true,    
      score: function() {     
        return $(this).attr('data-score');
      }
  });
});
</script>
@endsection