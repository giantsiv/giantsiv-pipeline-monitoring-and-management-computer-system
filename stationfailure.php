<?php
function StationFailureHandling($stationid, $error , $value){


require('handlefailure.php');

$station = $stationid; //data Recieved from arduino
$errorCode = $error;


switch($errorCode){
	
	case 1:
		$desc = "Station Temperature is above limits.<br>Temperature:".$value."Celsius";
		break;
	case 2: 
		$desc = "Station Temperature is below limits.<br>Temperature:".$value."Celsius";
		break;
	case 3:
		$desc = "Station Flowspeed is above limits.<br>Flowspeed:".$value."L/m";
		break;
	case 4:
		$desc = "Station Flowspeed is below limits.<br>Flowspeed:".$value."L/m";
		break;
	case 5:
		$desc = "Station Pressure is below limits.<br>Pressure:".$value."Bar";
		break;
	case 6:
		$desc = "Station Pressure is below limits.<br>Pressure:".$value."Bar";
		break;
}

HandleFailure($station, $desc);

}

/*
case 1:
		$desc = "Station Temperature,Pressure and Flowspeed are above limits.<br>Temperature:".$value['temperature']."Celsius<br>Pressure:".$value['pressure']."Bar<br>Flowspeed:".$value['flowspeed']."m/s";
		break;
	case 2:
		$desc = "Station Temperature and Flowspeed are above limits.<br>Temperature:".$value['temperature']."Celsius<br>Flowspeed:".$value['flowspeed']."m/s";
		break;
	case 3:
		$desc = "Station Temperature and Pressure are above limits.<br>Temperature:".$value['temperature']."Celsius<br>Pressure:".$value['pressure']."Bar";
		break;
	case 4:
		$desc = "Station Pressure and Flowspeed are above limits.<br>Pressure:".$value['pressure']."Bar<br>Flowspeed:".$value['flowspeed']."m/s";
		break;
*/
		?>
