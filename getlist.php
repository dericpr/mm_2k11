<?php 
/**********************************************************************
 *  ezSQL initialisation for mySQL
 */

include_once "db.php";
// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host


if ( $_POST['query'] )
{
	$sql = sprintf("select char_id, fname,lname,sex,assigned_to, CAT.name as category, ERA.name as era FROM charlist CR INNER JOIN category CAT ON CR.category = CAT.id INNER JOIN era ERA ON CR.era = ERA.id where (fname like '%%%s%%' or lname like '%%%s%%')  ", $_POST['query'], $_POST['query']);
}
else
{
	$sql = sprintf("select char_id, fname,lname,sex, assigned_to, CAT.name as category, ERA.name as era FROM charlist CR INNER JOIN category CAT ON CR.category = CAT.id INNER JOIN era ERA ON CR.era = ERA.id  ORDER BY fname ASC");
}
$configlist = $db->get_results($sql);
$data=array();
foreach ( $configlist as $config ) {
	($config->assigned_to > 0 ? $assigned=1 : $assigned = 0);
	$data[] = array("id"=>$config->char_id,"name"=>$config->fname. " ". $config->lname, "category"=>$config->category, "era"=>$config->era, "assigned"=>$assigned, "gender"=>$config->sex );

}
echo json_encode($data);
?>
