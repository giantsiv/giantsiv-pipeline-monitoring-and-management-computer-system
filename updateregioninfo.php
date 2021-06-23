<?php
$level = 3;
include('checksession.php');
if (isset($_POST['regionchanges']) && isset($_POST['idtoupdate'])){
	include('connect.php');
	$id = filter_var($_POST['idtoupdate'], FILTER_SANITIZE_NUMBER_INT);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
	$updateregion = [
		'regionname' => $name,
		'telephone' => $telephone,
		'regionid' => $id
		];
	$stmt = $connect->prepare("UPDATE regions SET regionname=:regionname, telephone=:telephone WHERE regionid = :regionid")or die();
    $stmt->execute($updateregion);
    if($stmt){
    		$_SESSION['update'] = 'Επιτυχία στην αποθήκευση!'; 
	}
	else{
			$_SESSION['update'] = 'Αποτυχία στην αποθήκευση!'; 
	}
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>