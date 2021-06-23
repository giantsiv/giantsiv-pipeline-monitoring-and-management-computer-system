<?php 
$level = 1;
include('checksession.php');
if ($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3){
	$button = '<form action="stationoptions.php">
		<input type="hidden" value="'.$stationid.'" name="stationid">
		<input class="incontentbutton" type="submit" name="submit" value="Επεξεργασία">
		</form><br>';

	echo $button;
}
?>
