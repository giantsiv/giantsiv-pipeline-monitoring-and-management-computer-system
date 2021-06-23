<?php
$level = 2;
include('checksession.php');
$accountid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
include('connect.php');
if (isset($_GET['enable'])){ // if enable 
	$stmt = $connect->prepare('UPDATE users SET `activeaccount` = 1 WHERE `userid`=:id');
	$stmt->execute(array(':id' => $accountid));
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	die();
}
elseif(isset($_GET['disable'])){ // disable
	$stmt = $connect->prepare('UPDATE users SET `activeaccount` = 0 WHERE `userid`=:id');
	$stmt->execute(array(':id' => $accountid));
	header("Location: " . $_SERVER["HTTP_REFERER"]);
	die();
}
else{

}
?>