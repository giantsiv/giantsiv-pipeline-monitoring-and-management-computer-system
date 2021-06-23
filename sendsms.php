<?php
function SendSms($telephone, $description){
	$url = 'http://vlsi.gr/sms/webservice/process.php';
	$data = array('authcode' => '546743', 'mobilenr' => $telephone, 'message'=> $description);
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context); //send SMS
	if ($result === FALSE) { /* Handle error */ 
	}
	var_dump($result);
}
?>
