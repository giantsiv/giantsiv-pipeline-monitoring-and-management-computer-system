<?php //Add new region FINISHED

$level=3;
include('checksession.php');

if (isset($_POST['regionname']) && isset($_POST['telephone'])){
$regionname = filter_var($_POST['regionname'], FILTER_SANITIZE_STRING);
$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);

include('connect.php');
$newregion = [
'regionname' => $regionname,
'telephone' => $telephone
];
try {
$stmt = $connect->prepare("INSERT INTO regions (regionname, telephone) VALUES (:regionname, :telephone)"); //insert new region to db 
$stmt->execute($newregion);
} catch (Exception $e) {
    
    echo $e;
}
if(!isset($e)){
	$_SESSION['error'] = 'Επιτυχία στην προσθήκη';
	header('Location: manageregions.php');
}
else{
	$_SESSION['error'] = 'Αποτυχία στην προσθήκη';
	header('Location: manageregions.php');
}
}
else{
	header('Location: manageregions.php');
}