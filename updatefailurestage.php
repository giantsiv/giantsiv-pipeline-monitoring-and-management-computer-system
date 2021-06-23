<?php
function updatefailurestage($failureid, $stage){
	echo "trying to update stage...\n";
	include('connect.php');
	$stage++;
	$stmt = $connect->prepare('UPDATE failurereports SET stage=:stage WHERE failureid=:failudeid');
	$stmt->execute(array(
		'stage' => $stage,
		'failudeid' => $failureid
	));
	$count = $stmt->rowCount();
	if($count == '0'){
		echo "failed to update stage\n";
		return FALSE;
	}
	else{
		echo "success in updating stage\n";
		return TRUE;
	}
}
?>