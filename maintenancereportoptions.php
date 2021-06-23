<?php
$level = 1;  
include('checksession.php');
if($_SESSION['user_type'] == 1){ //checks if user is technician to show report form
$stationid = $_SESSION['stationid'];
echo '<a class="incontentbutton2" style="margin-top:10px;" href="station.php?selected=Επιλογή&stationid='.$stationid.'">Πίσω στον σταθμό</a><br>';
echo $options='<div class="form">

  	 		<h3>Φόρμα αναφοράς συντήρησης σταθμού</h3>
  	 		<form method="post" action="addreport.php">
  	 			<textarea name="comments" class="newinput" rows="6" cols="40" placeholder="Σχόλια συστήρησης" required></textarea></br>
  	 			<input type="submit" class="incontentbutton2" name="submit" value="Submit">
  	 		</form>
  	 	</div>';
}
else{
	$stationid = $_SESSION['stationid'];
	echo '<a class="incontentbutton2" style="margin-top:10px;" href="station.php?selected=Επιλογή&stationid='.$stationid.'">Πίσω στον σταθμό</a><br>';
}
?>