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
$curPaid = $_POST['curPaid'];
$userId = $_POST['id'];
if ( $_GET['curPaid'] || $_GET['id'] )
{
	$curPaid = $_GET['curPaid'];
	$userId = $_GET['id'];
}
//$data['stupid']= print_r($selectedArray, true);

//$sql = "INSERT INTO build_def (runtime_id, tag_id) VALUES ";
if ( !is_null($userId) )
{
	if ($curPaid == 0) 
	{
		$paid = 1;
	} else {
		$paid = 0;
	}
	$data['paid'] = $paid;
	$sql = "UPDATE user  SET paid  = $paid WHERE user_id = ". $userId;
	$data['sql'] = $sql;
	$db->query($sql);
	$sql = "Select paid from user where user_id = ". $userId;
	$paid_status = $db->get_row($sql);
	$data['paid_status'] = $paid_status->paid;
	if ( $paid_status->paid == $paid )
		$data['res'] = 1;
	else
		$data['res'] = 0;
}

//$db->query($sql);
echo json_encode($data);
?>
