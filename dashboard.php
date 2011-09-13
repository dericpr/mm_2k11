<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
error_reporting(0);
include_once "shared/ez_sql_core.php";
include_once "ez_sql.php";
$db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');
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
        <title>Murder Mystery Party - 2011</title>
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

                $.post("login.php", {email: $('[name=email]').val(),
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
<?php echo file_get_contents("header.html", true); ?>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">

            <h2><span>Date</span> Set</h2>
          <div class="clr"></div>
          <p>Posted on 12. Sep, 2011 by Deric </p>
          <div class="clr"></div>
          <p>On Saturday, October 15th - just in time for Hallowe'en - join over fifty of your closest friends at Ottawa's biggest and only free-form Murder Mystery Party.  There will be prizes, music and dancing, and, oh yeah, a murder!
          </p>
          <p>
          The concept is simple.  Everyone gets a character with clues, and the party begins the moment you arrive.  It's not like the "out of the box" parties you may have attended in the past.  There is no scripting, and no actors.  Everyone plays in their own way.  You simply mingle with other guests to try and discover what they know, and at the end of the evening, guests vote on who they think figured the whole thing out.  The winner receives a prize.  There are also prizes for best costume, best character and more.
          </p>
          <p>
          This is the fifth time we've planned a party like this, using our unique free-form system.  This year, our theme is dead historical figures, and for the first time, you get to pick your own character.  Thanks to the support of the <a href="http://www.awesomeottawa.com/" target="_blank">Awesome Ottawa</a> foundation, this year's party will be bigger and better than ever.  We're renting a space at the SAW gallery to accommodate more guests, and adding tons of new features and prizes.  There will be food available free of charge to guests.  Unfortunately, the terms of our liquor license prohibit us from telling you whether alcoholic beverages will be available for sale.
          </p>
          <p>
          To help off-set the costs, we are charging guests $10.00 for tickets.  Your ticket secures your space and gets you in the door.  Custom characters are written for each guest, so it's important we know who is coming in advance.  The party is completely non-profit though - any money raised will be used to cover the costs of the party.  Additional money left over will be donated to the Ottawa Food Bank, to help those less fortunate.  Help is particularly needed around Thanksgiving, and we want to do our part and have a great time in the process.
          </p>
          <p>
   
   
     <h3>LOCATION:  SAW Gallery, 67 Nicholas Street</h3>
     <h3>TIME:  8 PM - 2 AM</h3>
     <h3>TICKETS:  $10.00 </h3>
        
          <br>
   
        </p>
        <p>
        The Murder Mystery Party Organizing Committee
        </p>
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
        <!--<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        -->
        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">

        </form>


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
            echo "Logged in : ". $_SESSION['email'];
        }
        ?>
        </div>
        <div class="gadget">
          <h2>Sidebar Menu</h2>

          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="character.php">Character Info</a></li>
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
