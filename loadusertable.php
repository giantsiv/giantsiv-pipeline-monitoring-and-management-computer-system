<?php //Load user list Depending on the user loading it
include('checksession.php');
if ($_SESSION['user_type'] == 2){ //if user is manager
	$auth = 2;
	$type1 = 1;
	$type2 = 0;
}
elseif($_SESSION['user_type'] == 3){ //if user is admin
	$auth = 3;
	$type1=1;
	$type2 = 2;
}
else{ //if user is Technician or malicious throw them out the window
	header('Location :forbidden.html');
	die();
}
include('connect.php');
$stmt = $connect->prepare("SELECT * from users u where u.userid NOT IN (SELECT technicianid FROM assignedtechnicians) AND u.userid NOT IN (SELECT supervisorid FROM assignedsupervisors) AND u.usertype != 3") ;
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usertable3 = '<div id="nonassigned"><p><table id="contenttableuser2" class="contenttableuser1"><caption class="tblcaption">Χρήστες χωρίς ανάθεση</caption><tr><th>Ονοματεπώνυμο</th><th>Τύπος</th><th>Ανάθεση</th><th>Κατάσταση Λογαριασμού</th><th>Επιλογές</th></tr>';
if($data == false){
	$msg = "Δεν βρέθηκαν χρήστες χωρίς ανάθεση";
}
else 
{
	$msg = '';
	foreach ($data as $user) {
		if ($user['usertype'] == 2){
			$usertypestr = 'Manager';
		}
		else{
			$usertypestr = 'Τεχνικός';
			
		}
		if ($user['activeaccount']){
			$active = '<font color="green">	  &#11044;  </font>';
		}
		else{
			$active = '<font color="red">  &#11044;  </font>';
		}
        $userser = serialize($user);
		$usertable3 .= '<tr><td>' . $user['firstname'] . ' ' . $user['lastname'] . '</td><td>' . $usertypestr .'</td><td>Χωρίς ανάθεση</td><td style="width:auto;">'.$active.'</td><td><form method="get" action="useroptions.php"><input type="submit" name="selected" class="incontentbutton2" value="Επιλογή"><input type="hidden" value="'.$user['userid'].'" name="id"></form></td></tr>';
	}
	
	
}
$usertable3 .= '</table></p></div>';
echo $usertable3;
echo $msg;
try {
$stmt = $connect->prepare('SELECT * FROM users u INNER JOIN assignedtechnicians a ON u.userid = a.technicianid INNER JOIN stations s ON a.stationid = s.stationid WHERE `usertype` = :type1 '); //load technicians
$stmt->execute(array(':type1' => $type1));
$userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
$newuserinfo = [];
$newuserkey = [];
$newkey = 0;
foreach ($userinfo as $userkey => $uservalue) {  //in case the user is assigned to more than one posts we have to merge the array in a 2d one
	if(!in_array($uservalue['userid'],$newuserkey)){
		++$newkey;
		$newuserinfo[$newkey]['userid'] = $uservalue['userid'];
		$newuserinfo[$newkey]['usertype'] = $uservalue['usertype'];
		$newuserinfo[$newkey]['activeaccount'] = $uservalue['activeaccount'];
		$newuserinfo[$newkey]['fullname'] = $uservalue['firstname'] . ' ' . $uservalue['lastname']; 
	}
	$newuserinfo[$newkey]['stationassigned'][$userkey] = $uservalue['stationname'];
	$newuserkey[] = $uservalue['userid'];
}
$usertable1 = '<div id="technicians"><p><table id="contenttableuser1" class="contenttable"><caption class="tblcaption">Τεχνικοί</caption><tr><th>Ονοματεπώνυμο</th><th>Τύπος</th><th>Ανάθεση</th><th>Κατάσταση Λογαριασμού</th><th style="width:auto;">Επιλογές</th></tr>';
foreach ($newuserinfo as $user) {
	$usertypestr = 'Τεχνικός';
	$stationassigned = '';
	$count = 0;
	foreach ($user['stationassigned'] as $station) {
		$count++;
		$stationassigned .= $station;
		$size = sizeof($user['stationassigned']);
		if( $size > 1 && $count != $size){
			$stationassigned .= '<font color="red">|</font>';
		}
	}
	if ($user['activeaccount']){
		$active = '<font  color="green">	 &#11044; </font>';
	}
	else{
		$active = '<font color="red"> &#11044; </font>';
	}
	$usertable1 .= '<tr><td>' . $user['fullname'] . '</td><td>' . $usertypestr .'</td><td>'. $stationassigned .'</td><td>'.$active.'</td><td><form method="get" action="useroptions.php"><input type="submit" class="incontentbutton2" name="selected" value="Επιλογή"><input type="hidden" value="'.$user['userid'].'" name="id"></form></td></tr>';
}
$usertable1 .= '</table></p></div>';
echo $usertable1;

} catch (PDOException $e) { echo $e->getMessage();}

if ($auth == 3){ //if user is admin also display managers on a second table
$stmt = $connect->prepare('SELECT * FROM users u INNER JOIN assignedsupervisors a ON u.userid = a.supervisorid INNER JOIN regions r ON a.regionid = r.regionid WHERE `usertype` = :type2 ');
$stmt->execute(array(':type2' => $type2));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usertable2 = '<div id="managers"><p><table id="contenttableuser3" class="contenttable"><caption class="tblcaption">Managers</caption><tr><th>Ονοματεπώνυμο</th><th>Τύπος</th><th>Ανάθεση</th><th>Κατάσταση Λογαριασμού</th><th>Επιλογές</th></tr>';
if($data == false){
	echo "No assigned managers found in the system";
}
else 
{
	foreach ($data as $user) {
		$usertypestr = 'Manager';
		$regionassigned = $user['regionname']; //name here refers to the region name 
		
		if ($user['activeaccount']){
			$active = '<font color="green">	 &#11044; </font>';
		}
		else{
			$active = '<font color="red"> &#11044; </font>';
		}
		$usertable2 .= '<tr><td>' . $user['firstname'] . ' ' . $user['lastname'] . '</td><td>' . $usertypestr .'</td><td>'. $regionassigned .'</td><td>'.$active.'</td><td><form method="get" action="useroptions.php"><input type="submit" name="selected" class="incontentbutton2" value="Επιλογή"><input type="hidden" value="'.$user['userid'].'" name="id"></form></td></tr>';
	}
	$usertable2 .= '</table></p></div>';
	echo $usertable2;
}
}
?>