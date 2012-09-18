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
         <script type="text/javascript" src="javascript_core.js"></script>
         <script>
        $(document).ready(function() {
		});
		 function doVote() {
			bchar = $("#character").val();
			bcost = $("#costume").val();
			id = $("#voteID").val();
		 	$.post("doVote.php", {"voteID":id,"bestChar":bchar,"bestCost":bcost},function(data) {
				if ( data.res == 0 )
				{
					$('#errorConsole').html("<p style='color:red'>Vote note registered, please confirm your voteID is valid, if you feel this is a mistake, please find Deric ( Leonardo Da Vinci ) and he will give you a new code.</p>");
					$('#voteID').val('').focus();
		 		} else {
					$('#errorConsole').html("<p style='color:green'>Vote Registered!  Thanks.</p>");
				}
		 	}, "json");
		 }

        </script>

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
          <h2><span>VOTING BOOTH</span> </h2>
          <div class="clr"></div>
          <p></p>
          <div class="clr"></div>
         <p>
		 Here's your chance to reward your fellow guests with a vote for best costume and for the best personification of their character.  You only get one vote for each category, please select the name of the CHARACTER from each drop down box and then click the VOTE button.  Thanks
		 </p>
		 <table>
		 <tr><td><H2>Best Costume</h2></td><td><h2>Best Character</H2></td>
		 <?php
			$sql = "SELECT char_id,fname,lname FROM charlist where assigned_to > 0 order by fname ASC";
			$charlist = $db->get_results($sql);
			echo "<tr><td><select id = costume>\n";
			foreach ($charlist as $char)
			{
				echo "\t<option value='".$char->char_id."'>".$char->fname." ". $char->lname."</option>\n";
			}
			echo "</select>\n";
			echo "<td><select id = character>\n";
			foreach ($charlist as $char)
			{
				echo "\t<option value='".$char->char_id."'>".$char->fname." ". $char->lname."</option>\n";
			}
			echo "</select>\n";
		 ?>
		 <tr><td>Please Enter your 3 digit vote id<br> <input type='text' id='voteID' /></td><td>
		 <div id='errorConsole'></div></td>
		 </table>
		 <input type='button' id='vote' onClick='doVote()'value='VOTE'></input>
        </div>
       
      </div>
      <div class="sidebar">
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
