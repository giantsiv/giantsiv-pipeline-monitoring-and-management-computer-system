<?php
require('publishupdateflag.php');
require('publishnewsettings.php');

$level = 2;
include('checksession.php');
if (isset($_POST['stationchanges']) && isset($_POST['idtoupdate'])){
	include('connect.php');
	$id = filter_var($_POST['idtoupdate'], FILTER_SANITIZE_NUMBER_INT);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$ip = filter_var($_POST['ip'], FILTER_SANITIZE_STRING);
	$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
	$temphigh = $_POST['temphigh'];
	$templow = $_POST['templow'];
	$presshigh = $_POST['presshigh'];
	$presslow = $_POST['presslow'];
	$flowhigh = $_POST['flowhigh'];
	$flowlow = $_POST['flowlow'];
	$transmissiontime = $_POST['transmissiontime']*60/5;
	$updatestation = [
		'stationname' => $name,
		'telephone' => $telephone,
		'stationid' => $id
	];
	$updatesettings = [
		'temperaturehigh' => $temphigh,
		'temperaturelow' => $templow,
		'pressurehigh' => $presshigh,
		'pressurelow' => $presslow,
		'flowhigh' => $flowhigh,
		'flowlow' => $flowlow,
		'stationid' => $id,
		'transmissiontime' => $transmissiontime,
		'updatestate' => '0'
	];
	$stmt = $connect->prepare("UPDATE stations SET stationname=:stationname, stationtelephone=:telephone WHERE stationid = :stationid")or die();
    $stmt->execute($updatestation);

    $stmt2 = $connect->prepare("UPDATE stationsettings SET temperaturehigh=:temperaturehigh, temperaturelow=:temperaturelow, pressurehigh=:pressurehigh, pressurelow=:pressurelow, flowhigh=:flowhigh, flowlow=:flowlow, updatestate=:updatestate, sendmeasurementsperiods=:transmissiontime WHERE stationid = :stationid");
    $stmt2->execute($updatesettings);
    if($stmt && $stmt2){
    		$_SESSION['update'] = 'Επιτυχία στην αποθήκευση!';
    		publishupdateflag($id);
    		publishnewsettings($id); 
	}
	else{
			$_SESSION['update'] = 'Αποτυχία στην αποθήκευση!'; 
	}
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>