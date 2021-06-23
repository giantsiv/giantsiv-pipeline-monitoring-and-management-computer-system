<?php
subscribetofirstsetup();
function subscribetofirstsetup(){
	require_once('mosquittocreds.php');	

	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if(!$mqtt->connect(true, NULL, $username, $password)) {
		exit(1);
	}

	$mqtt->debug = true;

	$topics['firstsetup/#'] = array('qos' => 0, 'function' => 'procsetupMsg');
	$mqtt->subscribe($topics, 0);

	while($mqtt->proc()) {

	}

	$mqtt->close();
}


function procsetupMsg($topic, $msg){
		parsesetuprequest($msg,$topic);
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}


function parsesetuprequest($msg,$topic){
	require_once('publishupdateflag.php');
	require_once('publishnewsettings.php');
	$id = $msg;
	publishupdateflag($id);
	publishnewsettings($id);
}
?>