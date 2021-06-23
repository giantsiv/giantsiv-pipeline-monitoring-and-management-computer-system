<?php
$level = 2;
include('checksession.php');
if (isset($_GET['untechnicianid'])){
	include('connect.php');
	$id = filter_var($_GET['untechnicianid'], FILTER_SANITIZE_NUMBER_INT);
	$postid = filter_var($_GET['assignmentid'], FILTER_SANITIZE_NUMBER_INT);
	try {
		$stmt = $connect->prepare("DELETE FROM assignedtechnicians WHERE technicianid = :id AND stationid = :stationid");
		$stmt->execute(array('id' => $id, 'stationid' => $postid));
	} catch (Exception $e) {
    	echo $_SESSION['error'] = $e;
	}
	if (!isset($e)){
		echo $_SESSION['error'] = "Επιτυχία στην ανάκληση ανάθεσης!";
	}
	header('Location: manageusers.php'); 
}
elseif (isset($_GET['unsupervisorid'])){
	include('connect.php');
	$id = filter_var($_GET['unsupervisorid'], FILTER_SANITIZE_NUMBER_INT);
	try {
		$stmt = $connect->prepare("DELETE FROM assignedsupervisors WHERE supervisorid = :id"); 
		$stmt->execute(array('id' => $id));
	} catch (Exception $e) {
    	$_SESSION['error'] = $e;
	}
	if (!isset($e)){
		$_SESSION['error'] = "Επιτυχία στην ανάκληση ανάθεσης!";
	}
	header('Location: manageusers.php'); 
}
else{
	$_SESSION['error'] = "Κάτι πήγε λάθος!";
	header('Location: manageusers.php'); 
}