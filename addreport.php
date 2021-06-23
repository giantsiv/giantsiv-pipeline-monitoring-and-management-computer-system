<?php
$level = 1;
include('checksession.php');
if(isset($_POST['comments']) && $_SESSION['user_type'] == 1 && $_SESSION['stationid'] != ''){  //only a technician has the ability to add reports
	include('connect.php');
	$technicianid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$stationid = filter_var($_SESSION['stationid'], FILTER_SANITIZE_NUMBER_INT);
	$comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);
	$newreport = ['technicianid' => $technicianid,
		'stationid' => $stationid,
		'comments' => $comments
	];
	try {
		$stmt = $connect->prepare("INSERT INTO stationmaintenance (stationid, technicianid, comments) VALUES (:stationid, :technicianid, :comments)"); //insert new station to db 
		$stmt->execute($newreport);
	} catch (Exception $e) {
    	$_SESSION['error'] = $e;
	}
	if (!isset($e)){
		$_SESSION['error'] = "Succesfully added report";
	}
	header('Location: maintenancereport.php'); 
}
else{
	$_SESSION['error'] = "Something went wrong";
	header('Location: maintenancereport.php'); 
}