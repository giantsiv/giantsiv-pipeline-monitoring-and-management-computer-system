<?php
if(isset($_GET['stationid'])){
	$id = $_GET['stationid'];
	include('connect.php');
	$stmt=$connect->prepare('SELECT * FROM stationsettings WHERE stationid=:id');
	$stmt->execute(array('id'=>$id));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	

	echo $data['temperaturehigh'].':'.$data['temperaturelow'].':'.$data['pressurehigh'].':'.$data['pressurelow'].':'.$data['flowhigh'].':'.$data['flowlow'].':';

}
else{
	echo 'illegal request';
}

?>
