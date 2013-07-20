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
				<h2 class='page-header-title'>{{$property->property_name}} Reviews</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>			
			<div class='my-cribs list-options span11'>				
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Posted By</th>
							<th>Posted On</th>
							<th>Title</th>
							<th>Review</th>														
						</tr>
					</thead>
					<tbody>
						@foreach($reviews as $review)
						<tr>
							<td>{{$review->created_by}}</td>
							<td>{{$review->created_at}}</td>
							<td>{{$review->title}}</td>
							<td>{{$review->description}}</td>							
						</tr>
						@endforeach
					</tbody>
				</table>				
			</div>
		</div>	
		<div class='clearfix'></div><br /><br />		
		<div class="">
			<button type="button" class="btn" id='back-btn'><i class="icon-arrow-left"></i> View Other Cribs</button>						
			<button type="button" class="btn btn-primary" onClick="return back_to_profile({{$property->id}});"><i class="icon-arrow-left"></i> View this crib profile</button>				  			
		</div>		
	</div>
</div>
@endsection
@section('content_js')
<script>
$(function(){
	$('#back-btn').click(function(){
		document.location = "{{URL::to_action('owner')}}";
	});
});

function back_to_profile(id) {
	document.location = "{{URL::to_action('crib/profile/" + id + "')}}";
}
</script>
@endsection

