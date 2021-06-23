<?php
include('checksession.php');

$filepath = 'config/config.ini';
//after the form submit





if($_POST){
  $data = $_POST;
  //update ini file, call function
  update_ini_file($data, $filepath);
}

function update_ini_file($data, $filepath) { 
     
    
    
    foreach ($data as $key => $val) {
        foreach ($val as $value => $values) {
        $file = 'config/config.ini';
        //print_r($val);
        $file_contents = file_get_contents($file);
        $old = $value.'='.$values['old'];
        $new = $value.'='.$values['new'];
        $file_contents = str_replace($old,$new,$file_contents);
        file_put_contents($file,$file_contents);
        }

    }
    return; 
}



include('parser.php');
$data = parseconfig();
$showini = "<form action='' method='post'><div style='padding-right:8px;' class='child1'>";



foreach($data as $row=>$rows){
	if (!isset($rows['value'])){
		$section = $rows['valname'];
		$section = trim($section, '[]');
		$showini .= '</div><div class="child1">';
		$showini .= "<h3>$section</h3>";
    	$showini .= "<input type='hidden' value='$section' name='$section' />";
        if ($section == 'Προεπιλεγμένα Όρια'){
            $flag = true;
        }
        else{
            $flag = false;
        }
	}
	else{
        $key = $rows['valname'];
        if ($flag == true && $key == 'lower_temperature_limit'){
            $limit = 'max="127" min="-127" style="min-width:100%;"';
        }
        elseif($flag == true && $key != 'lower_temperature_limit'){
            $limit = 'max="254" min="0" style="min-width:100%;"';
        }
        else{
            $limit = '';
        }
		$key = $rows['valname'];
		$value = $rows['value'];
		$comments = $rows['comment'];
		$showini .= "<div class='setting-row'><div class='help-tip'><p>".$comments." </p></div><p>".$key.": <br><input type='number'".$limit."  class='newinput' name='{$section}[$key][new]' value='$value' /><input type='hidden' name='{$section}[$key][old]' value='$value' />"."</p></div>";
	}







}
/*
    if(($i % 2 == 0) && ($i != 0)){
      $showini .= '</div><div class="child1">';
    }
    $showini .= "<h3>$section</h3>";
    $showini .= "<input type='hidden' value='$section' name='$section' />";
      
    foreach($values as $key=>$value){
        $showini .= "<p>".$key.":<br> <input type='text' name='{$section}[$key]' value='$value' />"."</p>";
    }
    $showini .= "<br>";
    $i++;
}*/
$showini .= "<input type='submit' class='incontentbutton2' style='float:left; position:relative;' value='Ενημέρωση'></div>";
echo $showini .= "</form>"

?>
