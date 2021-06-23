<?php
session_start();
if (isset($_SESSION['error'])){
echo '<div class="error"><b>'.$_SESSION['error'] .'</b></div>';
 //after the report has been displayed, clean the variable
$_SESSION['error'] = '';
}

?>