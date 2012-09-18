<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
error_reporting(0);
include_once "db.php";
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
        <title>Murder Mystery Party - 2012</title>

        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
         <script>
        $(document).ready(function() {
            $('#error\\S*').hide();
            
            $('form[name=loginForm]').submit(function() {
                $('#errorConsole').slideUp();
                $('#errorUser').fadeOut();
                $('#errorPass').fadeOut();
                $('.pending').live('click', function() {
                  $('.article:first').load("pending.html");
                  return false;
                });
                $.post("login.php", {email: $('[name=email]').val(),
                                     password: $('[name=password]').val()},
                function(data) {
                    if (!data.registered)
                    {
                        $("#errorConsole").html(data.message).fadeIn();
                        
                    }
                    if(data.success)
                    {

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
 <?php echo file_get_contents("header.html", true); ?>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <h2><span>New Party - Details coming Soon!.</span> </h2>
          <div class="clr"></div>
          <p>Posted on 20. Aug, 2012 by Deric</p>
          <div class="clr"></div>
         <p>
		  The Party production team from 2011 is ramping up the planning for the newest party. If you attended last year, you know how much fun this event can be, if you haven't yet had the chance to experience Ottawa's biggest Murder Mystery party, you'll want to score an invite this year.

		  Details are still in the works, so stay tuned for more information. If you were an attendee last year, you will be automatically invited for this years party. Space will be limited, so make sure you sign up as soon as possible once registration opens. 
		 </p>
         
        </div>
       
      </div>
      <div class="sidebar">
        <div class="gadget">

          <div class="clr"></div>
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
            echo "<a href='dashboard.php'>Go to Dashboard</a>!";
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
              <?php echo file_get_contents("sponsers.html", true); ?>
          </ul>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <?php echo file_get_contents("footer.html", true); ?>
</div>

    </body>
</html>
