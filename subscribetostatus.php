<?php
subscribetostatus();
function subscribetostatus(){
	
	require_once('mosquittocreds.php');	
	
	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if(!$mqtt->connect(true, NULL, $username, $password)) {
		exit(1);
	}

	$mqtt->debug = true;

	$topics['status/#'] = array('qos' => 0, 'function' => 'procmeasurementsMsg');
	$mqtt->subscribe($topics, 0);

	while($mqtt->proc()) {

	}

	$mqtt->close();

}

function procmeasurementsMsg($topic, $msg){
		parsestatus($msg,$topic);
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}

function parsestatus($msg,$topic){
	$id = filter_var($topic, FILTER_SANITIZE_NUMBER_INT);
    include('connect.php');
    $stmt = $connect->prepare("UPDATE stationsettings SET isconnected=:isconnected WHERE stationid = :stationid")or die();
    $stmt->execute(array(
    	'stationid' => $id,
    	'isconnected' => $msg
));
}

?>