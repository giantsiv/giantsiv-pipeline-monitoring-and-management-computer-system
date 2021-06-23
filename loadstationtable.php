<?php
$level = 1;
include('checksession.php');
include('connect.php');
if ($_SESSION['user_type'] == 1){
	$userid = $_SESSION['user_id'];
	$stmt = $connect->prepare('SELECT * FROM stations s JOIN assignedtechnicians at on s.stationid = at.stationid JOIN stationstoregions t on s.stationid = t.stationid JOIN regions r on t.regionid = r.regionid WHERE `technicianid` = :technicianid');
	$stmt->execute(array(
		':technicianid' => $userid
		));
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else{
	$stmt = $connect->prepare('SELECT * FROM stations s INNER JOIN stationstoregions t on s.stationid = t.stationid INNER JOIN regions r on t.regionid = r.regionid');
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stationtable = '';
if ($_SESSION['user_type'] != 1){
	$stationtable .= '<div style="clear: both;"></div><div class="incontentdiv">
  						<a href="newstation.php" class="incontentbutton"><i style="margin-right: 4px;" class="fa fa-plus-circle"></i>Νέος Σταθμός</a>
  						<input type="text" id="search" onkeyup="searchtable()" placeholder="Αναζήτηση σταθμού..." title="">
  					  </div>';
  	$stationtable .= '<div><p><table id="contenttable" class="contenttable"><caption class="tblcaption">Σταθμοί</caption><tr><th>Όνομα Σταθμού</th><th>Κατάσταση Σύνδεσης</th><th>Περιφέρεια</th><th>Τηλέφωνο</th><th>Επιλογές</th></tr>';
}
else{
	$stationtable .= '<div class="technician_station_table"><p><table id="contenttable" class="contenttable"><caption class="tblcaption">Σταθμοί</caption><tr><th>Όνομα Σταθμού</th><th>Κατάσταση Σύνδεσης</th><th>Περιφέρεια</th><th>Τηλέφωνο</th><th>Επιλογές</th></tr>';
}

if ($data == false){
	if ($_SESSION['user_type'] != 1){
	echo '<div style="clear: both;"></div><div class="incontentdiv">
  			<a href="newstation.php" class="incontentbutton"><i style="margin-right: 4px;" class="fa fa-plus-circle"></i>Νέος Σταθμός</a>no Stations found in the system';
  	}
  	else{
  		echo 'Δεν σας έχει ανατεθεί σταθμός';

  	}
}
else{
	foreach ($data as $station) {
		$stationid = $station['stationid'];
		$stmt2 = $connect->prepare('SELECT isconnected FROM stationsettings WHERE stationid=:stationid');
		$stmt2->execute(array(
		':stationid' => $stationid
		));
		$data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
		if ($data2['isconnected'] == true){
			$active = '<font  color="green">	 &#11044; </font>';
		}
		else{
			$active = '<font color="red"> &#11044; </font>';
		}
		include("checkforfailure.php");
		$stationtable .= '<tr id="tabletr"><td>' .$failure2. $station['stationname'] .'</td><td>'.$active.'</td><td>' . $station['regionname'] . '</td><td>' . $station['stationtelephone'] . '</td><td><form method="get" action="station.php"><input class="incontentbutton2" type="submit" name="selected" value="Επιλογή"><input type="hidden" value="'.$station['stationid'].'" name="stationid"></form></td></tr>';
		$failure2 = '';
	}
	$stationtable .= '</table>
	<script type="text/javascript" src="js/searchtable.js"></script></p></div>';
	echo $stationtable;
}
?>