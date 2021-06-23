<?php 
$level = 1;
include('checksession.php');
echo $button =  '<form method="get" action="maintenancereport.php"><input type="hidden" value="'.$stationid.'" name="stationid"><input class="incontentbutton" type="submit" name="submit" value="Συντήρηση"></form></br><form method="get" action="shutdown.php"><input type="hidden" value="'.$stationid.'" name="stationid"><input class="incontentbutton" type="submit" name="submit" value="Shutdown" onclick=\'return confirm("Είστε σίγουρος πως θέλετε να κλείσετε την βαλβίδα;")\'></form>';
?>