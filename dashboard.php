<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
error_reporting(0);
include_once "db.php";
session_start();
if ( $_SESSION['level'] <= 0 )
    echo header('location: index.php');
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
		<style>
		.charinfo {background-color:#D2E4D2;}
		</style>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
         <script>
		 function updateMain()
		 {
			 $('#main_article').hide();
			 $('#main_article').html("");
			 $('#main_article').addClass("charinfo");
			 $('#main_article').html("<h2>Character Info</h2><a href='#' onclick='hidecharinfo()'>(-) Hide</a><br><br>This is your Character info based on the character you have selected.  If you wish to change your character you're going to have to contact <a href='mailto:greg@mysteryparty.net'>Greg</a> or <a href='mailto:dericpr@mysteryparty.net'>Deric</a> and ask them to make a change.  Since each character is written specifically for the player who has selected them we can't just re-assign a character without some consideration.  Thanks<br><br>");
			 $.post('getchardata.php', function(data) {
				 if ( data.res == 1 ) {
					 $('#main_article').append(data.content).fadeIn('slow');
			 	}
			 }, "json");
		 }

		 function hidecharinfo()
		 {
			 $('#main_article').fadeOut('slow');
		 }

        $(document).ready(function() {
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
          <div class="clr"></div>
		<div id='main_article_area'>
		</div>
		</div>
		<div class="article">
			<div id='entry'>
            <h2><span>New Party Planning has begun!</span></h2>
          <div class="clr"></div>
          <p>Posted on 20. Aug, 2012 by Deric </p>
          <div class="clr"></div>
		  <p>
			The Party production team from 2011 is ramping up the planning for the newest party.  If you attended last year, you know how much fun this event can be, if you haven't 
			yet had the chance to experience Ottawa's biggest Murder Mystery party, you'll want to score an invite this year.
		</p>
		<p>
			Details are still in the works, so stay tuned for more information.  If you were an attendee last year, you will be automatically invited for this years party.  Space 
			will be limited, so make sure you sign up as soon as possible once registration opens.
			</p>
			</div> <!-- / entry -->
		</div> <!-- / article -->

      </div> <!-- / main_article_area> -->
      <div class="sidebar">
	  <?php  
	  if ($_SESSION['paid'] == 0 )
	  {
	
        echo "<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>";
        echo "<input type='hidden' name='cmd' value='_xclick'>";
       echo " <input type='hidden' name='business' value='F8A598Y3CMSEC'>";
        echo "<input type='hidden' name='lc' value='CA'>";
       echo " <input type='hidden' name='item_name' value='Murdery Mystery Payment - 2012'>";
       echo " <input type='hidden' name='item_number' value='10042'>";
       echo " <input type='hidden' name='amount' value='10.00'>";
        echo "<input type='hidden' name='currency_code' value='CAD'>";
        echo "<input type='hidden' name='button_subtype' value='services'>";
        echo "<input type='hidden' name='tax_rate' value='0.000'>";
        echo "<input type='hidden' name='shipping' value='0.00'>";
        echo "<input type='hidden' name='return' value='http://mysteryparty.net/paid.php'>";
       echo " <input type='hidden' name='rm' value='2'>";
       echo " <input type='hidden' name='cancel_return' value='http://mysteryparty.net/cancel.php'>";
       echo " <input type='hidden' name='invoice' value='".  $_SESSION['id']."'>";
       echo " <input type='hidden' name='bn' value='PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted'>";
        
        echo "<input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>";
        echo "<img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>";
        
        echo "</form>";
	}
	?>
<div class = 'gadget'>
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
        }
        ?>
		</div>
        <div class="gadget">
          <h2>Game Menu</h2>

          <div class="clr"></div>
            <?php echo "<h3 style='color:DodgerBlue'>Active User : ". $_SESSION['f_name']. "</h3>";
			if ($_GET['cs'] == 1 )
			{
				echo "<h3 style='color:red'>Character Selected</h3>";
			}
			?>

<ul class="sb_menu">
            <li><a href="dashboard.php">Home</a></li>
<!--            <li><a style='color: #ff0000;' href="charinfo.php">!! Character Info - Important !!</a></li> -->
			<?php if ( $_SESSION['char_sel'] == 1 ) { 
 				echo "<li><a style='color:#ff0000;' href='charinfo.php'>Character Info</a></li>";
			} else {
				echo "<li><a href='character.php'>Select your character</a></li>";
			}
			?>
			<li><a href="http://www.jacksworks.com/?page_id=362" target="_blank">Previous Party Pics</a>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
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
