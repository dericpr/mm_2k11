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
         <script>
        $(document).ready(function() {
            $('#error\\S*').hide();
            $('form[name=registerForm]').submit(function() {
              //  $('#errorConsole').slideUp();
               // $('#errorUser').fadeOut();
               // $('#errorPass').fadeOut();

                $.post("doRegister.php", {email: $('[name=email]').val(),
                                     f_name: $('[name=f_name]').val(),
                                     l_name: $('[name=l_name]').val(),
                                     gender: $('[name=gender]').val(),
                                     password: $('[name=password]').val()},
                function(data) {
                    if(data.success)
                    {
                        alert("Login");
                        location.href=data.redirect;
                    }
                    else
                    {
                        $("#errorConsole").html(data.message).fadeIn();
                        if (data.user)
                        {
                            $('#errorUser').html("Valid");

                        }
                        else
                        {
                            $('#errorUser').html("<img src='images/action_delete.png'></img>").fadeIn();
                        }
                    }

                }, 'json');


                return false;
            });
        });
        </script>
         <script type="text/javascript" src="javascript_core.js"></script>
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
          <p class="doForm">
              Here's your chance, register now for the greatest party ever.
              <table>
                <form method='post' name='registerForm' action='index.php'>
                    <tr>
                        <td class="doForm">
                            First Name
                        </td>
                        <td>
                            <input type='text' name='f_name' size="48"/><br />
                        </td>
                        <td>
                            <div id='errorUser'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="doForm">
                            Last Name
                        </td>
                        <td>
                            <input type='text' name='l_name' size="48"/><br />
                        </td>
                        <td>
                            <div id='errorUser'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="doForm">
                            Email
                        </td>
                        <td>
                            <input type='text' name='email' size="48"/><br />
                        </td>
                        <td>
                            <div id='errorUser'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="doForm">
                            Gender
                        </td>
                        <td class="doForm">
                            <input type='radio' name='gender' val="1" >Female<br />
                            <input type='radio' name='gender' val="0" >Male<br />
                            <input type='radio' name='gender' val="2" >N/A<br />
                        </td>
                        <td>
                            <div id='errorUser'></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="doForm">
                            Password
                        </td>
                    <td>
                        <input type='password' name='password' size="48"/><br />
                    </td>
                    <td>
                        <div id='errorPass'></div>
                    </td>
                    </tr>
                     <tr>
                         <td>
                            <input type='submit' value='Register'/>
                         </td>
                     <tr>
                </form>
                </table>
          </p>
         
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
            <li><a href="http://www.awesomeottawa.com/" target="_blank">Awesome Ottawa</a><br />
              Over 6,000+ Premium Web Templates</li>
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
