<?php
$level = 1;
include('checksession.php');
include ('connect.php');
if (isset($_GET['stationid'])){
	$stationid = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT); //get
	$_SESSION['stationid'] = $stationid; //later to be used by maintenance reports 
	//load station selected
	$stmt = $connect->prepare('SELECT * FROM stations  WHERE `stationid` = :stationid ');
	$stmt->execute(array(':stationid' => $stationid));
	$stationdata = $stmt->fetch(PDO::FETCH_ASSOC);
	$stationname = '<div><font size="5px;">Station:</font><b>'. $stationdata['stationname'].'</b><input type="hidden" name="stationid" value="'.$stationid.'"></div>';
		


	if (isset($_GET['datefrom']) && !$_GET['dateto']){
		$date = '<div class="station_date"><h2>'.$_GET['datefrom'] . '</h2></div>';
		$specifDate1 = $_GET['datefrom'];
		$specifDate2 = $_GET['datefrom'];
	}
	elseif(isset($_GET['datefrom']) && isset($_GET['dateto'])){
		$date = '<div class="station_date"><h2>'. $_GET['datefrom'] .' με '. $_GET['dateto']. '</h2></div>';
		$specifDate1 = $_GET['datefrom'];
		$specifDate2 = $_GET['dateto'];
	}
	else{
		$t=time();
		$specifDate1 = date("Y-m-d",$t);
		$specifDate2 = $specifDate1;
		$date = '<div class="station_date"><h2>'.$specifDate1 . '</h2></div>';
		}
		$datachartTemperature = "";
		$datachartPressure = "";
		$datachartFlowspeed = "";
		
		try {
		$stmt = $connect->prepare('SELECT * FROM stationstatistics WHERE `stationid` = :stationid AND `timestamp` >= DATE(:a1) AND `timestamp` <  DATE(:a2) + INTERVAL 1 DAY ORDER BY `timestamp` ASC');
		$stmt->execute(array(
		':a1' => $specifDate1,
		':a2' => $specifDate2,
		':stationid' => $stationid
		));
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo $e->getMessage();
		} catch (Exception $e) {
  			echo $e->getMessage();
		}
		
		if($data == false){
			echo $msg = "Station data not found";
		}
		else {
			foreach ($data as $stat) {
				$time=date('Y-m-d H:i:s', strtotime($stat['timestamp']));
				$flow=$stat['flowspeed'];
				$temp = $stat['temperature'];
				$pressure = $stat['pressure'];
				$datachartTemperature.="['" . $time ."',". $temp . "],";
				$datachartPressure.="['" . $time . "',". $pressure . "],";
				$datachartFlowspeed.="['" . $time . "',". $flow . "],";
			    }}		
}

?>