<?php

$level=3;
include('checksession.php');

//put the file path here
$filepath = 'config/config.ini';
//after the form submit
if($_POST){
    $data = $_POST;
    //update ini file, call function
    update_ini_file($data, $filepath);
}
//this is the function going to update your ini file
    function update_ini_file($data, $filepath) { 
        $content = ""; 
        
        //parse the ini file to get the sections
        //parse the ini file using default parse_ini_file() PHP function
        $parsed_ini = parse_ini_file($filepath );
        
        foreach($data as $section=>$values){
            //append the section 
            $content .= "[".$section."]\n"; 
            //append the values
            foreach($values as $key=>$value){
                $content .= $key."=".$value."\n"; 
            }
        }
        
        //write it into file
        if (!$handle = fopen($filepath, 'w')) { 
            return false; 
        }
        $success = fwrite($handle, $content);
        fclose($handle); 
        return $success; 
    }
?>



<?php 
$parsed_ini = parse_ini_file($filepath, true);
$showini = "<form action='' method='post'>";
        
foreach($parsed_ini as $section=>$values){

    $showini .= "<h3>$section</h3>";
    $showini .= "<input type='hidden' value='$section' name='$section' />";
  
    foreach($values as $key=>$value){
        $showini .= "<p>".$key.":<br> <input type='text' name='{$section}[$key]' value='$value' />"."</p>";
    }
    $showini .= "<br>";
}
$showini .= "<input type='submit' value='Update Configurations'>";
echo $showini .= "</form>"

?>

