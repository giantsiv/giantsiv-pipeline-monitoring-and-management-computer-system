<?php
$level = 1;
include('checksession.php');
include('connect.php');
if (isset($stationid)){
	$stmt = $connect->prepare('SELECT * FROM failurereports WHERE ischecked = 0 AND stationid = :stationid ORDER BY stationid DESC LIMIT 1');
	$stmt -> execute(array('stationid' => $stationid));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($data != NULL){
		$failure1 = '<form action="inspectfailure.php"><input type="image" alt="submit" name="showfailure" class="failure-image"src="img/failure.png" border="0"><input type="hidden" name="failureid" value="'.$data['failureid'].'"></form></br>
		Σημαντικό!</br>Υπάρχει βλάβη στον σταθμό<br>'.$data['description'].'<br>'.$data['timestamp'];
		$failure2 = '<img name="showfailure" alt="Station Failure" class="table-failure-image" src="img/failure.png" border="0">';
	}
	else{
	$failure1 = '--------------<br>';
	}
}

?>