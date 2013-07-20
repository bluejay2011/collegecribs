@layout('layouts/main')
@section('navigation')
	@parent	
	<li><a href="/home">Home</a></li>	
  	<li><a href="/contact_us">Contact Us</a></li>
  	<li><a href="/listing">Place a Listing</a></li>  		
  	@if(Session::has('username'))
	    @if(Session::get('is_owner') == 1 || Session::get('is_admin') == 1)
	      <li><a href="/owner">Owner</a></li>
	    @endif
	    @if(Session::get('is_admin') == 1)
	      <li><a class='active' href="/admin">Admin</a></li>
	    @endif
  	@endif
@endsection
@section('content')
<div class='container'>
	<div class='span12'>		
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>Admin - Administer Listings</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>			
			<div id='admin-listing-crib' class='my-cribs list-options span11'>
				<!-- <h4>List of my Cribs</h4> -->		
				@if(!empty($property))		
				<table id='table-result' class='table'>
					<thead>
						<tr>							
							<th>Crib/s</th>
							<th>Description</th>			
							<th>Account Type</th>
							<th>Action</th>															
						</tr>
					</thead>
					<tbody id='tbody-result'>						
						@foreach($property as $prop)
						<tr id='prop-{{$prop->id}}'>
							<td>{{HTML::link_to_action('crib@profile', $prop->property_name, array('id' => $prop->id), array('target' => 'blank'))}}</td>
							<td>
								@if(strlen($prop->property_description) > 50)
									{{ substr($prop->property_description, 0,50) . "..." }}
								@else
									{{ $prop->property_description }}
								@endif
							</td>
							<td>{{$membership_types[$prop->membership_type_id]}}</td>
							<td>
								<a href='#' class="btn btn-success" onClick="return approve(<?php echo $prop->id; ?>);"><i class="icon-thumbs-up"></i> Approve</a>
								<a href='#' class="btn btn-danger" onClick="return disapprove(<?php echo $prop->id; ?>);"><i class="icon-thumbs-down"></i> Disapprove</a>
							</td>							
						</tr>
						@endforeach						
					</tbody>
				</table>				
				@else
					<h4>No Pending listings for approval</h4>
				@endif
			</div>
		</div>			
	</div>
</div>
@endsection
@section('content_js')
<script>
var ctr = 1;
$(function(){
	console.log($('#tbody-result > tr').length);	
});

function approve(id) {
	$.ajax({
		type: 'POST',
		async: false,
		url: "<?php echo URL::to_action('admin@approve'); ?>",
		data: {
			id: id
		},
		success: function(data) {
			if(data.result == 'session_timeout') {
				document.location = "{{URL::to_action('home')}}";
			}
			else if(data.result == 'success') {
				$('#prop-' + data.id).remove();
				$('.myalerts').append("<div class='alert alert-success alert-"+ctr+"'></div>");
				$('.alert-'+ctr).html(data.message);				
				$('.alert-'+ctr).slideDown('slow').delay(1500).slideUp('slow');
			}
			else {
				$('.myalerts').append("<div class='alert alert-error alert-"+ctr+"'></div>");
				$('.alert-'+ctr).html("An error was encountered while tring to save data.");				
				$('.alert-'+ctr).slideDown('slow').delay(1500).slideUp('slow');
			}
			ctr++;

			// No more rows left
			if($('#tbody-result > tr').length == 0) {
				$('#admin-listing-crib').empty();
				$('#admin-listing-crib').append("<h4>No Pending listings for approval</h4>");
			}
		},
		dataType: 'jSon'
	});
}

function disapprove(id) {

	$.ajax({
		type: 'POST',
		async: false,
		url: "<?php echo URL::to_action('admin@disapprove'); ?>",
		data: {
			id: id
		},
		success: function(data) {
			if(data.result == 'session_timeout') {
				document.location = "{{URL::to_action('home')}}";
			}
			else if(data.result == 'success') {
				$('#prop-' + data.id).remove();
				$('.myalerts').append("<div class='alert alert-success alert-"+ctr+"'></div>");
				$('.alert-'+ctr).html(data.message);				
				$('.alert-'+ctr).slideDown('slow').delay(1500).slideUp('slow');
			}
			else {
				$('.myalerts').append("<div class='alert alert-error alert-"+ctr+"'></div>");
				$('.alert-'+ctr).html("An error was encountered while tring to save data.");				
				$('.alert-'+ctr).slideDown('slow').delay(1500).slideUp('slow');
			}
			ctr++;

			// No more rows left
			if($('#tbody-result > tr').length == 0) {
				$('#admin-listing-crib').empty();
				$('#admin-listing-crib').append("<h4>No Pending listings for approval</h4>");
			}
		},
		dataType: 'jSon'
	});
}
</script>
@endsection