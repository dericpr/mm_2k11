<?php
error_reporting(0);
session_start();
include_once "db.php";
$db->hide_errors();
if ($_SESSION['level'] < 9 )
{
    print"<script>location.href='index.php'</script>";
}
$sql = "select * from error";
$users = $db->get_results($sql);

print ("SQL : $sql<BR>\n");
if ( $users ) {
    print "<table border=1>";
    print ("<th>ID<th>Error<th>Date");
   foreach ( $users as $user )
    {
       $datetime = date('l jS \of F Y h:i:s A',$user->date);
       print("<tr><td>". $user->id);
       print ("<td>".base64_decode($user->error));
       print ("<td>".$datetime);
    }
    print("</table>");
} else {
    print("NO errors in table\n");
   
}


?>
