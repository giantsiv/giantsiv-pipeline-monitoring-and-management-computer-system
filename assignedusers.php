<?php 
$level = 2;
include('checksession.php');
if(isset($_GET['technicianid']) && $_GET['stationtoassign']){
	include('connect.php');
	$technicianid = filter_var($_GET['technicianid'], FILTER_SANITIZE_NUMBER_INT);
	$stationid = filter_var($_GET['stationtoassign'], FILTER_SANITIZE_NUMBER_INT);
	$newassignment = [
	'technicianid' => $technicianid,
	'stationid' => $stationid
	];
	try {
		$stmt = $connect->prepare("INSERT INTO assignedtechnicians (technicianid, stationid) VALUES (:technicianid, :stationid)"); //insert new station to db 
		$stmt->execute($newassignment);
	} catch (Exception $e) {
    	$_SESSION['error'] = $e;
	}
	if (!isset($e)){
		$_SESSION['error'] = "Επιτυχής Ανάθεση!";
	}
	header('Location: manageusers.php'); 
	die();
}
elseif(isset($_GET['supervisorid']) && $_GET['regiontoassign']){
	include('connect.php');
	$supervisorid = filter_var($_GET['supervisorid'], FILTER_SANITIZE_NUMBER_INT);
	$regionid = filter_var($_GET['regiontoassign'], FILTER_SANITIZE_NUMBER_INT);
	$newassignment = [
	'supervisorid' => $supervisorid,
	'regionid' => $regionid
	];
	try {
		$stmt = $connect->prepare("INSERT INTO assignedsupervisors (supervisorid, regionid) VALUES (:supervisorid, :regionid)"); //insert new station to db 
		$stmt->execute($newassignment);
	} catch (Exception $e) {
    	$_SESSION['error'] = $e;
	}
	if (!isset($e)){
		$_SESSION['error'] = "Επιτυχής Ανάθεση!";
	}
	header('Location: manageusers.php');  
	die();
}
else{
	$_SESSION['error'] = "Κάτι πήγε λάθος";
	header('Location: manageusers.php'); 
	die();
}

?>