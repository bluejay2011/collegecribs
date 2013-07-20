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
		<!-- <div class='row banner'>
			<img data-src="holder.js/1170x300/#838B8B:#fff">
		</div>
		<br /> -->
		<div class='row'>
			<div class='page-header span11'>				
				<h3 class='page-header-title'>Write a Review for {{$crib->property_name}}</h3>
				<span class='page-header-description'>
					{{$crib->property_description}}
				</span>
			</div>			
		</div>
		<br />
		<div class='row'>
			{{ Form::open("/review/create/$crib->id", "POST", array("id" => "frm-create-review", "class" => "form-horizontal")); }}
			{{ Form::hidden("id", $crib->id, array("id" => "my-id")); }}
				<div class='span12'>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Rate this place:</label>
					    
					   	<div class="controls">
					    	<div class="star-small review-star" data-score=0 style="margin-top: 5px;"></div>
					    	<div id="hint" class='review-hint'></div>
					    </div>
					</div>					
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Title your Review</label>
					    <div class="controls">
					      <input type="text" class="input-xlarge" id="title" name='title' required>
					    </div>
					</div>						
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Your Review <br />(min of 50 characters)</label>
					    <div class="controls">
					    	<textarea class="input-xxlarge" rows="7" id='review' name='review'></textarea><br />
					    	<span style='font-size:11px'>minimum characters remaining: <span id="rem" title="50"></span></span>
					    </div>
					    
					</div>					
					<div class="control-group">
						<div class="controls">					    	
					    	<div class='review-agreement'>
					    	<input type="checkbox" required style='margin-top: -3px' id='agreement' name='agreement'>
					    	&nbsp;&nbsp;<b>I certify that this review is based on my own experience and is my genuine opinion of this property, and that I have no personal or business relationship with this property, and have not been offered any incentive or payment originating from the establishment to write this review.</b></div>
					    </div>
					    
					</div>	
				</div>	
			{{ Form::close(); }}
			<div class="frm-actions">
				<button type="submit" class="btn btn-primary" id='btn-submit' onClick="return validate();">Submit</button>					  	  		
			</div>				
		</div>			
	</div>
</div>
@endsection
@section('content_js')
<script>
var my_score = 0;
$(function(){	

	$('.star-small').raty({	  
		path	: '/img/raty',		
		target: '#hint', 
		targetText: ' ',
		targetKeep: true,
		hints: ['Bad', 'Poor', 'Average', 'Above Average', 'Excellent'],
	  	score: function() {		  		 	
	    	return $(this).attr('data-score');
	  	},
	  	click: function(score, evt){
	  		my_score = score;
	  	}
	});
	$('.star-big').raty({	  
		path	: '/img/raty',			  	
	  	size     : 24,
	  	starHalf : 'star-half-big.png',
	  	starOff  : 'star-off-big.png',
	  	starOn   : 'star-on-big.png',	  
	  	score: function() {	  	
	    	return $(this).attr('data-score');
	  	}
	});
	$('#hint').html("");
	$('#rem').text("50");
	$("#review").keyup(function () {
	  var cmax = $("#rem").attr("title");

	  /*if ($(this).val().length >= cmax) {
	    $(this).val($(this).val().substr(0, cmax));
	  }*/

	  if($(this).val().length >= cmax) {
	  	$("#rem").text(0);
	  }
	  else {
	  	$("#rem").text(cmax - $(this).val().length);
	  }

	});
});
function validate() {
	var is_valid = true;
	if(!$('#agreement').is(":checked")) {
		alert('Please accept the agreement');
		is_valid = false;		
	}
	else if(my_score == 0) {
		alert('Please select a rating');
		is_valid = false;		
	}
	else if($('#title').val() == "") {
		alert('Please write a title');
		is_valid = false;		
	}
	else if($('#review').val() == "") {
		alert('Please write a review');
		is_valid = false;		
	}	
	else if($('#review').val().length < 50) {
		alert('Your review must be composed of at least 50 characters');
		is_valid = false;		
	}

	if(is_valid) {
		$('#frm-create-review').submit();
	}

}
</script>
@endsection