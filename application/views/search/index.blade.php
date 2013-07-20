@layout('layouts/main')
@section('navigation')
	@parent	
  <li class="active"><a href="home">Home</a></li>
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
<script>
$(function(){
  $('.star-small').raty({   
    path  : '/img/raty',
    readOnly: true,    
      score: function() {     
        return $(this).attr('data-score');
      }
  });
});

function gotoPage(pg)
{
  $('#page').val(pg); 
	$('#form_result').submit();
}
function setPage(pg)
{
	$('#page').val(pg);
}
</script>

<div class='container'>
  <div class='row'>
    <div class='span4 search-container'>
      <div class='search-form-container'>     
        <h4>I'm looking for:</h4>
        {{ Form::open("/search", "POST", array("id" => "form_search")); }}       
          <label>Property Type: </label>
           {{ Form::select('property_type', $property_type, $property_type_val); }}
          <label>Minimum Price</label>
          <div class="input-prepend">
            <span class="add-on">Php</span>
            <input name='rent_min' class='input-large' type="text" placeholder="1000" value=<?php echo $rent_min_val ?> >
          </div>
          <label>Maximum Price</label>
          <div class="input-prepend">
            <span class="add-on">Php</span>
            <input name='rent_max' class='input-large' type="text" placeholder="5000" value=<?php echo $rent_max_val ?> >
          </div>
          <label>Search By</label>          
          <input name='address' type='text' class='input-xlarge' placeholder='Property Name, Address, Postal Code' value=<?php echo $address_val ?>>
          <br />
		  <input type="submit" value="Search!"  class="btn btn-success"  style='margin-top -1%' />
        {{ Form::close(); }}
      </div> <!-- /#search -->   
    </div>
	
	{{ Form::open("/search", "POST", array("id" => "form_result")); }}
	{{ Form::hidden("property_type", $property_type_val); }}
	{{ Form::hidden("rent_min", $rent_min_val); }}
	{{ Form::hidden("rent_max", $rent_max_val); }}
	{{ Form::hidden("address", $address_val); }}
	{{ Form::hidden("page", $page, array("id" => "page")); }}
    <div id='search-wrapper' class='span8'>
			<div class='row'>
				<div class='span4'>
					<?php $result = ($result_count <= 1) ? "result" : "results" ; ?>
					<h4><?php echo "{$result_count} {$result}"; ?> </h4>
				</div>
				<div class='result-per-page-option span4'>
						<span>Display Per Page :</span>
						{{  Form::select('limit', $limits, $limit, array( "id" => "result-per-page", "class" => "span1")); }}
						<input type="submit" value="Go!"  class="btn btn-success"  style='margin-top -1%' onclick="setPage(1);" />
				</div>
				<div class='span8 search-result-pagination'>
					<div class='page-number pull-left'>Page <?php echo"{$page} of {$pages}"; ?></div>		
					
					<div class='pull-right pagination pagination-small'>
						<ul>
							<?php
							$next = $result_count > 0 ? ($page + 1) : 0 ;
							$prev = $result_count > 0 ? ($page - 1) : 0 ; 
							if ( $page <= 1 )
								echo "<li class='disabled'><span>&laquo;</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$prev});' >&laquo;</a></li>";

								for($i = 1; $i <= $pages ; $i++ )
								{ 
									if ( $i ==  $page )
										echo "<li class='active'><span>{$i}</span></li>"; 
									else 
										echo "<li><a href='#' onclick='gotoPage({$i});' >{$i}</a></li>";
								}

							if ( $page == $pages )
								echo "<li class='disabled'><span>&raquo;</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$next});' >&raquo;</a></li>";
							?>
						</ul>		
					</div>
				</div>
				
				<div id='search-results' class='span8'>
					<div class='row'>
						<?php
							$max = count($property);
							$i = 0;
							foreach($property as $key => $p){
								$i++;
								$extra_class = ($i == $max ? 'last-item' : '');
						?>
						<div class='search-result-item span8 <?php echo $extra_class; ?>'>
							<div class='row property'>      
								<div class='span6'>
									<div class='row'>
										<div class='span3 property-img'>
											<img data-src="holder.js/300x100/#838B8B:#fff">
										</div>
										<div class='span3 property-details'>
											<div class='property-name'>
												{{HTML::link_to_action('crib@profile', $p->property_name, array('id' =>  $p->id))}}
											</div>
											<div class='property-type'>as low as Php {{ number_format( round( floatval($p->rent_min), 2), 2) }}</div>
											<div class='property-type'>{{ ucwords(strtolower($property_type[$p->property_type_id])) }}</div>
											<div class='property-location'>{{ ucwords("{$p->state}, {$p->city}") }}</div>           
											<!-- <div class='property-relative-location'>Located near:</div>
											<div class='property-relative-location-img'>
												<ul>
													<li><img src="img/feu.jpg"></li>
													<li><img src="img/ust.jpg"></li>
												</ul>
											</div> -->
										</div>
									</div>
								</div>
								<div class='span2 property-details'>      
									<div class="star-small property-star" data-score="3"></div>
								</div>      
							</div>
						</div>
						<?php } ?>
					</div>
				</div>

				<div class='span8 search-result-pagination'>
					<div class='page-number pull-left'>Page <?php echo"{$page} of {$pages}"; ?></div>
					
					<div class='pull-right pagination pagination-small'>
						<ul >
							<?php
							if ( $page <= 1 )
								echo "<li class='disabled'><span>&laquo;</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$prev});' >&laquo;</a></li>";

								for($i = 1; $i <= $pages ; $i++ )
								{ 
									if ( $i ==  $page )
										echo "<li class='active'><span>{$i}</span></li>"; 
									else 
										echo "<li><a href='#' onclick='gotoPage({$i});' >{$i}</a></li>";
								}

							if ( $page == $pages )
								echo "<li class='disabled'><span>&raquo;</span></li>";
							else
								echo "<li><a href='#' onclick='gotoPage({$next});' >&raquo;</a></li>";
							?>
						</ul>
					</div>
				</div>
				
				
			</div> <!-- .row -->
    </div> <!-- #search-wrapper -->
	{{ Form::close(); }}
  </div>
@endsection

