@layout('layouts/main')
@section('navigation')
	@parent	
	<li><a href="/home">Home</a></li>	
  	<li><a href="/contact_us">Contact Us</a></li>
  	<li><a href="/listing">Place a Listing</a></li>
@endsection
@section('content')
<div class='container'>
	<div class='span12'>		
		<div class='row'>
			<div class='page-header span11'>				
				<h2 class='page-header-title'>Registration</h2>
				<span class='page-header-description'>
					<b>You are creating a new account. Fill-in all fields OR </b>
					<span>{{HTML::image('img/connect-facebook-button2.png', "Join Now", array("style" => "width: 17%; cursor:pointer", "id" => 'fb-register-btn'));}}</span>
				</span>
			</div>			
		</div>
		<!--<br />
		<div class='row'>
			<div class='span12'>			
				<div id='register-fb' class='span4' style='margin-left: 11%'>
					{{HTML::image('img/connect-facebook-button2.png', "Join Now");}}
				</div>
			</div>			
		</div>
		<div class='clearfix'></div><br />
		<div class='row'>
			<div class='span12'>			
				<span class='span4' style='margin-left: 18%'>----- OR -----</span>
			</div>			
		</div>
		<div class='clearfix'></div><br />-->
		<div class='row'>	
			 {{ Form::open('account/fbregister', 'POST', array('class' => 'form-horizontal register', 'id' => 'frm-register')); }}				
			 	<input type="hidden" id="fbid" name="fbid">
				<div class='span6'>								
					<div class="control-group">
					    <label class="control-label" for="firstname">First Name<span class="req">*</span></label>
					    <div class="controls">
					      <input type="text" id="firstname" placeholder="First Name" name="firstname" class='required'><span class="help-block"></span>					      
					    </div>
					</div>						
					<div class="control-group">
					    <label class="control-label" for="lastname">Last Name<span class="req">*</span></label>
					    <div class="controls">
					      <input type="text" id="lastname" placeholder="Last Name" name="lastname" class='required'><span class="help-block"></span>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Email<span class="req">*</span></label>
					    <div class="controls">
					      <input type="text" id="email" placeholder="john.doe@gmail.com" name="email" class='required'><span class="help-block"></span>
					    </div>
					</div>								
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Username<span class="req">*</span></label>
					    <div class="controls">
					      <input type="text" id="username" placeholder="Username" name="username" class='required'><span class="help-block"></span>					      
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Password<span class="req">*</span></label>
					    <div class="controls">
					      <input type="password" id="password" name="password" class='required'><span class="help-block"></span>					      
					    </div>
					</div>	
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Retype Password<span class="req">*</span></label>
					    <div class="controls">
					      <input type="password" id="retype-password" name="retype_password" class='required'><span class="help-block"></span>					      
					    </div>
					</div>										
					<div class="control-group">
					    <label class="control-label" for="inputDorm">Is Owner</label>
					    <div class="controls">
					      <input type="checkbox" id="is-owner" name="is_owner">
					    </div>
					</div>
					<!--<div class="control-group">
					    <label class="control-label" for="inputDorm">Membership Type</label>
					    <div class="controls">
					      {{ Form::select('size', $membership, ''); }}
					    </div>
					</div>	-->					
					<div class="control-group">
						<div class="controls">							
							<!--<a href="#" class="btn btn-primary">Save details</a>-->
							<input type="submit" class="btn btn-large btn-success submit" value="Create my account!" />
							<fb:facepile></fb:facepile>							
						</div>
					</div>
				</div>
				<div class='span6'>								
					<div id='register-pic'>						
						{{HTML::image('img/working-together.jpg', "Join Now");}}
					</div>
					<div  id='additional-owner-details' class='span5' style="background:palegoldenrod; padding-top: 20px; padding-right: 20px">										
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Additional Owner Details</b></p>
						<div class="control-group">
						    <label class="control-label" for="inputDorm">Contact Number</label>
						    <div class="controls">
						      <input type="text" id="contact-number" name="contact_number" placeholder="Cellphone or Landline Number"><span class="help-block"></span>					      
						    </div>
						</div>	
						<!--<div class="control-group">
						    <label class="control-label" for="inputDorm">Full Name</label>
						    <div class="controls">
						      <input type="text" id="dorm-name" placeholder="Full Name">
						    </div>
						</div>	-->
						<br />					
					</div>	
				</div>
			{{ Form::close(); }}
		</div>
	</div>
</div>
@endsection
@endsection
@section('content_js')
<script>
$(function(){
	//console.log(<?php echo $_REQUEST; ?>);
	//console.log($("input[name='first_name']"));	
	$('#additional-owner-details').hide();
	$('#is-owner').click(function(){
		if($(this).is(':checked')){
			$('#additional-owner-details').slideDown('slow');
			$('#register-pic').slideUp('slow');
		}
		else {
			$('#additional-owner-details').slideUp('slow');	
			$('#register-pic').slideDown('slow');
		}
	});

	$('#fb-register-btn').click(function(){
		// Additional initialization code such as adding Event Listeners goes here
        FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token 
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;

             FB.api('/me', function(response) {
                 	if(response) {
                   		console.log('Good to see you, ' + response.name + '.');
                   		console.log(response);
                   		$('#firstname').val(response.first_name);
                   		$('#lastname').val(response.last_name);
                   		$('#email').val(response.email);
                   	}
                 });
          } else {
          	 FB.login(function(response) {
               if (response.authResponse) {
                 console.log('Welcome!  Fetching your information.... ');
                 FB.api('/me', function(response) {
                 	if(response) {
                   		console.log('Good to see you, ' + response.name + '.');
                   		console.log(response);                   		
                   		$('#fbid').val(response.id);
                   		$('#firstname').val(response.first_name);
                   		$('#lastname').val(response.last_name);
                   		$('#email').val(response.email);
                   	}
                 });
               } else {
                 console.log('User cancelled login or did not fully authorize.');
               }
             }, {scope: 'email'});   
          }        
         });
		     
		
	});

	$('#frm-register').validate({		
		rules: {
			firstname: {
            	minlength: 2,
            	required: true
	        },
	        lastname: {
	            minlength: 2,
	            required: true
	        },
	        email: {
	        	minlength: 2,
	            required: true,
	            email: true
	        },
	        username: {
	        	minlength: 2,
	            required: true,
	            remote: {
	                url: "<?php echo URL::to_action('account@check_username'); ?>",
	                type: 'POST',
	                dataType: "json",
	                data: {
 						username: function(){ return $("#username").val(); }
	                }
	            }
	        },
	        password: {
	        	minlength: 5,
	        	maxlength: 30,
	            required: true
	        },
	        retype_password: {
	        	equalTo: '#password'
	        },	        
	        contact_number: {
	        	required: function(element){
	        		if($('#is-owner').is(':checked')) {
	        			if(element.value == "") {	        			
	        				return true;
	        			}
	        			/*else {
	        				return false;
	        			}*/	        			
	        		}
	        		else {
	        			return false;
	        		}
	        	},
	        	digits: true,
	        	minlength: 7,
	        	maxlength: 13
	        }	       
		},
		messages: {
		    firstname: "Please enter your first name.",
		    lastname: "Please enter your last name.",		    
		    username: {
		    	required: "Please enter a username",
		    	minlength: "Your username must consist of at least {0} characters.",
		    	remote: jQuery.validator.format("{0} is already taken.")
		    },
		    email: "Please enter a valid email address",
		    password: {
		    	required: "Please provide a password",
            	minlength: "Your password must be at least {0} characters long.",
            	maxlength: "Your password must be less than {0} characters long."
		    },
		    retype_password: {
            	equalTo: "Please enter the same passwords."
        	},
		    contact_number: {
		    	required: "Please enter contact number.",
		    	digits: "Only numbers are allowed.",
		    	minlength: "Contact Number must be at least {0} characters long.",
		    	maxlength: "Contact Number must be less than {0} characters long."
		    }
		},
		highlight: function (element, errorClass, validClass) {
		    $(element).closest('.control-group').removeClass('success').addClass('error');
		},
		unhighlight: function (element, errorClass, validClass) {
		    $(element).closest('.control-group').removeClass('error').addClass('success');
		},
		success: function (label) {
		    $(label).closest('form').find('.valid').removeClass("invalid");
		},
		errorPlacement: function (error, element) {
		    element.closest('.control-group').find('.help-block').html(error.text());
		}
	});	
});

/*function validate_me() {

	//errors = {};
	var errors = '';
	var is_valid = true;
	var username_regex = /^[\w.-]+$/; // letters, digits, and the underscore, dash, dot
	var password_regex = /^[A-Za-z\d]{8,30}$/;  // any upper/lowercase characters and digits, between 6 to 8 characters in total
	var name_regex = /^[\w]+$/;
	var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	var phone_regex = /^[\d-()]{7,15}$/;


	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var email = $('#email').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var retype_password = $('#retype-password').val();


	// First Name
	if (firstname == "") {
		errors += "Please provide a first name.";
		is_valid = false;
	}
	else if (!name_regex.test(firstname)){		
		errors += "Invalid first name. Can only use alphanumeric.";
		is_valid = false;
	}

	// Last Name
	if (lastname == "") {
		errors += "Please provide a last name.\n";
		is_valid = false;
	}
	else if (!name_regex.test(lastname)) {		
		errors += "Invalid last name. Can only use alphanumeric.\n";
		is_valid = false;
	}

	// Email
	if (email == "") {
		errors += "Please provide an email.\n";
		is_valid = false;
	}
	else if (!email_regex.test(email)) {		
		errors +=  "Invalid email format.\n";
		is_valid = false;
	}


	// Username
	if (username == "") {
		errors += "Invalid username. Please provide a username.\n";
		is_valid = false;
	}
	else if (!username_regex.test(username)) {		
		errors +=  "Invalid Username. Can only use alphanumeric, dash and underscore.\n";
		is_valid = false;
	}	

	// Password
	if (password == "") {
		errors += "Invalid password. Please provide a password.\n";
		is_valid = false;
	}
	else if (!password_regex.test(password)) {		
		errors +=  "Invalid Password. Can only use any upper/lowercase characters and digits. Minimum of 8 to 30 characters only.\n";
		is_valid = false;
	}		

	// Retype passowrd
	if (retype_password == "") {
		errors +=  "Please input for retype password.\n";
		is_valid = false;
	}
	else if (password == retype_password ) {		
		errors +=  "Passwords does not match.\n";
		is_valid = false;
	}	

	// Validate other owner fields
	if($('#is-owner').is(':checked')) {
		if ($('#contact-number').val() == "") {
			errors +=  "Phone number is required for owner accounts.\n";
			is_valid = false;
		}
		else if (!phone_regex.test($('#contact-number').val())) {		
			errors +=  "Invalid Contact Number.\n";
			is_valid = false;
		}		
	}

	
	if(is_valid == false) {
		$('.myalerts').append('<div class="alert alert-error">' + errors + '</div>');		 
		//return errors;
		return false;
	}
	else {		
		$.ajax({
            type: 'POST',
            async: false,
            data: {
                username: $('#username').val()
            },
            url: "<?php echo URL::to_action('account@check_username'); ?>",
            success: function(response) {            	
                if (response.status < 1) {
					// Username isn't taken, let the form submit
					//cb();
					console.log('submit');
				}
				else {					
					errors +=  "Username already taken.\n";      
				}
            },
            dataType: 'json'
        });	
	}
	return is_valid
}*/
</script>
@endsection