<?php
$level = 1;
include('checksession.php');
if (isset($_POST['submitupdate']) && isset($_POST['idtoupdate'])){
	include('connect.php');
	if($_SESSION['user_type'] != 3){
	$userid = filter_var($_POST['idtoupdate'], FILTER_SANITIZE_NUMBER_INT);
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$updateuser = [
		'username' => $username,
		'telephone' => $telephone,
		'email' => $email,
		'userid' => $userid
		];
	$stmt = $connect->prepare("UPDATE users SET username=:username, telephone=:telephone, email=:email WHERE userid = :userid")or die();
    $stmt->execute($updateuser);
    }
    else{
    $userid = filter_var($_POST['idtoupdate'], FILTER_SANITIZE_NUMBER_INT);
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
	$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
	$updateuser = [
		'username' => $username,
		'telephone' => $telephone,
		'email' => $email,
		'userid' => $userid,
		'firstname' => $firstname,
		'lastname' => $lastname
		];
	$stmt = $connect->prepare("UPDATE users SET username=:username, firstname=:firstname, lastname=:lastname, telephone=:telephone, email=:email WHERE userid = :userid")or die();
    $stmt->execute($updateuser);
    }
    if($stmt){
    		$_SESSION['update'] = 'Επιτυχία στην αποθήκευση!'; 
	}
	else{
			$_SESSION['update'] = 'Αποτυχία στην αποθήκευση!'; 
	}
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
elseif(isset($_POST['passchange']) && isset($_POST['idtoupdate'])){
	include('connect.php');
	$userid = filter_var($_POST['idtoupdate'], FILTER_SANITIZE_NUMBER_INT);
	$password = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
	$password = password_hash($password, PASSWORD_BCRYPT);
	$updatepassword = [
		'password' => $password,
		'userid' => $userid
	];
	$stmt = $connect->prepare("UPDATE users SET password=:password WHERE userid =:userid");
	$stmt->execute($updatepassword);
	if($stmt){
    		$_SESSION['update'] = 'Επιτυχία στην αποθήκευση κωδικού!'; 
	}
	else{
			$_SESSION['update'] = 'Αποτυχία στην αποθήκευση κωδικού!'; 
	}
    header("Location: " . $_SERVER["HTTP_REFERER"]);

}
?>
