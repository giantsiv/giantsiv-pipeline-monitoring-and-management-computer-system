<?php
require_once('subscribetomeasurements.php'); //listen for incoming measurements
require_once('subscribetoupdateconfirmation.php'); //listen for successfull update confirmation
require_once('subscribetoerrors.php'); // listen for incomming station errors
require_once('subscribetofirstsetup.php'); // listen for first setup requests from the arduinos

if(subscribetomeasurements() && subscribetoupdateconfirmation() && subscribetoerrors() && subscribetofirstsetup()){
	echo "Noice\n";
}

?>