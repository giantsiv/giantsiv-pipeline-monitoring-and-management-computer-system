<?php //this script sets all regions as options for new station to be assigned to
include('checksession.php');
include('connect.php');
$stmt = $connect->prepare("SELECT * FROM regions") ;
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$regionoptions = '<select class="newinput" name="newstationassign" required>';
foreach ($data as $region) {
	$regionoptions .= '<option class="newinput" value="'.$region['regionid'].'">'.$region['regionname'].'</option>';
}
$regionoptions .='</select>';
echo $regionoptions;
?>