<?php
function parseconfig(){
	$txt_file    = file_get_contents('config/config.ini');
	$rows        = explode("\n", $txt_file);
	array_shift($rows);
	
	foreach($rows as $row => $data)
	{
		$rowdata = preg_split('/[=;]/', $data);
		
		$i[$row]['valname'] = $rowdata[0];
		if($rowdata[1] != ''){
			$i[$row]['value'] = $rowdata[1];
			$i[$row]['comment'] = $rowdata[2];
		}
	}
	return $i;
	
}
?>