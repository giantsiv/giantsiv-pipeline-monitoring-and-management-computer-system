<?php

include ('connect.php');
if (isset($_POST['submit']))
{

$username =  filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password =  filter_var($_POST['password'], FILTER_SANITIZE_STRING);

}
if (isset($username) && isset($password)){
session_start();
try {
	$stmt = $connect->prepare('SELECT userid, firstname, lastname, username, password, usertype, activeaccount, failedlogins FROM users WHERE username = :username');
	$stmt->execute(array(
		':username' => $username
		));
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if($data == false){ //username not in the system
		$_SESSION['error'] = "User $username not found.";
		header('Location: index.php');
	}
	else 
	{
		if($data['failedlogins'] < 3 && $data['activeaccount'] == 1){ //+ this attempt, blocks account
			if(password_verify($password,$data['password'])) 
			{ //check password
				$_SESSION['loggedin'] = true;
				$userid = $data['userid'];
				$_SESSION['user_id'] = $userid;
				$_SESSION["user_type"] = $data['usertype']; 
				$_SESSION['full_name'] = $data['firstname'].' '.$data['lastname'];
 				//$_SESSION["active"] = $data['activeaccount'];
 				$stmt = $connect->prepare("UPDATE users SET failedlogins=0 WHERE userid=:userid");
				$stmt->execute(array('userid' => $data['userid'])); //set failed login attempts to zero
 				if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
 					echo '<input type="hidden" value="'.$userid.'" id="userid">
						    <script>
						      window.addEventListener("load", function(){
						        var id = document.getElementById("userid").value;
						        Android.getid(id);
						        window.location.href = "managestations.php";
						      });
						    </script>';

 				}
				else{
					header('Location: managestations.php');
				}
			}
			else
			{
				$attempts_rem = 3 - $data['failedlogins'];
				$_SESSION['error'] = 'Password incorrect.<br><b>' . $attempts_rem . '</b> attempts remaining.' ;
				$stmt = $connect->prepare("UPDATE users SET failedlogins=failedlogins+1 WHERE userid=:userid");
				$stmt->execute(array('userid' => $data['userid']));
				header('Location: index.php');
				exit;
			}
		}
		elseif($data['failedlogins'] == 3 && $data['activeaccount'] == 1){
			$stmt = $connect->prepare("UPDATE users SET activeaccount=0, failedlogins=0 WHERE userid=:userid");
			$stmt->execute(array('userid' => $data['userid']));
			$_SESSION['error'] = 'Your account has been deactivated <br> after 4 failed login attempts.<br>Please contact the system Administrator';
			header('Location: index.php');
		}
		else{
			$_SESSION['error'] = 'Your account has been deactivated,please contact system administrator';
			header('Location: index.php');
		}
				
	}
}
catch(PDOException $ex) {
	$msg = $ex->getMessage();
}
}
else{
	//header(string)
}


