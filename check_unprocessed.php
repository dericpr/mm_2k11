<?php
error_reporting(0);
session_start();
include_once "db.php";

//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);
$pass=sha1($_POST['password']);
//now validating the username and password
$users = $db->get_row("SELECT count(*) as pending FROM user where access_level = 0");
if ( $users ) {
   $data['count'] = $users->pending;
    echo json_encode($data);
} else {
    $data['count'] = 0;
}

?>
