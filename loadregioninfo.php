<?php
if (isset($_GET['id'])){
	echo $_SESSION['update'];
	unset($_SESSION['update']);
	$regionid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	include('connect.php');
	$stmt = $connect->prepare('SELECT * FROM regions WHERE `regionid` = :id');
	$stmt->execute(array(':id' => $regionid));
	$region = $stmt->fetch(PDO::FETCH_ASSOC);
	$formcontent = "";
	$formcontent .= '
			<form method="post" action="updateregioninfo.php">
        	<fieldset id ="inputform" name="inputform">
            <font size=5px;>Πληροφορίες Περιφέρειας</font></br>
			  <font class="creds">Όνομα Περιφέρειας:</font></br><input type="text" class="newinput" name="name" value="'.$region['regionname'].'" placeholder="Όνομα Περιφέρειας"  required></br>
  	 		<font class="creds">Τηλέφωνο:</font></br><input type="text" class="newinput" name="telephone" value="'.$region['telephone'].'" placeholder="Τηλέφωνο"  required></br>
  	 		<input type="submit" class="incontentbutton2" value="Αποθήκευση Αλλαγών" name="regionchanges">
      		<input type="hidden" name="idtoupdate" value="'.$region['regionid'].'">
  	 		</fieldset></form>';
  	 echo $formcontent;
}
?>