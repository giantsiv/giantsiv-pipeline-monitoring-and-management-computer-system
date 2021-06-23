<?php 
include('connect.php');
$date = '2021-06-2 00:00:00';
for ($i=1; $i<=288; $i++){
	$temperature = rand(40,50);
	$pressure = rand(10,20);
	$flowspeed = rand(5,15);
	
	$newdata = [
	'stationid' => 1,
	'temperature' => $temperature,
	'pressure' => $pressure,
	'flowspeed' => $flowspeed,
    'timestamp' => $date,
	];
	$stmt = $connect->prepare ("INSERT INTO stationstatistics (stationid, temperature, pressure, flowspeed, timestamp) VALUES (:stationid, :temperature, :pressure, :flowspeed, :timestamp)");
	$stmt->execute($newdata);
	$date = strtotime($date);
	$date = $date+(60*5);
	$date = date("Y-m-d H:i:s", $date);

}
?>