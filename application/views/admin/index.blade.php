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
	<!-- <li class="dropdown">
    	<a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
      	<ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
        	<li role="presentation">{{HTML::link_to_action('admin@ads', 'Administer Ads' , array('id' => 'administer-ads'))}}</li>
        	<li role="presentation">{{HTML::link_to_action('admin@owners', 'Administer Owner Accounts' , array('id' => 'administer-owner'))}}</li>
        	<li role="presentation">{{HTML::link_to_action('#', 'Administer Relative Property' , array('id' => 'administer-relative-property'))}}</li>        
      </ul>
    </li> -->
    <!-- <li><a href="/review">Write a Review</a></li> -->
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
		<br />	
		<div class='row'>			
			<div class='list-options span11'>
				<h4>What do you want to do?</h4>
				<ul>
					<li>{{HTML::link_to_action('admin@ads', 'Administer Ads' , array('id' => 'administer-ads'))}}</li>
					<li>{{HTML::link_to_action('admin@owners', 'Administer Owner Accounts' , array('id' => 'administer-owner'))}}</li>
					<li>{{HTML::link_to_action('admin@listings', 'Approve/Disapprove Listings' , array('id' => 'administer-listings'))}}</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection