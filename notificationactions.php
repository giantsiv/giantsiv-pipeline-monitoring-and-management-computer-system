<?php 
error_reporting(E_ALL & ~E_NOTICE);
require('sendnotification.php');
require('sendsms.php');

function NotificationActions($msg, $stationid, $data){
	foreach ($data as $user) {
		echo $token = LoadGCMToken($user['userid']);
		echo 'Sending notifications to userid:'.$user['userid']."\n";
		sendGCM($token, $msg);
		$description = $msg . "Click on link to confirm that you have been informed http://localhost/ptest/savefailure.php?checked=Check+Failure&stationid=".$stationid."&auth=".$user['auth_token']; //build hyperlink for sms
		//SendSms($user['users.telephone'], $description);
	}
}


function LoadGCMToken($userid){
	include('connect.php');
	$stmt = $connect->prepare("SELECT GCM_token FROM users WHERE userid = :userid");
	$stmt->execute(array('userid' => $userid));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data['GCM_token'];
}
?>