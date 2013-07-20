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
		<!-- <div class='row banner'>
			<img data-src="holder.js/1170x300/#838B8B:#fff">
		</div>
		<br /> -->
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>Admin's Page</h2>
				<span class='page-header-description'>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</span>
			</div>			
		</div>		
		<div class='row ads-settings'>		
			<!-- <div class='span11'>
				<button type="button" class="btn btn-primary">Create new Owner</button><br /><br />
			</div> -->
			<div class='span11'>
				<h4>List of Owners</h4>	

				@if(empty($properties))
					<br />
					<h4>No approved owner's property</h4>
				@else
				<form class='form-horizontal'>
					<table class="table table-condensed table-striped ">
						<thead>
							<th>Name</th>
							<th>Crib Name</th>
							<th>Subscription</th>
							<th>Actions</th>
						</thead>
						<tbody>
							@foreach($properties as $property)
							<tr>
								<td>{{ $profiles[$property->user_id]->first_name }} {{ $profiles[$property->user_id]->last_name }} </td>
								<td>{{ $property->property_name }}</td>
								<td>{{ $membership_types[$property->membership_type_id] }}</td>
								<td>
									<a class="btn" href="#"><i class="icon-edit"></i></a>
									<a class="btn" href="#"><i class="icon-trash"></i></a>
								</td>
							</tr>						
							@endforeach
						</tbody>						
					</table>
					<!-- <div class="pagination">
					  <ul>
					    <li><a href="#">Prev</a></li>
					    <li><a href="#">1</a></li>
					    <li><a href="#">2</a></li>
					    <li><a href="#">3</a></li>
					    <li><a href="#">4</a></li>
					    <li><a href="#">5</a></li>
					    <li><a href="#">Next</a></li>
					  </ul>
					</div> -->
				</form>	
				@endif
			</div>
		</div>		
	</div>
</div>
@endsection