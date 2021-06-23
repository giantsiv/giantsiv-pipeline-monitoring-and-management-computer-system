<?php
$level = 1;
include('checksession.php');
if (isset($_GET['pref'])){
	include('connect.php');
	$newpref = $_GET['pref'];
	$userid = $_SESSION['user_id'];
	$stmt = $connect->prepare('UPDATE users SET notifpref=:newpref WHERE userid = :userid');
    $stmt->execute(array('newpref' => $newpref, 'userid' => $userid));
    header('Location: accountpref.php');
    die();
}
?>