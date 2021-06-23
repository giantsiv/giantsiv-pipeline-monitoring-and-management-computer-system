<?php //Add new Station  FINISHED
$level = 2;
include('checksession.php');
if (isset($_POST['stationname']) && isset($_POST['telephone']) && isset($_POST['newstationassign'])){
$stationname = filter_var($_POST['stationname'], FILTER_SANITIZE_STRING);
$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
$regionid = filter_var($_POST['newstationassign'], FILTER_SANITIZE_NUMBER_INT);
include('connect.php');
$newstation = [
'stationname' => $stationname,
'telephone' => $telephone
];
try {
$stmt = $connect->prepare("INSERT INTO stations (stationname, stationtelephone) VALUES (:stationname, :telephone)"); //insert new station to db 
$stmt->execute($newstation);
} catch (Exception $e) {
    
    echo $e;
}

try {
$stmt2 = $connect->prepare("SELECT stationid FROM stations ORDER BY stationid DESC LIMIT 1") or die('Invalid query: ' . mysql_error()); //take that new station id 
$stmt2->execute();
$station = $stmt2->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    
    echo $e;
}
echo 'New station ID:'.$stationid = $station['stationid'];

//load default settings from config file
$temphigh = $ini['upper_temperature_limit'];
$templow = $ini['lower_temperature_limit'];
$presshigh = $ini['upper_pressure_limit'];
$presslow = $ini['lower_pressure_limit'];
$flowhigh = $ini['upper_flowrate_limit'];
$flowlow = $ini['lower_flowrate_limit'];


$settings = [
		'stationid' => $stationid,
		'temperaturehigh' => $temphigh,
		'temperaturelow' => $templow,
		'pressurehigh' => $presshigh,
		'pressurelow' => $presslow,
		'flowhigh' => $flowhigh,
		'flowlow' => $flowlow,
		'sendmeasurementsperiods' => 60
	];

try {
$stmt4 = $connect->prepare("INSERT INTO stationsettings (stationid, temperaturehigh, temperaturelow, pressurehigh, pressurelow, flowhigh, flowlow, sendmeasurementsperiods) VALUES (:stationid, :temperaturehigh, :temperaturelow, :pressurehigh, :pressurelow, :flowhigh, :flowlow, :sendmeasurementsperiods)") or die('Invalid query: ' . mysql_error()); //save default settings

$stmt4 ->execute($settings);
} catch (Exception $e) {
    
    echo $e;
}

try {
$stmt3 = $connect->prepare("INSERT INTO stationstoregions (regionid, stationid) VALUES (:regionid, :stationid)") or die('Invalid query: ' . mysql_error()); //assign the station to the region
$stmt3 ->execute(array('regionid' => $regionid , 'stationid' => $stationid));
} catch (Exception $e) {
    
    echo $e;
}
if(!isset($e)){
	header('Location: managestations.php');
}
}
else{
	header('Location: managestations.php');
}
?>