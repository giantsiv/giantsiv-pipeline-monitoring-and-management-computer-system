<?php
$level = 1;
include('checksession.php');
if(isset($_GET['submit'])){
	$stationid = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT);
	publishupdateflag($stationid);
	header("location:javascript://history.go(-1)");
}





function publishupdateflag($stationid){
	include('mosquittocreds.php');	

	if ($mqtt->connect(true, NULL, $username, $password)) {
		echo $mqtt->publish('servo/station'.$stationid, '1', 1, false);
		$mqtt->close();
	} else {
	    echo "Time out!\n";
	}
	return;
}

?>