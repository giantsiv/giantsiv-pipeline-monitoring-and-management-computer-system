<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	if($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.example.ngpms"){
		
	}
}
elseif(isset($_SERVER['REQUEST_URI'])){
	if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
		$redirect = "https://".$_SERVER['HTTP_HOST'].$SERVER['REQUEST_URI'];
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $redirect");
		die();
	}
}
?>