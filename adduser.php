<?php //Add new user  FINISHED
$level =2;
include('checksession.php');
require('generatetoken.php');
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['newusertype'])){
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$telephone = filter_var($_POST['telephone'] ,FILTER_SANITIZE_NUMBER_INT);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
$usertype = filter_var($_POST['newusertype'] ,FILTER_SANITIZE_NUMBER_INT);
$password = password_hash($password, PASSWORD_BCRYPT);
include('connect.php');
$newuser = [
'username' => $username,
'password' => $password,
'telephone' => $telephone,
'email' => $email,
'firstname' => $firstname,
'lastname' => $lastname,
'usertype' => $usertype
];





$stmt = $connect->prepare("INSERT INTO users (username, password, telephone, email, firstname, lastname, usertype) VALUES (:username, :password, :telephone, :email, :firstname, :lastname,  :usertype) "); //add user to db
$stmt->execute($newuser);

$id = $connect->LastInsertId(); //get his id to generate the token

$newuser['userid'] = $id;
//var_dump($newuser);
$jwt = GenerateToken($newuser);
try{
$stmt2 =$connect->prepare("UPDATE users SET auth_token = :token WHERE userid = :userid");
$stmt2->execute(array('token' => $jwt, 'userid' => $id)); //save the token to db
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

if($stmt && $stmt2){
	header('Location: manageusers.php');
}

}
else{
	header('Location: manageusers.php');
}
?>