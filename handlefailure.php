<?php //

require('notificationactions.php');
require('updatefailurestage.php');
function HandleFailure($stationid,$failureid){
	include('connect.php');
	$ini = parse_ini_file('config/config.ini');
	$stmt = $connect->prepare('SELECT * FROM failurereports WHERE failureid = :failureid');
	$stmt -> execute(array('failureid' => $failureid));

	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$timestamp = $data['timestamp'];
	$stage = $data['stage'];
	$msg = $data['description'];
	$limit = date("Y-M-d H:i:s" ,strtotime($timestamp) +$ini['notification_sleep_time']*60);
	echo "Time limit:" . $limit. "\n";
	$time = date('Y-M-d H:i:s');
	echo 'Current time:' . $time. "\n";

	if($stage == 0){ //if the failure has just been started send to techs
		echo "failure event stage:0, notifying assigned technicians...\n";
		$stmt = $connect->prepare('SELECT telephone, userid, auth_token FROM users u JOIN assignedtechnicians a on u.userid = a.technicianid WHERE a.stationid = :stationid AND u.activeaccount = 1');
		$stmt->execute(array('stationid' => $stationid)); //find technicians assigned to that station
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

		NotificationActions($msg, $stationid, $data);

		updatefailurestage($failureid, $stage); //+1 to the failure stage
		return;
	}


	if($stage == 1 &&  strtotime($limit) < strtotime($time)){
		//notify managers
		/*
		reduntant since the event wont start again if the arduino resumes sending data
		$stmt = $connect->prepare('SELECT ischecked FROM failurereports WHERE failureid = :failureid AND ischecked = 0'); 
		$stmt->execute(array('failureid' =>$failureid)); //Returns true if event is not checked yet
		*/
		/*if(!$stmt){ //if false stop function execution
			return ;
		}
		else{ //if true continue*/
		echo"failure event stage:1, notifying assigned managers...\n";
		$stmt = $connect->prepare('SELECT u.telephone, userid, auth_token FROM users u JOIN assignedsupervisors su on u.userid = su.supervisorid JOIN regions r on su.regionid = r.regionid JOIN stationstoregions sr on r.regionid = sr.regionid JOIN stations s on sr.stationid = s.stationid WHERE s.stationid = :stationid');
		$stmt->execute(array('stationid' => $stationid));
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		NotificationActions($msg, $stationid, $data);

		updatefailurestage($failureid, $stage); //+1 to the failure stage
		return;
		//}
	}

	if($stage == 2 && strtotime($limit) < strtotime($time) ){
	//notify admins
	/*
	$stmt = $connect->prepare('SELECT ischecked FROM failurereports WHERE failureid = :failureid AND ischecked = 0'); 
	$stmt->execute(array('failureid' =>$failureid)); 

	if(!$stmt){ //if false stop function execution
		return ;
	}
	else{ //if true continue*/
		echo"failure event stage:2, notifying System Admins...\n";
		$stmt = $connect->prepare('SELECT telephone, userid, auth_token FROM users u WHERE usertype = 3');
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		NotificationActions($msg, $stationid, $data);

		updatefailurestage($failureid, $stage); //+1 to the failure stage
		return;
	}
	echo "Too early to send reports\n";
}
?>