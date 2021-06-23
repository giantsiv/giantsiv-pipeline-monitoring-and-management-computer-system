<?php

function publishnewsettings($stationid){
	
	include('connect.php');
	$stmt = $connect->prepare("SELECT * FROM stationsettings WHERE stationid=:id");
	$stmt->execute(array('id' => $stationid ));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	include('mosquittocreds.php');	
	if ($mqtt->connect(true, NULL, $username, $password)) {
		echo $mqtt->publish('settings/station'.$stationid, $data['temperaturehigh'].':'.$data['temperaturelow'].':'.$data['pressurehigh'].':'.$data['pressurelow'].':'.$data['flowhigh'].':'.$data['flowlow'].':'.$data['sendmeasurementsperiods'].':', 0, true);
		$mqtt->close();
	} else {
	    echo "Time out!\n";
	}
	return;
}


function publishperiodsonly($stationid){
	require_once('mosquittocreds.php');	
	include('connect.php');
	$stmt = $connect->prepare("SELECT sendmeasurementsperiods FROM stationsettings WHERE stationid=:id");
	$stmt->execute(array('id' => $stationid ));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($mqtt->connect(true, NULL, $username, $password)) {
		echo $mqtt->publish('settings/station'.$stationid, ':'.$data['sendmeasurementsperiods'].':', 0, true);
		$mqtt->close();
	} else {
	    echo "Time out!\n";
	}
	return;
}
?>