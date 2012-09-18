<?php 
/**********************************************************************
 *  ezSQL initialisation for mySQL
 */

include_once "db.php";
// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host

$sql = "SELECT *, C.fname as charfname, C.lname as charlname FROM user U LEFT OUTER JOIN charlist as C ON C.assigned_to = U.user_id  order by paid desc";
$configlist = $db->get_results($sql);
$data=array();
foreach ( $configlist as $config ) {
	($config->assigned_to > 0 ? $assigned=1 : $assigned = 0);
	$data[] = array("id"=>$config->user_id,"name"=>$config->f_name. " ". $config->l_name, "paid"=>$config->paid, "character"=>$config->charfname. " ". $config->charlname, "email"=>$config->email, "charsel"=>$config->character_selected, "fname"=>$config->f_name, "lname"=>$config->l_name );

}
echo json_encode($data);
?>
