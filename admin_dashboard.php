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
            // script shit here if need be
            $.post("check_unprocessed.php",
           function(data) {
               if (data.count > 0 ) {
                $(".process").html("<button style='background-color:red; color:whitesmoke'>" + data.count +"</button>").fadeIn();
               }

           }, 'json');
        });
        </script>
         <script type="text/javascript" src="javascript_core.js"></script>
    </head>
<?php


?>

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
            <tr><td><li><a href="#">TemplateInfo</a></li>
            <tr><td><li><a href="#">Style Demo</a></li>
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
      <?php

        $users = $db->get_results("SELECT * FROM user");
	foreach ( $users as $user )
        {
            // Access data using object syntax
            echo "First Name : ". $user->f_name;
            echo "Last Name : ". $user->l_name;
            echo "Email : ". $user->email;
        }
?>

      <div class="clr"></div>
    </div>
  </div>
</div>

    </body>
</html>
