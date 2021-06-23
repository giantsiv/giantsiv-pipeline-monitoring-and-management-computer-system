<?php
subscribetoerrors();
function subscribetoerrors(){
	require_once('mosquittocreds.php');	
	require('saveerror.php');
	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if(!$mqtt->connect(true, NULL, $username, $password)) {
		exit(1);
	}

	$mqtt->debug = true;

	$topics['errors/#'] = array('qos' => 0, 'function' => 'procerrorMsg');
	$mqtt->subscribe($topics, 0);

	while($mqtt->proc()) {

	}

	$mqtt->close();

}

function procerrorMsg($topic, $msg){
		parseerror($msg,$topic);
		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}
?>