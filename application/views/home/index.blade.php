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
<div class='container'>
  <div class='row'>
    <div class='span4 search-container'>
      <div class='search-form-container'>     
        <h4>I'm looking for:</h4>
				{{ Form::open("/search", "POST"); }}  
          <label>Property Type: </label>
           {{ Form::select('property_type', $property_type, ''); }}
          <label>Minimum Price</label>
          <div class="input-prepend">
            <span class="add-on">Php</span>
            <input name='rent_min' class='input-large' type="text" placeholder="1000">
          </div>
          <label>Maximum Price</label>
          <div class="input-prepend">
            <span class="add-on">Php</span>
            <input name='rent_max' class='input-large' type="text" placeholder="5000">
          </div>
          <label>Search By</label>          
          <input name='address' type='text' class='input-xlarge' placeholder='Property Name, Address, Postal Code'  />
          <br />
		  <input type="submit" value="Search!"  class="btn btn-success"  style='margin-top -1%' />
			{{ Form::close(); }}
      </div> <!-- /#search -->   
    </div>
    <div class='span8'>
      <div id="myCarousel" class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">
          @if($carousel)
            @foreach($carousel as $img)
            <div class="item">
              <img class='carousel-img'  src="/img/property/{{$img['property_id']}}/{{$img['name']}}">      
              <div class="carousel-caption">
                <h4>{{$img['property_name']}}</h4>
                <p>{{$img['description']}}</p>
              </div>
            </div>  
            @endforeach
          @else
            <div class="active item">
              <img data-src="holder.js/770x340/#000:#fff">      
            </div>
            <div class="item">
              <img data-src="holder.js/770x340/#838B8B:#fff">
              <div class="carousel-caption">
                <h4>First Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              </div>
            </div>
          @endif

          <!-- <div class="active item">{{ HTML::image('img/property/b.jpg', 'College Cribs'); }}</div>
          <div class="item">{{ HTML::image_link('#', 'img/property/b.jpg', 'College Cribs'); }}</div> -->
          <!-- <div class="active item"><img data-src="holder.js/770x340"></div>
          <div class="item">
            <img data-src="holder.js/770x340/#000:#fff">      
          </div>
          <div class="item">
            <img data-src="holder.js/770x340/#838B8B:#fff">
            <div class="carousel-caption">
              <h4>First Thumbnail label</h4>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </div>
          </div> -->
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
      </div> <!-- /myCarousel -->
    </div>
  </div>
</div>
<div class='container'>
    <div class=''>      
      <div class='row'>
        <div class='span9'>
			  @foreach ( $crib_ads as $key => $ad )
          <div class='row property'>      
            <div class='span6'>
              <div class='row'>
                <div class='span3 property-img'>                  
                  <!-- <img data-src="holder.js/300x100/#838B8B:#fff"> -->                  
                  <img src="/img/property/thumbnail/{{$ad['thumbnail']}}">          
                </div>
                <div class='span3 property-details'>
                  <div class='property-name'>{{ HTML::link_to_action('crib@profile', $ad['property_name'], array('id' => $key)); }}</div>
                  <div class='property-type'>{{ ucwords(strtolower($property_type[$ad['property_type_id']])); }}</div>
                  <div class='property-location'>{{ ucwords("{$ad['city']}, {$ad['state']}"); }}</div>                      
                </div>
              </div>
            </div>
            <div class='span2 property-details'>                   
              <div class="star-small property-star" data-score="{{$ad['rate']}}"></div>
            </div>          
          </div> <!-- /.property -->
			  @endforeach
        </div>
        <div class='span3'>
          <div class='other-ads'>           
            <div class='row side-ads'>
              @if(isset($ad1))
                <img src="{{ $ad1 }}">
              @else
                <img data-src="holder.js/300x250/#838B8B:#fff">
              @endif
            </div>              
            <div class='row side-ads'>
              @if(isset($ad2))
                <img src="{{ $ad2 }}">
              @else
                <img data-src="holder.js/300x250/#838B8B:#fff">
              @endif              
            </div>           
            <!-- <div class='row side-ads'>
              <img data-src="holder.js/270x250/#838B8B:#fff">
            </div>  -->
          </div> <!-- /.other-ads -->
        </div>
      </div>
    </div>
</div> <!-- /container -->
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
  $( ".carousel-img" ).aeImageResize({ height: 770, width: 340 });  
});
</script>
@endsection