<?php
require('stationfailure.php');
//require('calcpressure.php');
//first parse the incoming message and then save it to db 

function parsedata($msg,$topic){
	$measurements['id'] = filter_var($topic, FILTER_SANITIZE_NUMBER_INT);
	$tmp = explode(',',$msg);

	foreach ($tmp as $key => $value) {
		$rows = explode('=',$value);
		$measurements[$rows[0]] = $rows[1];
	}
	var_dump($measurements);
	savedata($measurements);
	return;

}

function savedata($data){
	
	include('connect.php');
	$temp = $data['temperature'];
	$flow = $data['flow'];
	$pressure = $data['pressure']/1000; //convert to kiloliters
	$id = $data['id'];
	

	//$pressure = CalcPressure($flow); //Calculate and return pressure based on flowspeed

	$data = [
		'id' => $id,
		'temp' => $temp,
		'flow' => $flow,
		'pressure' => $pressure
	];
	include('connect.php');
	try{
	//save data here
	$stmt = $connect->prepare("INSERT INTO stationstatistics (stationid, temperature, pressure, flowspeed) VALUES (:id, :temp, :pressure, :flow)"); 

	$stmt ->execute($data);
	}
	catch (PDOException $e) {
	  echo "DataBase Error:<br>".$e->getMessage();
	} catch (Exception $e) {
	  echo "General Error:<br>".$e->getMessage();
	}
	return;
}

?>