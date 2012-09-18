<?php
session_start();
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

    <body>
	<div class="main">
<?php echo file_get_contents("header.html", true); ?>

  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <div class="clr"></div>
            <h2><span>Payment received</span></h2>
          <div class="clr"></div>
          <p>Posted on 20. Sep, 2011 by Deric </p>
          <div class="clr"></div>
<p>
Mysteryparty.net Payment received.  Your account will be updated once your payment has been confirmed.
<br>
Thank you.
<br>
Deric and the rest of your Mysteryparty.net  team

<hr>
debug info<br>
</hr>
<?php
echo "POST";
print_r($_POST);
echo "<BR>";
echo "GET";
print_r($_GET);
echo "<BR>";
?>

			</p>
			</div>
		</div>

<div class="sidebar">
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
			<?php if ( $_SESSION['char_sel'] == 1 ) { 
 				echo "<li><a href='#' onclick='updateMain()'>Character Info</a></li>";
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

