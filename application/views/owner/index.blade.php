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
							<th>Account Type</th>
							<th>Actions</th>
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
								@if($prop->is_approved == 0)
									N/A
								@else
									<!--<a class="btn" href="{{url('owner/profile/' . $prop->id)}}"><i class="icon-edit"></i> Edit</a>
									<a class="btn" href="#"><i class="icon-shopping-cart"></i> Upgrade</a> -->
									<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
										<input type="hidden" name="cmd" value="_s-xclick">
										<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
										">
										<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
										<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
									</form>
								@endif
								<!-- <a class="btn" href="#"><i class="icon-trash"></i> Delete</a> -->
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