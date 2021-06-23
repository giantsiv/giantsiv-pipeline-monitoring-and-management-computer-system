<?php
$level = 1;
include('checksession.php');


if(isset($_GET['date']) && $_GET['date'] != ''){
	$date = $_GET['date'];
}
else{
	$t=time();
	$date = date("Y-m-d",$t);	
}
include('connect.php');

$limit = 10;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
} 
else{ 
	$page=1;
};  
if (isset($_SESSION['stationid'])){
	$id = $_SESSION['stationid'];
}
else{
	$id = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT);
}
$start_from = ($page-1) * $limit; 
try{
	$stmt = $connect->prepare("SELECT * FROM failurereports f INNER JOIN stations s on f.stationid = s.stationid WHERE f.stationid =:id AND f.timestamp >= DATE(:a1) AND f.timestamp <  DATE(:a2) + INTERVAL 1 DAY ORDER BY f.failureid ASC LIMIT :start, :finish");
	$stmt->execute(array(
		'id' => $id,
		'a1' => $date,
		'a2' => $date,
		'start' => $start_from,
		'finish' => $limit
	));
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
	echo $e;
}

$failuretable = '<p><a class="incontentbutton2" style="margin-top:10px;" href="station.php?selected=Επιλογή&stationid='.$stationid.'">Πίσω στον σταθμό</a><br><table class="contenttable"><caption class="tblcaption">Αναφορές Βλαβών Σταθμού: '.$data[0]['stationname'].' την '.$date.'<form method="get" action=""><input type="date" name="date"><input type="submit" class="incontentbutton2" value="Επιλογή Ημερομηνίας"></form></caption><tr><th>Περιγραφή</th><th>Ελέχθηκε Από</th><th>Timestamp</th></tr>';

if ($data){
	foreach ($data as $report) {
		$stmt2 = $connect->prepare('SELECT firstname, lastname FROM users u WHERE userid = :userid');
		$stmt2->execute(array('userid' => $report['checkedby']));
		$user = $stmt2->fetch(PDO::FETCH_ASSOC);
		if($user){
			$failuretable .= '<tr><td>'.$report['description'].'</td><td>'.$user['firstname'].' '.$user['lastname'].'</td><td>'. $report['timestamp'].'</td></tr>';
		}
		else{
			$failuretable .= '<tr><td>'.$report['description'].'</td><td>Κανέναν</td><td>'. $report['timestamp'].'</td></tr>';
		}
	}
}
else{
	echo "No failure reports found in the system";
}
$failuretable .= '</table>';
echo $failuretable;

$row = $stmt->rowCount();

$total_reports = $row; $total_pages = ceil($total_reports / $limit);
$pagination = "<ul class='pagination'>"; 
for ($i=1; $i<=$total_pages; $i++) {
	$active = '';	 
	if ($page == $i){ 
		$active = 'active'; 
	} 
	$pagination .= "<li><a class='".$active."'href='reporthistory.php?stationid=".$id."&page=".$i."&date=".$date."'>".$i."</a></li>";	
} 
echo $pagination . "</ul>"; 


?>