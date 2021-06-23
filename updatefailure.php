<?php //When user checks the failure update ischecked to 1
require('generatetoken.php');
include('connect.php');
session_start();
//error_reporting(0);	
if (!isset($_SESSION['user_id']) && isset($_GET['auth'])) //if the session hasn't been created, check if the data came from a link
{
	
	$token = filter_var($_GET['auth'], FILTER_SANITIZE_STRING);
	$stmt = $connect->prepare('SELECT userid ,username,password,firstname,lastname,email FROM users WHERE auth_token = :token');
	$stmt->execute(array('token' => $token));
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	$userid = $user['userid'];

	$jwt = GenerateToken($user);
	try{
	$stmt2 =$connect->prepare("UPDATE users SET auth_token = :token WHERE userid = :userid");
	$stmt2->execute(array('token' => $jwt, 'userid' => $userid)); //save the token to db
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

}
elseif(isset($_SESSION['user_id'])){
	$userid = $_SESSION['user_id'];
}
if (isset($userid)){
	$failureid = filter_var($_GET['failureid'], FILTER_SANITIZE_NUMBER_INT);
	$stmt = $connect->prepare("SELECT ischecked FROM failurereports WHERE failureid = :failureid");
	$stmt->execute(array('failureid' => $failureid));
	$failure = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($failure['ischecked'] == 0){
		
		try{
		$stmt = $connect->prepare('UPDATE failurereports SET ischecked = 1 , checkedby = :userid WHERE failureid = :failureid');
		$stmt->execute(array('userid' => $userid,'failureid' => $failureid));
		}catch (PDOException $e) {  echo $e->getMessage();}
		if($stmt){
			echo '<html>Success! Failure event updated to Database</br><a href="managestations.php">Go Back</a></html>';

		}
		else{
			echo 'Something went wrong';
		}
	}
	else{
		echo "This failure has already been checked by another user";
	}
}
else{
	echo "Unable to authenticate user. Please check failure by logging in.";
}

?>