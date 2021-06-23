<?php
if (isset($_GET['stationid'])){
	echo $_SESSION['update'];
	unset($_SESSION['update']);
	$stationid = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT);
	include('connect.php');
	$stmt = $connect->prepare('SELECT * FROM stations s INNER JOIN stationsettings se ON s.stationid = se.stationid WHERE s.stationid = :id');
	$stmt->execute(array(':id' => $stationid));
	$station = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($station['updatestate'] == 0){
    $sign = '<font color=#FF0000; size=16px;>&bull;</font>';
  }
  else{
    $sign = '<font color=green; size=16px;>&bull;</font>';
  }
  $transmissiontime = $station['sendmeasurementsperiods']/60*5;
	$formcontent = "";
	$formcontent .= '

			<form method="post" action="updatestationinfo.php">

        	<fieldset id ="inputform" name="inputform">
            <a class="incontentbutton2" style="margin-top:10px;" href="station.php?selected=Επιλογή&stationid='.$stationid.'">Πίσω στον σταθμό</a><br>
            <font size=5px;>Πλήροφορίες Σταθμού</font></br>

			  <font class="creds">Όνομα Σταθμού:</font></br><input type="text" class="newinput" name="name" value="'.$station['stationname'].'" placeholder="Όνομα Σταθμού"  required></br>
  	 		<font class="creds">Τηλέφωνο:</font></br><input type="text" class="newinput" name="telephone" value="'.$station['stationtelephone'].'" placeholder="Τηλέφωνο"  required></br>
  	 		<font size=5px;>Όρια μετρήσεων</font></br>Ένδειξη παραλαβής ενημερώσεων<br>'.$sign.'<br>
        <font class="creds">Προσδοκώμενος χρόνος συλλογής μετρήσεων(Minutes):</font></br><input type="number" class="newinput" min="0" max="254" name="transmissiontime" value="'.$transmissiontime.'" placeholder="Συλλογή μετρήσεων"  required></br>
  	 		<font class="creds">Ανώτατο όριο θερμοκρασίας(Celsius):</font></br><input type="number" class="newinput" min="0" max="254" name="temphigh" value="'.$station['temperaturehigh'].'" placeholder="Ανώτατο όριο θερμοκρασίας"  required></br>
  	 		<font class="creds">Κατώτατο όριο θερμοκρασίας(Celsius):</font></br><input type="number" class="newinput" min="-127" max="127" name="templow" value="'.$station['temperaturelow'].'" placeholder="Κατότατο όριο θερμοκρασίας"  required></br>
  	 		<font class="creds">Ανώτατο όριο πίεσης:</font></br><input type="number" class="newinput" name="presshigh" min="0" max="254" value="'.$station['pressurehigh'].'" placeholder="Ανώτατο όριο πίεσης"  required></br>
  	 		<font class="creds">Κατώτατο όριο πίεσης:</font></br><input type="number" class="newinput" name="presslow"min="0" max="254" value="'.$station['pressurelow'].'" placeholder="Κατώτατο όριο πίεσης"  required></br>
  	 		<font class="creds">Ανώτατο όριο ταχύτητας ροής(kL/min):</font></br><input type="number" class="newinput" min="0" max="254" name="flowhigh" value="'.$station['flowhigh'].'" placeholder="Ανώτατο όριο ταχύτητας ροής"  required></br>
  	 		<font class="creds">Κατώτατο όριο ταχύτητας ροής(kL/min):</font></br><input type="number" class="newinput" min="0" max="254" name="flowlow" value="'.$station['flowlow'].'" placeholder="Κατώτατο όριο ταχύτητας ροής"  required></br>
  	 		<input type="submit" class="incontentbutton2" value="Αποθήκευση Αλλαγών" name="stationchanges">
      		<input type="hidden" name="idtoupdate" value="'.$station['stationid'].'">
  	 		</fieldset></form>';
  	 echo $formcontent;
}
?>