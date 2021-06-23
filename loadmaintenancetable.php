<?php
$level = 1;
include('checksession.php');
include('connect.php');
if ($_SESSION['user_type'] == 1){
	$stationid = $_SESSION['stationid'];
}
else{
	$stationid = filter_var($_GET['stationid'], FILTER_SANITIZE_NUMBER_INT);
}
if(isset($_GET['date']) && $_GET['date'] != ''){
	$date = $_GET['date'];
}
else{
	$t=time();
	$date = date("Y-m-d",$t);	
}

$limit = 10;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
} 
else{ 
	$page=1;
};  
$start_from = ($page-1) * $limit; 

$stmt = $connect->prepare('SELECT * FROM stationmaintenance m INNER JOIN stations s on m.stationid = s.stationid INNER JOIN users u on m.technicianid = u.userid WHERE m.stationid = :stationid AND `timestamp` >= DATE(:a1) AND `timestamp` <  DATE(:a2) + INTERVAL 1 DAY ORDER BY reportid ASC LIMIT :start, :finish');
$stmt->execute(array(
	'stationid' => $stationid,
	'a1' => $date,
	'a2' => $date,
	'start' => $start_from,
	'finish' => $limit
));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$reporttable = '<p><table class="contenttable"><caption class="tblcaption">Αναφορές Συστήρησης Σταθμού: '.$data[0]['stationname'].' την '.$date.'<form method="get" action=""><input type="date" name="date"><input type="submit" class="incontentbutton2" value="Επιλογή Ημερομηνίας"></form></caption><tr><th>Όνομα Τεχνικού</th><th>Σχόλια</th><th>Timestamp</th></tr>';
if ($data == false){
	$_SESSION['error'] = "No maintenance reports found in the system for this date";
	$reporttable .= '</table></p>';
	echo $reporttable;
}
else{
	foreach ($data as $report) {
		$reporttable .= '<tr><td>' . $report['firstname'] .' '. $report['lastname'] . '</td><td>' . $report['comments'] . '</td><td>'.$report['timestamp'].'</td></tr>';
	}
	$reporttable .= '</table></p>';
	echo $reporttable;

	$stmt =$connect->prepare('SELECT reportid FROM stationmaintenance m INNER JOIN stations s on m.stationid = s.stationid INNER JOIN users u on m.technicianid = u.userid WHERE m.stationid = :stationid AND `timestamp` >= DATE(:a1) AND `timestamp` <  DATE(:a2) + INTERVAL 1 DAY');
	$stmt->execute(array(
			'stationid' => $stationid,
			'a1' => $date,
			'a2' => $date,
));
	$row = $stmt->rowCount();
	
    $total_reports = $row;
	$total_pages = ceil($total_reports / $limit);
	$pagination = "<ul class='pagination'>";
	for ($i=1; $i<=$total_pages; $i++) {
			$active = '';	
			if ($page == $i){
				$active = 'active';
			}
            $pagination .= "<li><a class='".$active."' href='maintenancereport.php?page=".$i."&date=".$date."'>".$i."</a></li>";	
	}
	echo $pagination . "</ul>"; 
}


?>

