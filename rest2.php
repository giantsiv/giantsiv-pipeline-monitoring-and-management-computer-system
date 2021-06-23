<?php
	include('connect.php');
	//$data = json_decode(file_get_contents('php://input'));
	/*$decodedText = html_entity_decode(file_get_contents('php://input'));
	$data = json_decode($decodedText, true);
	var_dump($data);*/
	
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$token= filter_var($_POST['token'], FILTER_SANITIZE_STRING);
	
	$updateuser = [
		'token' => $token,
		'userid' => $id
		];
	$stmt = $connect->prepare("UPDATE users SET GCM_token=:token WHERE userid = :userid")or die();
    $stmt->execute($updateuser);


?>
