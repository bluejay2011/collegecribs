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
			<img data-src="holder.js/728x90/#838B8B:#fff">
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
			<div class='span12'>
				<div>					
					<span class='ads-title'>Top Ads (Banner Area)</span>
					<small><a style='cursor:pointer;' onClick='show_upload_menu(1)'>Change</a></small>					
				</div>				
				<div class='span5'>
					<br />
					<div>
						@if(isset($topad))
							<img src="{{$topad}}" /><br />
						@else
							<img data-src="holder.js/728x90/#838B8B:#fff/text:Not Available"><br />
						@endif						
					</div>
				</div>
				<div class='span6'>
					<div id='div-upload-1' class='ads-show-upload'>
					{{ Form::open('admin/ads', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-details1', 'enctype' => "multipart/form-data")); }}				
						{{ Form::hidden('banner', 'topad'); }}						
						<small>Please make sure to upload maximum of 728x90 only</small><br />					
						<output id="list1" class="topad"></output><br />					
						<input class="ads-photo-input" type="file" id="topad" name="ads"/>					
						<br /><br />
						<button type="button" class="btn btn-primary" id='btn-ad1'>Submit</button>
					{{ Form::close(); }}
					</div>
				</div>
			</div>			
		</div>
		<br /><br />
		<div class='row ads-settings'>		
			<div class='span12'>
				<div>					
					<span class='ads-title'>Sidebar Ads 1</span>
					<small><a style='cursor:pointer;' onClick='show_upload_menu(2)'>Change</a></small>					
				</div>				
				<div class='span5'>
					<br />
					<div>
						@if(isset($ad1))
							<img src="{{$ad1}}" /><br />
						@else
							<img data-src="holder.js/300x250/#838B8B:#fff/text:Not Available"><br />
						@endif						
					</div>
				</div>
				<div class='span6'>
					<div id='div-upload-2' class='ads-show-upload'>
					{{ Form::open('admin/ads', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-details2', 'enctype' => "multipart/form-data")); }}				
						{{ Form::hidden('banner', 'ad1'); }}
						<!-- <h4>Side Bar Ads 1</h4>	 -->
						<small>Please make sure to upload maximum of 300x250 only</small><br />
						<output id="list2" class="sidead1"></output><br />
						<!-- <img data-src="holder.js/400x100/#838B8B:#fff/text:preview"><br />		 -->			
						<!-- <label class="ads-photo-label">Select Photo</label> -->
						<input class="ads-photo-input" type="file" id="sidead1" name="ads"/>
						<br /><br />
						<button type="button" class="btn btn-primary" id='btn-ad2'>Submit</button>
					{{ Form::close(); }}
					</div>
				</div>
			</div>						
		</div>
		<div class='row ads-settings'>		
			<div class='span12'>
				<div>					
					<span class='ads-title'>Sidebar Ads 2</span>
					<small><a style='cursor:pointer;' onClick='show_upload_menu(3)'>Change</a></small>					
				</div>				
				<div class='span5'>
					<br />
					<div>
						@if(isset($ad2))
							<img src="{{$ad2}}" /><br />
						@else
							<img data-src="holder.js/300x250/#838B8B:#fff/text:Not Available"><br />
						@endif						
					</div>
				</div>
				<div class='span6'>
					<div id='div-upload-3' class='ads-show-upload'>
					{{ Form::open('admin/ads', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-details3', 'enctype' => "multipart/form-data")); }}				
						{{ Form::hidden('banner', 'ad2'); }}
						<h4>Side Bar Ads 2</h4>	
						<small>Please make sure to upload maximum of 300x250 only</small><br />
						<output id="list3" class="sidead2"></output><br />						
						<input class="ads-photo-input" type="file" id="sidead2" name="ads"/>
						<br /><br />
						<button type="button" class="btn btn-primary" id='btn-ad3'>Submit</button>
					{{ Form::close(); }}
					</div>
				</div>
			</div>									
		</div>
		<!-- <div class='row ads-settings'>		
			<div class='span11'>
				{{ Form::open('admin/ads', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-details4', 'enctype' => "multipart/form-data")); }}				
				{{ Form::hidden('banner', 'ad3'); }}
					<h4>Side Bar Ads 3</h4>						
					<small>Please make sure to upload maximum of 300x300 only</small><br />
					<output id="list4" class="sidead3"></output><br />					
					<input class="ads-photo-input" type="file" id="sidead3" name="ads"/>
					<br /><br />
					<button type="button" class="btn btn-primary" id='btn-ad4'>Submit</button>
				{{ Form::close(); }}
			</div>
		</div> -->
	</div>
</div>
@endsection
@section('content_js')
<script>
var list1 = false;
var list2 = false;
var list3 = false;
var list4 = false;
var can_submit = false;

//document.getElementById('files3').addEventListener('change', handleFileSelect, false);
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var id = evt.target.id;
    console.log(evt);

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

    	// Clear Error message
	  $('#' + id).nextAll('span').remove();

      // Only process image files.
      if (!f.type.match('image.*')) {      	
      	$('#' + id).nextAll('span').remove();
      	$('.' + id).html("");
      	show_error('not_image', id);
      	can_submit = false;
        continue;
      }
      else {
      	can_submit = true;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');

          if(id == 'topad') {
          	//document.getElementById('list1').insertBefore(span, null);
          	$('#list1').html(span);
          	list1 = true;
          }
          else if(id == 'sidead1') {
          	//document.getElementById('list2').insertBefore(span, null);
          	$('#list2').html(span);
          	list2 = true;
          }
          else if(id == 'sidead2') {
          	//document.getElementById('list3').insertBefore(span, null);
          	$('#list3').html(span);
          	list3 = true;
          }
          else if(id =='sidead3') {
          	//document.getElementById('list4').insertBefore(span, null);
          	$('#list4').html(span);
          	list4 = true;
          }
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
}

function show_error(type, id)
{
	if(type=='not_image') {
		$('#' + id).after("<span style='color:red'>Please select an image file</span>");
	}	
}

$(function(){
	document.getElementById('topad').addEventListener('change', handleFileSelect, false);
	document.getElementById('sidead1').addEventListener('change', handleFileSelect, false);
	document.getElementById('sidead2').addEventListener('change', handleFileSelect, false);
	document.getElementById('sidead3').addEventListener('change', handleFileSelect, false);

	$('#btn-ad1').click(function(){				
		if(list1 && can_submit) {
			$('#frm-details1').submit();						
		}
		else {			
			$('#topad').nextAll('span').remove();
			$('#topad').after("<span style='color:red'>Please select valid file</span>");						
		}	
	});
	$('#btn-ad2').click(function(){		
		if(list2  && can_submit) {
			$('#frm-details2').submit();						
		}
		else {
			$('#sidead1').nextAll('span').remove();
			$('#sidead1').after("<span style='color:red'>Please select valid file</span>");						
		}
	});
	$('#btn-ad3').click(function(){
		if(list3  && can_submit) {
			$('#frm-details3').submit();						
		}
		else {
			$('#sidead2').nextAll('span').remove();
			$('#sidead2').after("<span style='color:red'>Please select valid file</span>");			
		}
	});
	$('#btn-ad4').click(function(){
		if(list4  && can_submit) {
			$('#frm-details4').submit();						
		}
		else {
			$('#sidead3').nextAll('span').remove();
			$('#sidead3').html("<span style='color:red'>Please select valid file</span>");			
		}
	});
});

function show_upload_menu(ctr) {
	$('#div-upload-' + ctr).slideDown('slow');	
}
</script>
@endsection