<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
error_reporting(0);
include_once "shared/ez_sql_core.php";
include_once "ez_sql.php";
$db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');
session_start();
if ( $_POST )
{
    // process the login form
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <LINK href="mm2k11.css" rel="stylesheet" type="text/css">
        <title>Murder Mystery Party - 2011</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"</script>
        <script type="text/javascript" src="js/additional-methods.min.js"</script>
<script type="text/javascript">

           

 $().ready(function() {
     $("#guest").change( function() {

     if ( $(this).attr("checked")) {
     $("#guest_details").html("<p><label for='gf_name'>Guest First Name</label><br/><input id='gf_name' name='gf_name' /></p><p><label for='gl_name'>Guest Last name</label><br/><input id='gl_name' name='gl_name' /></p><p><label for='gemail'>Guest Email</label><br/><input id='gemail' name='gemail' /></p><p><label for='ggender'>Guest Gender</label><br/><input type='radio' value=0 id='ggender' name='ggender' />Male<br /><input type='radio' value=1 id='ggender' name='ggender' />Female<br /><input type='radio' value=2 id='ggender' name='ggender' />Not Important<br /></p>").fadeIn();
     return;
    } else {
        $("#guest_details").fadeOut();
    }
})
        $('#error\\S*').hide();
        $('#Console\\S*').hide();
         $("#signupForm").submit(function() {
                $.post("doRegister.php", {email: $("#email").val(),
                                          password: $('#password').val(),
                                          gender: $("input[name='gender']:checked").val(),
                                          f_name: $('#f_name').val(),
                                          l_name: $('#l_name').val(),
                                          invite_code: $('#invite_code').val(),
                                          gemail: $("#gemail").val(),
                                          gf_name: $("#gf_name").val(),
                                          gl_name: $("#gl_name").val(),
                                          ggender: $("#ggender").val()},
                function(data) {

                   // if ( data.mail_sent)
                 //       {
                   //         $("#mailSent").html("mailSent").fadeIn();
                  //          $("#Console").fadeOut

                 //       }
                    if (!data.registered)
                    {
                        $("#Console").fadeOut();
                        $("#errorConsole").html(data.message).fadeIn();
                        
                    }
                    else
                    {
                        $("#errorConsole").fadeOut();
                        $("#Console").html(data.message).fadeIn();
                        
                    }

                }, 'json');
                return false;
		});

	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			f_name: "required",
			l_name: "required",
			
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
                        gender: {
                            required: true
                        }
		},
		messages: {
			f_name: "Please enter your first name",
			l_name: "Please enter your last name",
			
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Password's don't match"
			},
			email: "Please enter a valid email address",
                        gender: "Please select a gender or choose not to specify"
		}
	});
       
            
        
 });
   

    </script>
       
    </head>
<?php


?>
   
    <body>
       <div class="main">
  <div class="header">

    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html">Jack <span>A</span>ttack</a><small> Murder Mystery 2011</small></h1>
      </div>
      <div class="menu_nav">
                <ul>

          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="support.html">Support</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="contact.html">Contact Us</a></li>
        </ul>

             <div class="clr"></div>
            </div>

        <div class="clr"></div>
      <div class="header_img"><img src="images/main_img.png" alt="" width="298" height="233" />
        <h2>The <span>best</span> Murder Mystery Productions! </h2>
        <p>The most fun you can <i>legally</i> have with your pants on!</p>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">

          <h2><span>Register</span> </h2>
          <div class="clr"></div>
          <p>Welcome to the Murder Mystery Party registration page.  You've probably found your way here through an invite provided by one of our organizers.
          when you register you will be asked to supply an invite code which should have been supplied to you by the organizer who invited you.  If they failed
          to provide you with a valid Invite Code you won't be able to register.  If you have any questions or concerns please contact <a href="mailto:dericpr@gmail.com">Deric</a></p>
          <div class="clr"></div>
          <div id="mailSent"></div>
          <div id="errorConsole" style="color:red;"></div>
          <div id="Console" style="color:blue;"></div>
          <form class="cmxform" id="signupForm" name="signupForm" method="post" action="register.php">
	<fieldset>
		<p>
			<label for="firstname">First Name</label><br/>
			<input id="f_name" name="f_name" />
		</p>
		<p>
			<label for="lastname">Last name</label><br/>
			<input id="l_name" name="l_name" />
		</p>
                <p>
			<label for="email">Email</label><br/>
			<input id="email" name="email" />
		</p>
                <p>
                    <label for="gender">Gender</label><br/>
                    <input type="radio" value=0 id="gender" name="gender" />Male<br />
                    <input type="radio" value=1 id="gender" name="gender" />Female<br />
                    <input type="radio" value=2 id="gender" name="gender" />Not Important<br />
                </p>
		<p>
			<label for="password">Password</label><br/>
			<input id="password" name="password" type="password" />
		</p>

		<p>
			<label for="confirm_password">Confirm password</label><br/>
			<input id="confirm_password" name="confirm_password" type="password" />
		</p>
		<p>
			<label for="code">Invite Code</label><br/>
			<input id="invite_code" name="invite_code" />
		</p>

                 <p>
                    <label for="gender">Guest</label>
                    <input type="checkbox" id="guest" name="guest" /><br />
                    <div id="guest_details"></div>
                </p>
		<p>
                    <input type="submit" value="Register"/>
                </p>
        </fieldset>
          </form>
         
        </div>
       
      </div>
      <div class="sidebar">
        <div class="search">

<?php
        if (!$_SESSION['f_name']) {
        echo "
         <div id='errorConsole'></div>
                <table>
                <form method='post' name='loginForm' action='index.php'>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input type='text' name='email'/><br />
                        </td>
                        <td>
                            <div id='errorUser'></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                    <td>
                        <input type='password' name='password'/><br />
                    </td>
                    <td>
                        <div id='errorPass'></div>
                    </td>
                    </tr>
                     <tr>
                         <td>
                            <input type='submit' value='Login'/>
                         </td>
                     <tr>
                </form>
                </table>";
        } else {
            echo "Logged in!";
        }
        ?>
        </div>

             <!--
        <div class="gadget">
         
          <h2>Sidebar Menu</h2>

          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">TemplateInfo</a></li>
            <li><a href="#">Style Demo</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Archives</a></li>

          </ul>
            
        </div>
             -->
        <div class="gadget">
          <h2><span>Sponsors</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu">
            <li><a href="http://www.awesomeottawa.com/" target="_blank">Awesome Ottawa</a></li>
          </ul>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
    
      <div class="col c1">

        <h2><span>Image Gallery</span></h2>
        <a href="#"><img src="images/gallery_1.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/gallery_2.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/gallery_3.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/gallery_4.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/gallery_5.jpg" width="58" height="58" alt="" /></a> <a href="#"><img src="images/gallery_6.jpg" width="58" height="58" alt="" /></a> </div>
      <div class="col c2">
        <h2><span>Not sure what we'll put here</span></h2>
        <p>something witty I imagine<br />

          Yup ... witty.</p>
      </div>
    
      <div class="col c3">
        <h2><span>Contact</span></h2>
        <p>Really?  Well email, <a href="mailto:dericpr@gmail.com">Deric</a> Usually works.  You are probably already having a beer with Jack, so you won't need to contact him."</p>

      </div>
      <div class="clr"></div>
    </div>
    <div class="footer">
      <p class="lf">&copy; Copyright <a href="http://www.octapex.com">JackAttack!</a>.</p>
      <p class="rf">Layout by Free <a href="http://www.freewebsitetemplatez.com/">Website Templates</a></p>
     

      <div class="clr"></div>
    </div>
  </div>
</div>

    </body>
</html>
