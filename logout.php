<?php
session_start();
session_unset();
session_destroy();
$_SESSION=array();
header('location: http://mysteryparty.net/index.php');
?>
