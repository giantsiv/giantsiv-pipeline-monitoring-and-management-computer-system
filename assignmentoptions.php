<?php
$level = 2;
include('checksession.php');
include('connect.php');
$userid = $selecteduserid;
if ($selectedusertype == 1){ //if user is technician do
	$stmt = $connect->prepare("SELECT * FROM users u INNER JOIN assignedtechnicians t on u.userid = t.technicianid INNER JOIN stations s on t.stationid = s.stationid WHERE u.userid = :userid ") ;
	$stmt->execute(array(':userid' => $userid));
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$limid[''] = '';
	if ($data != NULL){ //if technician is assigned
		$options = '<h3>Έχει ανατεθεί πόστο στον τεχνικό</br>για ακύρωση ανάθεσης πατήστε εδώ</h3><form method="get" action="unassignusers.php">Επιλέξτε το πόστο που θέλετε να ακυρώσετε την ανάθεση<input type="hidden" name="untechnicianid" value="'.$userid.'"><p class="customp">Πόστο:<select class="newinput" name="assignmentid"><option selected disabled>Επιλογή σταθμού</option>';
		
		$i = 0;
		foreach ($data as $assignment) {
			++$id;
			$limid[$id] = $assignment['stationid']; //used later to display only the posts that the user is not assigned to
			$options .= '<option value="'.$assignment['stationid'].'">'.$assignment['stationname'].'</option> ';
		}
		$options .= '</select></p><input type="submit" class="incontentbutton2" name="submit" value="Ακύρωση Ανάθεσης"></form>';
	}
	$stmt1 = $connect->prepare('SELECT * FROM stations');
	$stmt1->execute();
	$data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	$options2 = '<h3>Ανάθεση του τεχνικού σε πόστο</br>Επιλέξτε πόστο</h3><form method="get" action="assignedusers.php"><input type="hidden" name="technicianid" value="'.$userid.'"><p class="customp">Πόστο:<select class="newinput" name="stationtoassign"><option selected disabled>Επιλογή σταθμού</option>';
	
	//if (sizeof($limid) != 0){
	foreach ($data1 as $station) {

		$flag = 0;
		if (sizeof($limid) != 0){
			foreach ($limid as $id) {
				if ($id == $station['stationid']){
					$flag = 1;
				}
			}
		}
		if ($flag == 0){
				$options2 .= '<option value="'.$station['stationid'].'">'.$station['stationname'].'</option>';
		}

	}
	$options2 .= '</select></p><input type="submit" class="incontentbutton2" name="submit" value="Ανάθεση"></form>'; 
//}
}
elseif($selectedusertype == 2){ // if user is manager do 
	$stmt = $connect->prepare("SELECT * FROM users u INNER JOIN assignedsupervisors s on u.userid = s.supervisorid  WHERE u.userid = :userid ") ;
	$stmt->execute(array(':userid' => $userid));
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if ($data != NULL){ //if manager is assigned
		$options = '<h3>Αυτός ο manager έχει ανατεθεί σε πόστο</br>πατήστε εδώ για να ακυρώσετε την ανάθεση</h3><form method="get" action="unassignusers.php"><input type="hidden" name="unsupervisorid" value="'.$userid.'"><input type="submit" class="incontentbutton2" name="submit" value="Ακύρωση Ανάθεσης"></form>';
	}
	else{ //if manager is unassigned
		$stmt2 = $connect->prepare('SELECT * FROM regions');
		$stmt2->execute();
		$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$options = '<h3>Αυτός ο manager δεν έχει ανατεθεί σε πόστο</br>Επιλέξτε ένα για ανάθεση</h3><form method="get" action="assignedusers.php"><input type="hidden" name="supervisorid" value="'.$userid.'"><select class="newinput" name="regiontoassign">';
		foreach ($data2 as $region) {
			$options .= '<option value="'.$region['regionid'].'">'.$region['regionname'].'</option>';
		}
		$options .= '</select><input type="submit" class="incontentbutton2" name="submit" value="Ανάθεση"></form>';
	}
}
echo $options;
echo $options2;
?>
