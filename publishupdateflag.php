<?php

function publishupdateflag($stationid){
	require('mosquittocreds.php');	


	if ($mqtt->connect(true, NULL, $username, $password)) {
		echo $mqtt->publish('update/station'.$stationid, '1', 0, false);
		$mqtt->close();
	} else {
	    echo "Time out!\n";
	}
	return;
}
?>