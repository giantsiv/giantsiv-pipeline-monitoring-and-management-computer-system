<?php
$level=2;
include('checksession.php');
 // THis script determines the options for adding new user. Admin can add all types of users, manager can only add technicians. Any other user gets thrown to the login page.

$optionsmenu = '<select class="newinput" name="newusertype">';
if ($_SESSION['user_type'] == 3){ //if user is admin
	$optionsmenu .= '<option class="newinput" value="1">Τεχνικός</option><option class="newinput" value="2">Manager</option><option class="newinput" value="3">System Administrator</option>';
}
elseif ($_SESSION['user_type'] == 2){ //if user is Manager 
	$optionsmenu .= '<option class="newinput" value="1">Τεχνικός</option>';
}
else{
	header('Location: index.php');
}
$optionsmenu .= '</select>Επιλογή τύπου χρήστη';
echo $optionsmenu;
?>