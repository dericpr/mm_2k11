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
        <LINK href="bootstrap-1.1.0.css" rel="stylesheet" type="text/css">
        <title>Murder Mystery Party - 2012</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/arial.js"></script>
        <script type="text/javascript" src="js/cuf_run.js"></script>
         <script>
        $(document).ready(function() {
            // script shit here if need be
         getList(); 
	});
		function getList() {
			var table = $("#reg_user_body");
			table.html("");
			var count = 0;
			$.post('getregistered.php',function(data) {
				$.each(data, function(i,rev){
					count++;
	    		 	table.append("<tr id='"+rev.id+"'></tr>");
					var tr = $('tr:last', table);
					var paid_status;
					if ( rev.paid == 0 ) {
						paid_status = "No";
					} else {
						paid_status = "Yes";
					}
					tr.append("<td>"+count+"<td>"+rev.name+"<td onClick=\"setActive("+rev.id+",'"+rev.fname+"','"+rev.lname+"','"+rev.email+"',"+rev.charsel+","+rev.paid+")\">"+rev.email+"<td onClick='setPaid("+rev.paid+","+rev.id+")'>"+paid_status+"<td>"+rev.character);
				});
			}, "json");
			table.fadeIn();
		}

		function setPaid(curPaid, id) {
			$.post("mark_paid.php", {"curPaid":curPaid,"id":id}, function(data) {
				if ( data.res == 1)
				{
					// redraw table
					getList();
				}
				else 
				{
					$('#error').html("Unable to set paid status for user " + id);
				}
			}, 'json');

		}

		function setActive(id,fname,lname,email,charsel,paid)
		{
			$.post("set_session.php", {"f_name":fname,"l_name":lname,"email":email,"id":id,"char_sel":charsel,"paid":paid},function(data) {
			}, 'json');
		}

        </script>
         <script type="text/javascript" src="javascript_core.js"></script>
    </head>

    <body>
       <div class="admin_main">
  <div class="header">

    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html">ADMIN CON<span>S</span>ole</a><small> What you do here can hurt everyone!</small></h1>
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
      <div class="header_img">
        <h2>Your an administrator... </h2>
        <p>Remember that the changes you make here will be reflected in the game. Be Careful and have fun!</p>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
		        <div class="clr"></div>
		<p>Here is a list of all the confirmed users and their basic stats ( paid, character selected )

		Just for you Jack!</p>
     
	 	<div id='error'>Session Variables :
		<?php
		echo "ID : ".$_SESSION['id']."<br>";
		echo "Fname : ".$_SESSION['f_name']."<br>";
		echo "lName : ".$_SESSION['l_name']."<br>";
		echo "Email: ".$_SESSION['email']."<br>";
		echo "Charsel : ".$_SESSION['char_sel']."<br>";
		echo "Paid : ".$_SESSION['paid']."<br>";
		?>
		</div>

		</table>
	<table id='reg_user' border='1' class='common-table zebra-striped'>
	<thead>
	<tr>
		<th>#<th>Name<th>Email<th>Paid<TH>Character
	</tr>
	</thead>
	<tbody id='reg_user_body'>
	</tbody>
	</table>

	  <?php
/*
        $users = $db->get_results("SELECT *, C.fname as charfname, C.lname as charlname FROM user U LEFT OUTER JOIN charlist as C ON C.assigned_to = U.user_id  order by paid desc");
		echo "<table id = 'reg_user' border='1'>";
		echo "<th>#<th>Name<th>Email<th>Paid<TH>Character";
		$count = 0;
	foreach ( $users as $user )
        {
			$count++;
            // Access data using object syntax
			echo "<tr><td>".$count."<td>".$user->f_name. " ".$user->l_name;
            echo "<td>". $user->email;
			echo "<td id='paid' onClick='setPaid(".$user->paid.", ".$user->user_id.")'>";
			echo ($user->paid == 1) ? "Yes" : "No";
			echo "<td>";
			echo ($user->charfname. " ". $user->charlname);
        }
		echo "</table>"
		*/
?>


         
        </div>
      </div>
      <div class="sidebar">
        <div class="search">

         Yer Logged in
        </div>
        <div class="gadget">
          <h2>Sidebar Menu</h2>

          <div class="clr"></div>
          <ul class="sb_menu">
            <table border="0">
            <tr><td><li><a href="#">Users</a><td></li>
            <tr><td><li><a href="dashboard.php">DASHBOARD</a></li>
            <tr><td><li><a href="checkWinners.php">Voting Results!</a></li>
           <tr><td> <li><a href="#">Blog</a></li>
           <tr><td> <li><a href="#">Archives</a></li>
           <tr><td>Unprocessed <li class="process">&nbsp &nbsp</h3></li>
            </table>
          </ul>
        </div>
        <div class="gadget">
          <h2><span>Sponsors</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu">
            <li><a href="http://www.awesomeottawa.com/" target="_blank">Awesome Ottawa</a><br />
              Serving Ottawa with Awesome!</li>
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
        <h2><span>Lorem Ipsum</span></h2>
        <p>Lorem ipsum dolor<br />

          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.</p>
      </div>
      <div class="col c3">
        <h2><span>Contact</span></h2>
        <p>Nullam quam lorem, tristique non vestibulum nec, consectetur in risus. Aliquam a quam vel leo gravida gravida eu porttitor dui. Nulla pharetra, mauris vitae interdum dignissim, justo nunc suscipit ipsum. <a href="#">mail@example.com</a><br />
          <a href="#">+1 (123) 444-5677</a></p>

      </div>
      <div class="clr"></div>
    </div>
    <div class="footer">
      <p class="lf">&copy; Copyright <a href="#">MyWebSite</a>.</p>
      <p class="rf">Layout by Free <a href="http://www.freewebsitetemplatez.com/">Website Templates</a></p>
      <div class="clr"></div>
    </div>
  </div>
</div>

    </body>
</html>
