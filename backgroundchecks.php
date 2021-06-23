<?php

function checkstationtransmission(){
	include('connect.php');
	$stmt = $connect->prepare('SELECT stationid FROM stations');
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $station) {
		$stationid = $station['stationid'];
		echo "stationid:'.$stationid.'\n";
		$stmt = $connect->prepare('SELECT timestamp FROM stationstatistics WHERE stationid = :stationid ORDER BY stationid DESC LIMIT 1');
		$stmt -> execute(array(
			'stationid' => $stationid));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt2 = $connect->prepare('SELECT sendmeasurementsperiods FROM stationsettings WHERE stationid = :stationid');
		$stmt2 -> execute(array(
			'stationid' => $stationid));
		
		$data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		$timestamp = $data['timestamp'];
		if($timestamp < time() - 5*$data2['sendmeasurementsperiods'] + 30){ //5*60/60*time = 5*time - 5 is 5 sec loop delay on arduino - also give half a minute delay 
			$type = 1;
			$msg = 'Station did not send data to DB in designated time period.';
			checkfailure($stationid, $type, $msg);
		}
		else{
			echo "no transmission failure for this station\n";
		}
	}

}

function checkfailure($stationid, $type, $msg){

	require_once('handlefailure.php');
	require_once('savefailure.php');
	
	
	$exists = checkiffailureexists($stationid,$type);
	if($exists){  //if it does exist check if is checked and pull the essentials
		if($exists['ischecked'] == 1){
			echo "Last failure of this type is checked for this station\n";
			if(checkrepeatfailure($exists['timestamp'])){
				echo "Time limit has passed, creating new failure\n";
				$newfailure = createfailure($stationid,$type,$msg);
				$failureid = $newfailure['id'];
			}
			else{
				echo "Time limit has not passed, new failure not created\n";
				return;
			}
		}
		else{
			echo "Last failure of this type is not checked for this station\n";
			if($exists['stage'] == 3) {
				echo "All necessary actions for the last failure have been taken...checking time limit to create new\n";
				if(checkrepeatfailure($exists['timestamp'])){
					echo "Time limit has passed, crating new failure\n";
					$newfailure = createfailure($stationid,$type,$msg);
					$failureid = $newfailure['id'];
				}
				else{
					echo "Time limit has not passed, new failure not created\n";
					return;
				}
			}
			else{
				echo "Checking stage and taking the necessary actions \n";
				$failureid = $exists['failureid'];
			}
		}
	}
	else{ //if failure doesnt exist create it
		echo "This type of failure for this station doesnt exist...Creating failure\n";
		$newfailure = createfailure($stationid,$type,$msg);
		$failureid = $newfailure['id'];
		/*$timestamp = $newfailure['timestamp'];
		$stage = $newfailure['stage'];*/
	}
	
	if(isset($failureid)){
		HandleFailure($stationid, $failureid); //then handle it 
	}
		
}


function createfailure($stationid,$type,$description){
	echo "failure doesnt exist\n"; 
	echo 'trying to create failure with stationid:'.$stationid.' & description:' . $description ."\n";
	$failureid = SaveFailure($stationid,$type, $description);
	echo "failure id:" .$failureid . '\n';
	$newfailure['id'] = $failureid;
	$newfailure['timestamp'] = 0;
	$newfailure['stage'] = 0;
	return $newfailure;
}

function checkiffailureexists($stationid,$type){
	include('connect.php');
	$stmt = $connect->prepare('SELECT * FROM failurereports WHERE stationid = :stationid AND failuretype = :type ORDER BY failureid DESC LIMIT 1'); 
	$stmt-> execute(array(
		'stationid' => $stationid,
		'type' => $type
	));
	$exists = $stmt->fetch(PDO::FETCH_ASSOC);
	return $exists;
}

//if time limit exceds current time return true else false
function checkrepeatfailure($timestamp){
	$ini = parse_ini_file('config/config.ini');
	$limit = date("Y-M-d H:i:s" ,strtotime($timestamp) + $ini['repeat_notification_time']*60);
	echo 'Time limit:' . $limit. '\n';
	$time = date('Y-M-d H:i:s');
	echo 'Current time:' . $time. '\n';
if(strtotime($limit) > strtotime($time)){
return false;
}
else{
return true;
}
}


function checkupdatestate(){ //if station was unable to get or confirm update, resent update
	require('publishupdateflag.php');
	require('publishnewsettings.php');
	include ('connect.php');
	$stmt = $connect->prepare("SELECT stationid FROM stationsettings WHERE updatestate=0");
	$stmt->execute();
	$ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($ids as $id) {
		echo 'Resending update to stationid:'.$id['stationid']."!\n";
		publishupdateflag($id['stationid']);
		publishnewsettings($id['stationid']);
	}
}
?>
