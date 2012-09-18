
<?php 
/**********************************************************************
 *  ezSQL initialisation for mySQL
 */

// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
session_start();

$_SESSION['f_name'] = $_POST['f_name'];
$_SESSION['l_name'] = $_POST['l_name'];
$_SESSION['email'] =  $_POST['email'];
$_SESSION['id'] =  $_POST['id'];
$_SESSION['char_sel'] =  $_POST['char_sel'];
$_SESSION['paid'] =  $_POST['paid'];

$data['val'] = print_r($_SESSION,true);
echo json_encode($data);
?>

