<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>College Cribs</title>
        {{ Asset::styles() }}
        {{ Asset::scripts() }}
        <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'> -->
        <!-- TODO:  Transfer this at the bottom after development -->
        <!--<script src="https://connect.facebook.net/en_US/all.js#appId=441124352630265&xfbml=1"></script>-->
        @section('content_js')
        @yield_section
    </head>
    <body>
        <div id="fb-root"></div>
        <script>            
          window.fbAsyncInit = function() {
            // init the FB JS SDK
            FB.init({
              appId      : '441124352630265', // App ID from the App Dashboard
              channelUrl : document.location.hostname + '/channel.php', // Channel File for x-domain communication
              status     : true, // check the login status upon init?
              cookie     : true, // set sessions cookies to allow your server to access the session?
              xfbml      : true  // parse XFBML tags on this page?
            });

            // Additional initialization code such as adding Event Listeners goes here
            FB.Event.subscribe('auth.authResponseChange', function(response) {
              if (response.status === 'connected') {
                // the user is logged in and has authenticated your
                // app, and response.authResponse supplies
                // the user's ID, a valid access token, a signed
                // request, and the time the access token 
                // and signed request each expire
                var uid = response.authResponse.userID;
                var accessToken = response.authResponse.accessToken;
                //testAPI();

              } else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook, 
                // but has not authenticated your app                                       
              } else {
                // the user isn't logged in to Facebook.

              }
              //console.log(response);
             });

          };

          // Load the SDK's source Asynchronously
          // Note that the debug version is being actively developed and might 
          // contain some type checks that are overly strict. 
          // Please report such bugs using the bugs tool.
          (function(d, debug){
             var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement('script'); js.id = id; js.async = true;
             js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
             ref.parentNode.insertBefore(js, ref);
           }(document, /*debug*/ false));

            // Here we run a very simple test of the Graph API after login is successful. 
            // This testAPI() function is only called in those cases. 
            /*function testAPI() {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me', function(response) {
                    console.log('Good to see you, ' + response.name + '.');                    
                    console.log(response);
                    //fb_signin(response.id, response.email);
                });
            }*/
            function fb_login(){
                FB.login(function(response) {

                    if (response.authResponse) {
                        console.log('Welcome!  Fetching your information.... ');
                        //console.log(response); // dump complete info
                        access_token = response.authResponse.accessToken; //get access token
                        user_id = response.authResponse.userID; //get FB UID
                        console.log(response);        
                        FB.api('/me', function(response) {
                            user_email = response.email; //get user email
                            // you can store this data into your database  
                            //console.log(response.email);             
                            
                            fb_signin(response.id, response.email);
                        });
                    } else {
                        // user hit cancel button
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {
                    scope: 'publish_stream,email'
                });
            }
        </script>           
        <!-- header -->
        <!-- <hr class='hr-border1'>
        <hr class='hr-border2'> -->
        <div class='container header'>            
            <div class='row'>                
                <div class='span3'>
                    {{ HTML::image('img/college-cribs-logo.png', 'College Cribs', array('id' => 'college-cribs-logo')); }}
                </div>
                <div class='span6 ads1'>
                   
                    @if(isset($topad))
                        <img src="{{$topad}}" alt="Ads 1">
                    @else
                        <img data-src="holder.js/728x90" alt="Ads 1">
                    @endif
                </div>
                <div class='span3 login-nav-links'>                                            
                    <!-- <div class='media-link'>
                      {{ HTML::image('img/twitter-icon.png', 'College Cribs', array('id' => 'twitter-logo', 'style' => 'width:30px; height: 30px;')); }}  
                    </div>                        
                    <div class='media-link'>
                      {{ HTML::image('img/fb-icon.png', 'College Cribs', array('id' => 'twitter-logo', 'style' => 'width:30px; height: 30px;')); }}  
                    </div>  -->
                    <!-- <div>
                        <fb:login-button show-faces="true" autologoutlink="true" width="200" max-rows="1"></fb:login-button>
                    </div> -->                    
                                    
                        <ul class="nav login-nav-ul pull-right"> 
                            @if(Session::has('name'))
                                <li class=''><a href="/account/profile">Hi, {{Session::get('name')}}</a></li> 
                                <li class=''><a class='link' href="/account/logout">Logout</a></li>                                 
                            @elseif(Session::has('username'))
                                <li><a href="/account/profile">Hi, {{Session::get('username')}}</a></li>                         
                                <li><a class='link' href="/account/logout">Logout</a></li> 
                            @else
                                <li>
                                    <a href="#" class='fb-signin-link' onclick="fb_login();"><span class="fb-signin before-signin"></span></a>
                                </li>                                                                          
                                <li><a href="#myModal" data-toggle="modal">Login</a></li>  
                                <li>{{ HTML::link('account/register', 'Register'); }}</li>
                            @endif                          
                        </ul>                   
                </div>                                
            </div>
            <br />
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">                                          
                        <ul class="nav pull-left">
                            @section('navigation')
                            <!-- <li class="active"><a href="home">Home</a></li> -->
                            @yield_section
                        </ul>
                        <!-- <ul class="nav pull-right">                            
                            @if(Session::has('name'))
                                <li><a href="/account/profile">Hi, {{Session::get('name')}}</a></li> 
                                <li><a class='link' href="/account/logout">Logout</a></li>                                   
                            @elseif(Session::has('username'))
                                <li><a href="/account/profile">Hi, {{Session::get('username')}}</a></li>                                  
                                <li><a class='link' href="/account/logout">Logout</a></li>  
                            @else
                                <li><a href="#myModal" data-toggle="modal">Login/Register</a></li>  
                            @endif
                        </ul> -->
                    </div>
                </div>
            </div>
        </div> <!-- /header -->

        <!-- body -->
        <div class="container">            
            <div class='myalerts'>
                @if(Session::has('status_error'))
                    <div class="alert alert-error">{{ Session::get('status_error') }}</div>
                @elseif(Session::has('status_success'))
                    <div class="alert alert-success">{{ Session::get('status_success') }}</div>
                @endif
            </div>            
            @yield('content')
            <hr>
            <footer>          
                <div class='row'>
                    <div class='span2 offset1 footer footer-left'>
                        <br />
                        <div class='footer-information'>
                            <span class='footer-title'>Contact Information</span>
                            <span>Telephone: 947 5858</span>
                            <span>Location: Makati City</span>
                        </div>
                        <br />
                        <div class='footer-information'>
                            <span class='footer-title'>Email</span>
                            <span>info@collegecribs.com</span>
                            <span>inquiry@collegecribs.com</span>
                        </div>                        
                    </div>
                    <div class='span8 footer footer-right'>
                        <span id='footer-logo'>
                            {{ HTML::image('img/logo-small.png', 'College Cribs', array('id' => 'college-cribs-logo')); }}
                        </span>
                        <br />
                        <span class='footer-tagline'>Reviews and advice on condominiums, apartments, boarding houses</span>
                        <br /><br />
                        <span>&copy 2012 College Cribs All rights reserved. College Cribs <a href='#'>Terms of Use</a> and <a href='#'>Privacy Policy</a>.</span><br />
                        <span>College Cribs is not a booking agent and does not charge any service fees to users of our site...(<a href='#'>more</a>)</span><br />
                        <span>College Cribs is not responsible for content on external web sites. Taxes, fees not included for deals content.</span>                        
                    </div>           
                </div>     
            </footer>
        </div> <!-- /container -->   
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" id='btn-login-close' class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Login your account</h3>
          </div>
          <div class="modal-body">
            <div class='myalerts'>                
                <div class="alert alert-error status-login" id='status-login-error'></div>                
                <div class="alert alert-success status-login" id='status-login-success'></div>                
            </div>
            {{ Form::open('account/sign_in', 'POST', array('class' => 'form-horizontal', 'id' => 'frm-login')); }}  
              <div class="control-group">
                <label class="control-label" for="loginUsername">Username</label>
                <div class="controls">
                  <input type="text" id="login-username" placeholder="username" name="username">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="loginPassword">Password</label>
                <div class="controls">
                  <input type="password" id="login-password" placeholder="Password" name="password">
                </div>
              </div>
              <!-- <div class="control-group">
                <div class="controls">
                  <label class="checkbox">
                    <input type="checkbox"> Remember me
                  </label>
                  
                </div>
              </div> -->
            {{ Form::close(); }}
          </div>
          <div class="modal-footer">
            <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->       
            <!-- {{ HTML::link('account/login_via_facebook', 'Login via Facebook', array('class' => 'btn')); }} -->
            
            {{ HTML::link('#', 'Login', array('class' => 'btn btn-primary', 'onClick' => 'return validate_sign_in()')); }}
            {{ HTML::link('account/register', 'Register', array('class' => 'btn')); }}
            <!-- <fb:login-button
                registration-url="<?php echo URL::home() ?>account/register" 
                on-login="console.log(arguments)"
            /> -->
          </div>
        </div>  
        <br />   
    </body>
</html>

<script>
$(function(){
    $('.status-login').hide();   
});

function validate_sign_in() {

    var username_regex = /^[\w.-]+$/; // letters, digits, and the underscore, dash, dot
    var password_regex = /^[A-Za-z\d]{5,30}$/;  // any upper/lowercase characters and digits, between 6 to 8 characters in total
    var username = $('#login-username').val();
    var password = $('#login-password').val();
    var is_valid = true;
    var message = '';

    if(username == '') {
        message = 'Please provide username.';
        is_valid = false;
    }
    else if(password == '') {
        message = 'Please provide password.';
        is_valid = false;
    }        
    else if(!username_regex.test(username)) {     
        message = "Invalid Username. Can only use alphanumeric, dash, dot and underscore.";
        is_valid = false;
    }       
    else if(!password_regex.test(password)) {     
        message = "Invalid Password. Can only use any upper/lowercase characters and digits. Minimum of 5 to 30 characters only.";
        is_valid = false;
    }       
    else {        
        //$('#frm-login').submit();
        $.ajax({
            type: 'POST',
            async: false,
            data: {
                username: username,
                password: password
            },
            url: "<?php echo URL::to_action('account@sign_in'); ?>",
            success: function(data) {
                if(data.result == 'success') {
                    document.location = "<?php echo URL::to_action('/'); ?>";
                    // Reload Page
                }
                else {
                    message = data.message;
                    is_valid = false;
                }
                
            },
            dataType: 'json'
        });
    }


    if(is_valid == false) {
        $('#status-login-error').html(message);
        $('#status-login-error').show();
    }
    return false;
}

function fb_signin(user_id, email)
{
    $.ajax({
        type: 'POST',
        async: false,
        data: {
            userid : user_id,
            email: email
        },
        url: "<?php echo URL::to_action('account@fblogin'); ?>",
        success: function(data) {
            if(data.result == 'success') {
                //document.location = "<?php echo URL::to_action('/'); ?>";
                // Reload Page
                $('.login-nav-ul').html('');
                $('.login-nav-ul').append("<li class=''><a href='/account/profile'>Hi, "+ data.details.name +"</a></li>");
                $('.login-nav-ul').append("<li class=''><a class='link' href='/account/logout'>Logout</a></li>");
                document.location.href = "/";
            }
            else {
                message = data.message;
                is_valid = false;
            }
            
        },
        dataType: 'json'
    });
}
</script>
