<?php //deactivate user from system FINISHED
$level = 2;
include ('checksession.php');
if (isset($_POST['deleteuserid'])){
	include('connect.php');
	$deleteuser = filter_var($_POST['deleteuserid'], FILTER_SANITIZE_NUMBER_INT);
	$userdata = [
		'userid' => $deleteuser
	];
	$stmt = $connect->prepare("UPDATE users SET activeaccount=0 WHERE userid=:userid");
	$stmt->execute($userdata);
}
else
{
	header('Location : menu.php');
	die();
}
?>