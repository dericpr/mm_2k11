<?php
error_reporting(0);
session_start();
include_once "shared/ez_sql_core.php";
include_once "ez_sql.php";
$db = new ezSQL_mysql('mm_user','yeradeadman232','mm_2k11','localhost');

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
