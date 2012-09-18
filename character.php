 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
include_once "db.php";
session_start();
if ( $_SESSION['level'] <= 0 )
    echo header('location: dashboard.php');
if ( $_SESSION['char_sel'] != 0 && $_SESSION['level'] < 9 )
	echo header('location: dashboard.php?cs=1');
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
        <script type="text/javascript" src="jquery.tablesorter.min.js"></script>
         <script>
		 function getList(param) {
	 var table = $("#char_list");
	 table.html("");
	 $.post('getlist.php', {query: param}, function(data) {
		$.each(data, function(i,char){
	     	table.append("<tr class='addcharbtn' name='"+char.name+"' id='"+char.id+"'></tr>");
			var tr = $('tr:last', table);
			if ( char.assigned == 1 ) {
				tr.addClass("notavail");
				tr.removeClass("addcharbtn");
			}
			tr.append("<td>"+char.name+"</td>" +
					  "<td>"+char.gender+"</td>" +
					  "<td>"+char.category+" </td>" +
					  "<td>"+char.era+" </td>" );
//					  "<td> <button class='addcharbtn' name='"+char.name+"' id='"+char.id+"'>Take</button></td>");
		});
	}, "json");
	table.fadeIn();
		 }


        $(document).ready(function() {
            $('#error\\S*').hide();
			getList();
			var timer = null;
			//on keyup, start the countdown
			$('#myInput').keydown(function(){
				clearTimeout(timer);
				timer = setTimeout(doneTyping, 500);
			});

			//user is "finished typing," do something
			function doneTyping () {
				    //do something
					//$('#donetype').html("<br>You typed" + $('#myInput').val() + " So you rock!");
					getList($('#myInput').val());
			}
			$(".addcharbtn").live('click', function() {
			var charid = $(this).attr('id');
			var r = confirm("Are you Sure you want to Choose " + $(this).attr('name') );
			if ( r == true ) {
					$.post('assigncharacter.php', {"charid": charid }, function(data) {
					if ( data.res == 1 ) {
						window.location = "dashboard.php";	
					}

					}, "json");
				} else {
					alert("Whew, you dodged a bullet there, I mean really, who wants to play " + $(this).attr('name'));
				}
			});
        });
        </script>
         <script type="text/javascript" src="javascript_core.js"></script>
		<style>
		tr.notavail { background-color:#F78181;}
		</style>


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
				<p>
				Start typing a name in the search box, stop typing and it will search by first or last name and show all results that match.  Just click on the name you want, confirm your selection and you should have successfully selected your character.  Please contact Deric or Greg if you don't see the character you want listed.  If the Character is marked Red, it has already been selected by another player and you won't be able to register it again.  Thanks, and happy picking!</p>
		 		Search : <input type='text' id='myInput' name='myInput' />
				<div id='donetype' name='donetype'>
				</div>
				<table border='1' id='chars' class='common-table '>
				<thead>
				<tr>
				<th>Name<th>Gender<th>Category<th>Era
				</tr>
				</thead>
				<tbody id='char_list' name='char_list'>
				<tbody>
				</table>
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
            echo "<h3 style='color:DodgerBlue'>Active User : ". $_SESSION['f_name']. "</h3>";
        }
        ?>
        </div>
        <div class="gadget">
          <h2>Sidebar Menu</h2>

          <div class="clr"></div>
          <ul class="sb_menu">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="#">Character Info - Coming Soon</a></li>
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


