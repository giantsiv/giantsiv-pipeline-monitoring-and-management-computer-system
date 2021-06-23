<?php
$level = 2;
include('checksession.php');
include('connect.php');
$stmt = $connect->prepare("SELECT * from users u where u.userid NOT IN (SELECT technicianid FROM assignedtechnicians) AND u.userid NOT IN (SELECT supervisorid FROM assignedsupervisors)") ;
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$usertable3 = '<div><p><table class="contenttable"><caption class="tblcaption">Χρήστες χωρίς πόστο</caption><tr><th>Ονοματεπώνυμο</th><th>Τύπος Χρήστη</th><th style="width:50px;">Κατάσταση λογαριασμού</th><th style="width:100px;">Options</th></tr>';
if($data == false){
	echo $msg = "No users found in the system";
}
else 
{
	foreach ($data as $user) {
		if ($user['usertype'] == 2){
			$usertypestr = 'Manager';
		}
		else{
			$usertypestr = 'Τεχνικός';
			
		}
		if ($user['activeaccount']){
			$active = '<font size="20px;" color="green">	&bull;</font>';
		}
		else{
			$active = '<font size="20px;" color="red">&bull;</font>';
		}
        $userser = serialize($user);
		$usertable3 .= '<tr><td>' . $user['firstname'] . ' ' . $user['lastname'] . '</td><td>' . $usertypestr .'</td><td style="width:50px;">'.$active.'</td><td style="width:100px;"><form method="get" action="useroptions.php"><input type="submit" name="selected" value="Επιλογή"><input type="hidden" value="'.$user['userid'].'" name="id"></form></td></tr>';
	}
	$usertable3 .= '</table></p></div>';
	echo $usertable3;
}
?>