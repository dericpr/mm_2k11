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
        $('#error\\S*').hide();
         $("#signupForm").submit(function() {
                $.post("doRegister.php", {email: $("#email").val(),
                                          password: $('#password').val(),
                                          gender: $("input[name='gender']:checked").val(),
                                          f_name: $('#f_name').val(),
                                          l_name: $('#l_name').val()},
                function(data) {

                    if ( data.mail_sent)
                        {
                            $("#mailSent").html("mailSent").fadeIn();
                        }
                    if (!data.registered)
                    {
                        $("#errorConsole").html(data.message).fadeIn();
                    }
                    else
                    {
                        $("#errorConsole").html(data.message).fadeIn();
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
			f_name: "Please enter your firstname",
			l_name: "Please enter your lastname",
			
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
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
          <p></p>
          <div class="clr"></div>
          <div id="mailSent"></div>
          <div id="errorConsole"></div>
          <form class="cmxform" id="signupForm" name="signupForm" method="post" action="register.php">
	<fieldset>
		<p>
			<label for="firstname">Firstname</label><br/>
			<input id="f_name" name="f_name" />
		</p>
		<p>
			<label for="lastname">Lastname</label><br/>
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
