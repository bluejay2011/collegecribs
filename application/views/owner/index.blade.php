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
				<h2 class='page-header-title'>Owner's Page</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>			
			<div class='my-cribs list-options span11'>
				<!-- <h4>List of my Cribs</h4> -->
				@if(!empty($property))
				<table class='table'>
					<thead>
						<tr>
							<th></th>
							<th>My Crib/s</th>
							<th>Notifications</th>							
							<th colspan='2'>Account Type</th>
						</tr>
					</thead>
					<tbody>
						@foreach($property as $prop)
						<tr>
							<td>
								@if(isset($property_images_list[$prop->id]))
									<img class='crib-pic' src="{{$property_images_list[$prop->id]}}">
								@else
									<img data-src="holder.js/150x150/#838B8B:#fff">
								@endif
							</td>
							
							@if($prop->attributes['is_approved'] == 0)							
								<td class='my-crib-details'>{{ $prop->property_name }}</td>			
								<td class='my-crib-details'>Pending Approval of Crib</td>							
							@else
								<td class='my-crib-details'>{{HTML::link_to_action('owner@profile', $prop->property_name, array('id' => $prop->id))}}</td>
								@if(isset($property_review_count[$prop->id]))
									<td class='my-crib-details'>{{HTML::link_to_action('owner@new_reviews', $property_review_count[$prop->id] . " new review/s", array('id' => $prop->id))}}</td>	
								@else
									<td class='my-crib-details'>No new reviews/comments</td>							
								@endif
							@endif
							<td class='my-crib-details'>Free&nbsp;&nbsp;</td>
							<td class='my-crib-details'>
								<a class="btn btn-mini" href="#"><i class="icon-shopping-cart"></i> Upgrade</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
					<h4>You currently don't have a Crib. Start now by <a href='/listing'>placing a listing</a></h4>
					<br /><br />
				@endif
				<!-- <ul>
					@for ($x=1; $x<=5; $x++)
						<li>{{HTML::link_to_action('owner@profile', 'Crib ' . $x , array('id' => $x))}}</li>
					@endfor					
				</ul> -->
			</div>
		</div>			
	</div>
</div>
@endsection
@section('content_js')
<script>
$(function(){
	$( ".crib-pic" ).aeImageResize({ height: 150, width: 150 });  
});
</script>
@endsection