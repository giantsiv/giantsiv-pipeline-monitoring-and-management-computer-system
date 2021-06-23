<?php
$level = 1;
include('checksession.php');

$button = '<form method="get" action="reporthistory.php">
	<input type="hidden" value="'.$stationid.'" name="stationid">
	<input class="incontentbutton" type="submit" name="submit" value="Ιστορικό Βλαβών">
	</form><br>';

echo $button;

?>