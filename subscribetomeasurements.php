<?php
subscribetomeasurements();

function subscribetomeasurements(){
	
	require_once('mosquittocreds.php');	
	require('gatherdata.php');
	
	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if(!$mqtt->connect(true, NULL, $username, $password)) {
		exit(1);
	}

	$mqtt->debug = true;

	$topics['measurements/#'] = array('qos' => 0, 'function' => 'procmeasurementsMsg');
	$mqtt->subscribe($topics, 0);

	while($mqtt->proc()) {

	}

	$mqtt->close();

}

function procmeasurementsMsg($topic, $msg){
		parsedata($msg,$topic);
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}
?>