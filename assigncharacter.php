<?php 
/**********************************************************************
 *  ezSQL initialisation for mySQL
 */

include_once "db.php";
// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
session_start();


$data=array();
// delete all entries for this tag first
$charId = $_POST['charid'];
$userId = $_SESSION['id'];

//$data['stupid']= print_r($selectedArray, true);

//$sql = "INSERT INTO build_def (runtime_id, tag_id) VALUES ";
if ( !is_null($charId) )
{
	$sql = "UPDATE charlist SET assigned_to  = ". $userId. " WHERE char_id = ". $charId;
	$data['sql'] = $sql;
	$data['res'] = $db->query($sql);
	if ( $data['res'] == 1 )
	{
		$sql = "UPDATE user SET character_selected = 1 where user_id = ". $userId;
		$db->query($sql);
		$_SESSION['char_sel'] = 1;
	}
}

//$db->query($sql);
echo json_encode($data);
?>
