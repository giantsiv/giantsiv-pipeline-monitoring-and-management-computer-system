<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms") {
	$footer = '';
}
else{
	$fullname = $_SESSION['full_name'];
	$footer = '<div class="bottom-logo">
	<div class="bottom-logot-area1"><b>Ανάπτυξη Συστήματος</b><br>Tsivelis Ioannis</div>
	<div class="bottom-logot-area2">Logged in as:'.$fullname.'<br>UOWM&copy; All Rights Reserved 2020</div>
	<div class="bottom-logot-area3"><b>Επιβλέποντες</b><br>Minas Dasigenis<br>Dimitris Ziouzios</div></div>';
}
echo $footer;