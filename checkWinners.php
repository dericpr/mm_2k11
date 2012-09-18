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
		 <h2>Best Costume</h2>
		 <table>
		 <th>Character<th>Votes
		 <?php
			$sql = "SELECT V.bestCostume, CH.fname,CH.lname, COUNT(*) as tally FROM `vote` V INNER JOIN charlist CH ON CH.char_id = V.bestCostume GROUP BY bestCostume order by tally desc;";
			$charlist = $db->get_results($sql);
			foreach ($charlist as $char)
			{
				echo "<tr><td>".$char->fname. " ". $char->lname."</td><td>".$char->tally."</td>\n";
			}
		 ?>
		 </table>
         <h2>Best Character</h2>
		 <table>
		 <th>Character<th>Votes
		 <?php
			$sql = "SELECT V.bestCharacter, CH.fname,CH.lname, COUNT(*) as tally FROM `vote` V INNER JOIN charlist CH ON CH.char_id = V.bestCharacter GROUP BY bestCharacter order by tally desc;";
			$charlist = $db->get_results($sql);
			foreach ($charlist as $char)
			{
				echo "<tr><td>".$char->fname. " ". $char->lname."</td><td>".$char->tally."</td>\n";
			}
		 ?>
		 </table>

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
