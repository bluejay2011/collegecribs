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
	{{ Form::open("/crib/profile/$id", "POST", array("id" => "form_reviews")); }}
	{{ Form::hidden("page", $page, array("id" => "page")); }}
	<div class='span12'>	
		<div class='row'>
			<div class='span9'>
				<div class='row'> <!-- Left Side Starts here -->	
					<div class='span3'>				
						<div class='crib-profile'>										
							<div class='crib-profile-pic'>
								<div class='image-option'>
									<div class="btn-group">
										<a class="btn btn-mini"><i class="icon-th"></i></a>
										<a class="btn btn-mini" id="start-slideshow" class="btn btn-large btn-success" data-slideshow="5000" data-target="#modal-gallery" data-selector="#gallery a"><i class="icon-zoom-in"></i></a>
									</div>
								</div
								>		
								@if($property_images)
									<img src="{{asset('img/property/')}}{{$property_images[0]->property_id}}/{{$property_images[0]->name}}" height="270" width="300">							
								@else
									<img data-src="holder.js/270x200/#838B8B:#fff">
								@endif
							</div>							
							<div class='crib-gallery' id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery"><br />
								@foreach($property_images as $img)
								<a data-gallery="gallery" href="{{asset('img/property/')}}{{$img->property_id}}/{{$img->name}}" title="{{$crib['property_name']}}">									
									<img src="{{asset('img/property/')}}{{$img->property_id}}/{{$img->name}}" height="50" width="50">
								</a>
								@endforeach
								<!-- <a data-gallery="gallery" href="http://fakeimg.pl/320x300/?text=ola-dora" title="ibang image">
									<img data-src="holder.js/50x50/#838B8B:#fff">
								</a>
								<a data-gallery="gallery" href="http://fakeimg.pl/350x200/?text=ako-ay-ninja" title="test gallery">
									<img data-src="holder.js/50x50/#838B8B:#fff">
								</a>
								<a data-gallery="gallery" href="http://fakeimg.pl/500x180/?text=dummy-image-lang-to" title="dummy lang">
									<img data-src="holder.js/50x50/#838B8B:#fff">
								</a>
								<a data-gallery="gallery" href="http://fakeimg.pl/200x500/?text=boom" title="bida-man">
									<img data-src="holder.js/50x50/#838B8B:#fff">
								</a> -->
							</div>
						</div>
					</div>			
					<div class='span5'>
						<span class='crib-profile-name'>{{$crib['property_name']}}</span>
						<div class='inline-block'>
							<?php 
								if ( $count > 0 ) {
									$rvs = $count == 1 ? "review" : "reviews" ;
							?>
							<div class='crib-profile-detail stars'>&nbsp;{{ "<b>$stars</b> average from <b>$count</b> $rvs";  }}</div>
							<?php } else { ?>
							<div class='crib-profile-detail stars'>&nbsp;{{ "<i>no reviews</i>";  }}</div>
							<?php } ?>
							<div class="star-small" data-score={{$stars}}></div>
							<!--TODO: HIDE FIRST THIS LIKE WHILE TESTING -->
							<div class="fb-like" data-href="http://ph.yahoo.com/?p=us" data-width="450" data-show-faces="false" data-send="false"></div>
						</div>
						<br />
						<?php
							$min = number_format( round(floatval($crib['rent_min']),2 ),2);
							$max = number_format( round(floatval($crib['rent_max']),2 ),2);
						?>
						<b>
						<span class='crib-profile-details price'>{{ "Rent: Php $min - Php $max" }}</span><br />
						<span class='crib-profile-details address'>{{ ucwords(strtolower($property_type[$crib['property_type_id']])) }}</span><br />
						</b>
						<span class='crib-profile-details address'>{{ $crib['address_full'] }}</span><br />
						<span class='crib-profile-details contact-no'>{{ $crib["contact_full"] }}</span><br />
						<span class='crib-profile-details email'>{{ $crib['email_address'] }}</span><br />
						<?php if( strlen($crib['website']) > 0 ) { ?>
						<span class='crib-profile-details website'>{{ $crib['website'] }}</span><br />
						<?php } ?>
						<span class='crib-profile-details map'><a href='#showMapModal' data-toggle="modal">View Map</a>
						<!-- Modal -->
						<div id="showMapModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="showMapLabel" aria-hidden="true">
							<div class="modal-header">
						    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						    	<h3 id="showMapLabel">Map View</h3>
						  	</div>
						  	<div class="modal-body">
						  		<div id='MapWindow'>
					        		<div id='modal-map' class='modal-map'></div>
					      		</div>						    	
						  	</div>
						  	<div class="modal-footer">
						    	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>					    	
						  	</div>
						</div>
					</div>
				</div>
				<br />
				<div class='row'>
					<div class='span8'>
						<h3>Reviews</h3>
						@if(Session::has('username'))
						<div class='review'>{{ HTML::link_to_action('review@create','Write a Review', array('id' => $crib['id']), array('class' => 'btn btn-success')); }}</div>
						@endif
						<?php foreach ( $reviews as $key => $r ) { ?>
						<div class='row review'><!-- First Review -->
							<div class='reviewer-profile span2'>
								<!-- <div class='reviewer-pic'>
									<img data-src="holder.js/90x90/#838B8B:#fff">
								</div> -->
								<div class='reviewer-details'>
									<span><b>{{ $r['created_by'] }}</b></span><br />
									@if($is_crib_owner)
										<span><a style='cursor: pointer;' class='remove-review' data-review="{{$r['id']}}">Remove Review</a></span>
									@endif
									<!--<span>Binan, Laguna</span><br />-->						
									<!--<span>2 Reviews</span><br />-->
								</div>
							</div>
							<div class='reviewer-comments span6'>
								<div class='row'>
									<div class='span4'>
									<div class='reviewer-title'>{{ $r['title'] }}</div>
									<span>Reviewed on {{ date("M d, Y H:i:s", strtotime($r['created_at'])) }}</span>
									</div>
									<div class='span2'>
										<div class="star-small reviewer-star" data-score={{ $r['stars'] }} ></div>
									</div>				
								</div>
								<br />
								<div class='reviewer-comments-details'>
									{{ $r['description']; }}
								</div>								
							</div>
							<div class='row-divider span8'></div>
						</div><!-- End of First Review -->
						<?php } // end of foreach ?>
						<div class="pagination">
						  <ul>
						   <?php
							$next = $result_count > 0 ? ($page + 1) : 0 ;
							$prev = $result_count > 0 ? ($page - 1) : 0 ; 
							if ( $page <= 1 )
								echo "<li><span>Prev</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$prev});' >Prev</a></li>";

								for($i = 1; $i <= $pages ; $i++ )
								{ 
									if ( $i ==  $page )
										echo "<li><span>{$i}</span></li>"; 
									else 
										echo "<li><a href='#' onclick='gotoPage({$i});' >{$i}</a></li>";
								}

							if ( $page == $pages )
								echo "<li><span>Next</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$next});' >Next</a></li>";
							?>
						  </ul>
						</div> <!-- End of Pagination -->
					</div>
				</div> <!-- Left side Ends here -->
			</div>
			<div class='span3'> <!-- Right Side Starts here -->
				<span>Other Lodging Near Here</span>
				<?php foreach($near as $key => $n) { ?>
				<div class='row'>
					<div class='crib-relative-lodging'>
						<div class='span1 crib-relative-lodging-header'>
							<img data-src="holder.js/50x50/#838B8B:#fff">
						</div>
						<div class='span2 crib-relative-lodging-details'>
							<span>
								<b>
									{{ HTML::link_to_action('crib@profile', strtoupper("{$n['property_name']}"), array('id' =>  $n['id'])) }}
								</b>
							</span><br>
							<span>
							<?php
								if ( $n['review_count'] > 1 )
									echo "{$n['review_count']} reviews";
								else
									echo "{$n['review_count']} review";
							?>
							</span><br />
							<span>{{ ucwords("{$n['city']}, {$n['state']}"); }}</span><br />
						</div>
					</div>
				</div>
				<?php } ?>
				<!--
				<div class='row'>
					<div class='crib-relative-lodging'>
						<div class='span1 crib-relative-lodging-header'>
							<img data-src="holder.js/50x50/#838B8B:#fff">
						</div>
						<div class='span2 crib-relative-lodging-details'>
							<span><b><a href='#'>Booon Boon Hotel</a></b></span><br />
							<span>35 Reviews</span><br />
							<span>New York City, NY</span><br />
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='crib-relative-lodging'>
						<div class='span1 crib-relative-lodging-header'>
							<img data-src="holder.js/50x50/#838B8B:#fff">
						</div>
						<div class='span2 crib-relative-lodging-details'>
							<span><b><a href='#'>Booon Boon Hotel</a></b></span><br />
							<span>35 Reviews</span><br />
							<span>New York City, NY</span><br />
						</div>
					</div>
				</div>
				-->
			</div>
		</div>

	</div>
	{{ Form::close(); }}
</div>

<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>

@endsection
@section('content_js')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
{{ HTML::script('js/gmaps.js'); }}
<script>
var map;
$(function(){	
	'use strict';
	var temp_lat = <?php echo $crib['map_lat']; ?>, temp_long = <?php echo $crib['map_long']; ?>;
	/*
	TODO: Hide this first while testing */
	map = new GMaps({
        el: '#modal-map',
        lat: temp_lat,
        lng: temp_long
    });                   
    map.addMarker({
        lat: temp_lat,
        lng: temp_long,        
        draggable: false        
    });    
    $('#showMapModal').on('shown', function () {  		
  		map.refresh();
    	map.setCenter(temp_lat, temp_long);
	});

    // Start slideshow button:
    $('#start-slideshow').button().click(function () {
    	var options = $(this).data(),
         	modal = $(options.target),
         	data = modal.data('modal');
      	if(data){
        	$.extend(data.options, options);
     	}else{
        	options = $.extend(modal.data(), options);
		}
      	modal.find('.modal-slideshow').find('i')
			.removeClass('icon-play')
         	.addClass('icon-pause');
      	modal.modal(options);
   	});

	$('.star-small').raty({	  
		path	: '/img/raty',
		readOnly: true,  	 
	  	score: function() {	  	
	    	return $(this).attr('data-score');
	  	}
	});
	$('.star-big').raty({	  
		path	: '/img/raty',
		readOnly: true,
	  	half     : true,
	  	size     : 24,
	  	starHalf : 'star-half-big.png',
	  	starOff  : 'star-off-big.png',
	  	starOn   : 'star-on-big.png',	  
	  	score: function() {	  	
	    	return $(this).attr('data-score');
	  	}
	});

	$('.remove-review').click(function(){
		var ans = confirm("Are you sure you want to remove this review?");
		if(ans) {
			var id = $(this).attr('data-review');
			
			$.ajax({
				type: 'POST',
				async: false,
				url: "<?php echo URL::to_action('crib@remove_review'); ?>",				
				data: {
					id: id
				},
				success: function(data){
					if(data.result == "success") {
						$(this).closest('.review').remove();	
					}
					else {
						alert("An error occured while trying to remove the review");
					}
				},
				dataType: "json"
			});
			console.log(id);	
		}
		
	});
});

function gotoPage(pg)
{
	$('#page').val(pg); 
	$('#form_reviews').submit();
}
</script>
@endsection