<?php
include('checksession.php');
session_start();
if  (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	//if (!$_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
			$rendertop = '<div class="header"><p class="logo">N.G.P.M.S.</p>';
	//}
}
$usertype = $_SESSION['user_type'];
if($usertype == 1){ // if user is technician
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
			$rendertop .= 	
						'<div class="header"><div class="dropdown">
						<button class="dropbtn">
						☰
						</button>
						<div class="dropdown-content">
						<a href="managestations.php" class="headbutton">Σταθμοί</a>
						<a href="accountpref.php" class="headbutton">Επιλογές Λογαριασμού</a>
					    </div></div>
						<p class="logo">N.G.P.M.S.</p>
						<a href="logout.php" style="font-weight:bold; color:white;"  class="headbutton">Log Out</a></div>';
		}
	}
	else{
		$rendertop .= '<a href="managestations.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-cube"></i>Σταθμοί</a>
					   <a href="accountpref.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-user"></i>Επιλογές Λογαριασμού</a>
					   <a href="logout.php"  class="headbutton"><i style="margin-right: 4px;" class="fa fa-sign-out"></i>Log Out</a></div>';
	}
}
elseif($usertype == 2)
	{ //if user is manager
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){	
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
			$rendertop .= 	
						'<div class="header"><div class="dropdown">
						<button class="dropbtn">
						☰
						</button>
						<div class="dropdown-content">
						<a href="managestations.php" class="headbutton">Σταθμοί</a>
						<a href="manageusers.php" class="headbutton">Τεχνικοί</a>
						<a href="accountpref.php" class="headbutton">Επιλογές Λογαριασμού</a>
					    </div></div>
						<p class="logo">N.G.P.M.S.</p>
						<a href="logout.php" style="font-weight:bold; color:white;"  class="headbutton">Log Out</a></div>';

		}
	}
	else
	{
		$rendertop .= '<a href="manageusers.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-users"></i>Τεχνικοί</a>
					   <a href="managestations.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-cube"></i>Σταθμοί</a>
					   <a href="accountpref.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-user"></i>Επιλογές Λογαριασμού</a>
					   <a href="logout.php"  class="headbutton"><i style="margin-right: 4px;" class="fa fa-sign-out"></i>Log Out</a></div>';
	}

}
elseif($usertype == 3){ //if user is admin
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
			$rendertop .= 	
						'<div class="header"><div class="dropdown">
						<button class="dropbtn">
						☰
						</button>
						<div class="dropdown-content"><a href="manageusers.php" class="headbutton">Χρήστες</a>
						
						<a  href="managestations.php" class="headbutton">Σταθμοί</a>
						<a  href="manageregions.php" class="headbutton">Περιφέρειες</a>
						<a  href="accountpref.php" class="headbutton">Επιλογές Λογαριασμού</a>
						<a  href="systemsettings.php" class="headbutton">Ρυθμίσεις Συστήματος</a></div></div>
						<p class="logo">N.G.P.M.S.</p>
						<a href="logout.php" style="font-weight:bold; color:white;"  class="headbutton">Log Out</a></div>';
		} 
	}
	else {
		$rendertop .= 	
					'
					
					<a  href="manageusers.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-users"></i>Χρήστες</a>
					<a  href="managestations.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-cube"></i>Σταθμοί</a>
					<a href="manageregions.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-cubes"></i>Περιφέρειες</a>
					<a href="systemsettings.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-cogs"></i>Ρυθμίσεις Συστήματος</a>
					<a href="accountpref.php" class="headbutton"><i style="margin-right: 4px;" class="fa fa-user"></i>Επιλογές Λογαριασμού</a>
					<a href="logout.php"  class="headbutton"><i style="margin-right: 4px;" class="fa fa-sign-out"></i>Log Out</a></div>
					';
	}
	
	

}
else{

}
//$rendertop .='</div>';
echo $rendertop;
?>