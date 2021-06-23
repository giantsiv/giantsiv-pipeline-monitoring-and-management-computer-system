<?php //reactivate user  FINISHED
$level = 2;
include ('checksession.php');
if (isset($_POST['activateuserid'])){
	include('connect.php');
	$activateuser = filter_var($_POST['activateuserid'], FILTER_SANITIZE_NUMBER_INT);
	$userdata = [
		'userid' => $activateuser
	];
	$stmt = $connect->prepare("UPDATE users SET activeaccount=1 WHERE userid=:userid");
	$stmt->execute($userdata);
}
else
{
	header('Location : menu.php');
	die();
}
?>