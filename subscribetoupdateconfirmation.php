<?php
subscribetoupdateconfirmation();
function subscribetoupdateconfirmation(){
	require_once('mosquittocreds.php');	
	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if(!$mqtt->connect(true, NULL, $username, $password)) {
		exit(1);
	}

	$mqtt->debug = true;

	$topics['confirmupdate/#'] = array('qos' => 0, 'function' => 'procconfirmationMsg');
	$mqtt->subscribe($topics, 0);

	while($mqtt->proc()) {

	}

	$mqtt->close();
}

function procconfirmationMsg($topic, $msg){
		parseconfirmation($msg,$topic);
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}


function parseconfirmation($msg,$topic){
		$id = $msg;
		include('connect.php');
		$stmt = $connect->prepare("UPDATE stationsettings SET updatestate = :stage  WHERE stationid = :stationid");
		$stmt->execute(array(
			'stationid' => $id, 
			'stage' => '1' 
		));
		if($stmt){
    		echo 'Successfully updated update state on stationid:'.$id."\n"; 
		}
		else{
			echo 'SFailed to update update state on stationid:'.$id."\n";  
		}
}
?>