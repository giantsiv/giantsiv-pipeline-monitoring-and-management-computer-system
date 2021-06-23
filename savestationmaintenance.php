<?php //Save maintenance report to database
$level = 1;
include('checksession.php');
if (isset($_GET['stationid']) && isset($_POST['technicianid']) && isset($_POST['comments'])){
	$stationid = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT);
	$technicianid = filter_var($_POST['technicianid'], FILTER_SANITIZE_NUMBER_INT);
	$comments = filter_var($_POST['comments'], FILTER_SANITIZE_STRING);
	include('connect.php');
	$report = [
	'stationid' => $stationid,
	'technicianid' => $technicianid,
	'comments' => $comments
	];
	$stmt = $connect->prepare("INSERT INTO stationmaintenance (stationid, technicianid, comments) VALUES (:stationid, :technicianid, :comments) ");
	$stmt->execute($report);
} 
else{
	header('Location : menu.php');
	die();
}
?>