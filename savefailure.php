<?php //Save a new failure event on DB

function SaveFailure( $id,$type, $msg){
    include('connect.php');
	try{
		$stmt = $connect->prepare('INSERT INTO failurereports (stationid,description,failuretype) VALUES (:stationid,:description,:type)');
		$stmt->execute(array('stationid'=> $id, 'description'=> $msg, 'type'=> $type));
	}
	catch(PDOException $e){
		echo 'Failed to add failure to db:'.$e .'<br>';
	}
	$id = $connect->lastInsertId();
	return $id; //Return failure id on success false on error;
}
?>