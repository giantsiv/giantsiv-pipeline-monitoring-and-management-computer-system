<?php
require('backgroundchecks.php');
function parseerror($msg,$topic){
	$error['stationid'] = filter_var($topic, FILTER_SANITIZE_NUMBER_INT);
	
	

	$error['errorcode'] = $msg;
	identifyerror($error);
	return;

}

function identifyerror($error){
	$stationid = $error['stationid'];
	$errorcode = $error['errorcode'];
	switch($errorcode){
	
		case 1:
			$desc = "Station Temperature is above limits";
			$type = 2;
			break;
		case 2: 
			$desc = "Station Temperature is below limits";
			$type = 2;
			break;
		case 5:
			$desc = "Station Flowspeed is above limits";
			$type = 4;
			break;
		case 6:
			$desc = "Station Flowspeed is below limits";
			$type = 4;
			break;
		case 3:
			$desc = "Station Pressure is below limits";
			$type = 3;
			break;
		case 4:
			$desc = "Station Pressure is below limits";
			$type = 3;
			break;
	}
	checkfailure($stationid,$type,$desc);

}

?>