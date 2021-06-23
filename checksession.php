<?php //Check if user has logged in 

/*if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}*/
include('redirecthttps.php');
error_reporting(E_ALL & ~E_NOTICE);//E_ALL & ~E_NOTICE
session_start();

$ini = parse_ini_file('config/config.ini');

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*$ini['session_timeout'])) {
    header('Location: logout.php');
    die();
}
$_SESSION['LAST_ACTIVITY'] = time();


if($_SESSION['loggedin'] == true){ //if not redirect to login page 
	//echo "good!" . $_SESSION['user_id'];
}
else{
	header('Location: index.php') or die();
	
}




if($level == 1){

}
elseif ($level == 2) {
	if($_SESSION['user_type'] == 1){
		header('Location: forbidden.html') or die();
		
	}
}
elseif ($level == 3) {
	if($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 1){
		header('Location: forbidden.html') or die();
		
	}
}
?>