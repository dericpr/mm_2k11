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
            
			$(function() {
				$("[name=password]").focus();
			});

			$('#error\\S*').hide();
            $('form[name=loginForm]').submit(function() {
                $('#errorConsole').slideUp();
                $('#errorUser').fadeOut();
                $('#errorPass').fadeOut();

                $.post("login.php", {email: $('[name=email]').val(),
                                     password: $('[name=password]').val()},
                function(data) {
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

            <h2><span>Registration</span> Successful</h2>
            <div class="clr"></div>
        	<p>
			Congratulations, you have successfully registered for the Murder Mystery Party.  Please check your email shortly for a confirmation message.  We will contact you when it is time to
			select your character and confirm your attendance.
			</p>
			<p>
			Please login to the site to confirm your account credentials and check for any updates
			</p>
	     <table>
                <form method='post' name='loginForm' action='index.php'>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input type='text' name='email' value ="<?php echo $_GET['email'] ?>"/><br />
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
                </table>
		</div>
          <!--
        <div class="article">
          <h2><span>Aliquam Risus</span> Justo</h2>
          <div class="clr"></div>

          <p>Posted on 18. Sep, 2015 by Sara in Filed under templates, internet, with Comments 18</p>
          <img src="images/img_2.jpg" width="613" height="193" alt="" />
          <div class="clr"></div>
          <p>Pellentesque posuere enim et ipsum dignissim convallis. Proin quis molestie mauris. Nunc eget quam at nulla tempus tincidunt quis a mi. Aliquam ornare turpis non tellus molestie imperdiet. Phasellus sit amet neque vitae purus venenatis hendrerit. Phasellus non mi ipsum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse potenti. Aenean vel varius sapien. Etiam leo quam, sodales vel ullamcorper ut, viverra a risus.</p>
          <p>Maecenas dignissim mauris in arcu congue tincidunt. Vestibulum elit nunc, accumsan vitae faucibus vel, scelerisque a quam. Aenean at metus id elit bibendum faucibus. Curabitur ultrices ante nec neque consectetur a aliquet libero lobortis. Ut nibh sem, pellentesque in dictum eu, convallis blandit erat. Cras vehicula tellus nec purus sagittis id scelerisque risus congue. Quisque sed semper massa. Donec id lacus mauris, vitae pretium risus. Fusce sed tempor erat. </p>
          <p><a href="#">Read more </a></p>
        </div>
          

        <div class="article" style="padding:5px 20px 2px 20px;">
          <p>Page 1 of 2 <span class="butons"><a href="#">3</a><a href="#">2</a> <a href="#" class="active">1</a></span></p>
        </div>
          -->
      </div>
        <!--
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GNFZNR3ZJ88B6">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
-->
      <div class="sidebar">
         <!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">-->
         <!--
         <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="F8A598Y3CMSEC">
        <input type="hidden" name="lc" value="CA">
        <input type="hidden" name="item_name" value="Murdery Mystery Payment">
        <input type="hidden" name="item_number" value="10042">
        <input type="hidden" name="amount" value="10.00">
        <input type="hidden" name="currency_code" value="CAD">
        <input type="hidden" name="button_subtype" value="services">
        <input type="hidden" name="tax_rate" value="0.000">
        <input type="hidden" name="shipping" value="0.00">
        <input type="hidden" name="return" value="http://mysteryparty.net/paid.php">
        <input type="hidden" name="rm" value="2">
        <input type="hidden" name="cancel_return" value="http://mysteryparty.net/cancel.php">
        <input type="hidden" name="invoice" value="<?php echo $_SESSION['id'];?>">
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
         -->
        <!--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        
        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

        </form>
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
