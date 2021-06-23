<?php
include('checksession.php');
if (isset($_GET['failureid'])){
	$failureid = filter_var($_GET['failureid'], FILTER_SANITIZE_NUMBER_INT);
	include('connect.php');
	try{
	$stmt = $connect->prepare('SELECT * FROM failurereports WHERE ischecked = 0 AND failureid = :failureid ORDER BY failureid DESC LIMIT 1');
	$stmt -> execute(array('failureid' => $failureid));
	$data2 = $stmt->fetch(PDO::FETCH_ASSOC);
	}catch (PDOException $e) { echo $e->getMessage();}
	$stationid = $data2['stationid'];
	try{
	$stmt =  $connect->prepare("SELECT stationname FROM stations WHERE stationid = :stationid") ;
	$stmt->execute(array('stationid' => $stationid));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e) { echo $e->getMessage();}
	echo '<p style="font-size:25px;">Υπάρχει βλάβη στον σταθμό: '.$data['stationname'].'. Παρακαλώ ελέγξτε την άμεσα</p>
		  <p>Χρόνος συμβάντος: '.$data2['timestamp'].'</p>
          <p>Περιγραφή συμβάντος:</p><p> '.$data2['description'].'</p>
          <input type="submit" class="incontentbutton2" name="checked" value="Έλεγχος">
          <input type="hidden" name="failureid" value="'.$failureid.'">';
}
else{
	header('logout.php');
	die();
}
?>

