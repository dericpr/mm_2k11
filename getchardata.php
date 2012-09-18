<?php 
/**********************************************************************
 *  ezSQL initialisation for mySQL
 */
session_start();
include_once "db.php";
// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host


$sql = sprintf("select char_id, fname,lname,sex, CS.location as sheet, CAT.name as category, ERA.name as era, U.paid as paid FROM charlist CR INNER JOIN category CAT ON CR.category = CAT.id INNER JOIN era ERA ON CR.era = ERA.id INNER JOIN user U on U.user_id = assigned_to LEFT OUTER JOIN charsheets CS on CS.id = CR.charsheet  where assigned_to = %d", $_SESSION['id']);

$configlist = $db->get_results($sql);
$data=array();
$data['sql'] = $sql;
if ($configlist ) {
	$data['res'] = 1;
}
foreach ( $configlist as $config ) {
	if ( $config->sheet ) {
		$data['content'] = "Please download your character sheet prior to the party to familiarize yourself with what your character knowns!<br>";
		$data['content'] .= "Character Info Sheet : <a href='sheets/".$config->sheet."'>Download</a>";
	} else {
		$data['content'] = "<p style='color:#ff0000'>There is no character info sheet for your character yet, please contact <a href='mailto:dericpr@mysteryparty.net'>Deric</a> and let him know!</p>";
	}
	$data['content'] .= "<table><th>Name<th>Category<th>Era<th>Sex<th>Paid<tr><td>". $config->fname. " ". $config->lname;
	$data['content'] .= "<td>". $config->category;
	$data['content'] .= "<td>". $config->era;
	if ($config->sex == 'M') {
		$sex = "Male";
	} else {
		$sex = "Female";
	}
	if ( $config->paid == 1) {
		$paid = "Paid";
	} else {
		$paid = "Not Paid";
	}
	$data['content'] .= "<td>".$sex;
	$data['content'] .= "<td>".$paid;
	$data['content'] .= "</tr></table>";
	$data['content'] .= "<br>";
	$data['charid'] .= $config->char_id;

}
echo json_encode($data);
?>
