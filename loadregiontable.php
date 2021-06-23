<?php
$level = 3;
include('checksession.php');
include('connect.php');
$stmt = $connect->prepare('SELECT * FROM regions');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$regiontable = '<div><p><table id="contenttable" class="contenttable"><caption class="tblcaption">Περιφέρειες</caption><tr><th>Όνομα Περιφέρειας</th><th>Τηλέφωνο</th><th>Επιλογές</th></tr>';
if ($data == false){
	echo "no Regions found in the system";
}
else{
	foreach ($data as $region) {
		$regiontable .= '<tr><td>' . $region['regionname'] .'</td><td>' . $region['telephone'] . '</td><td><form method="get" action="regionoptions.php"><input type="submit" name="selected" class="incontentbutton2" value="Επιλογή"><input type="hidden" value="'.$region['regionid'].'" name="id"></form></td></tr>';
	}
	$regiontable .= '</table></p></div>';
	echo $regiontable;
}
?>