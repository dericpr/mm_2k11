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
$voteID = $_POST['voteID'];
$bestCostume = $_POST['bestCost'];
$bestCharacter = $_POST['bestChar'];

//check that voteID is valid and not used
$sql = "SELECT voteID,used from vote where voteID = $voteID";
$vote_res = $db->get_row($sql);
if ( $vote_res && $vote_res->used == 0 )
{
	$sql = "UPDATE vote SET bestCostume  = ". $bestCostume. ", bestCharacter = ".$bestCharacter. " , used = 1 WHERE voteID = ". $voteID;
	$data['sql'] = $sql;
	$data['res'] = $db->query($sql);

} else {
	$data['res'] = 0;
}
//$db->query($sql);
echo json_encode($data);
?>
