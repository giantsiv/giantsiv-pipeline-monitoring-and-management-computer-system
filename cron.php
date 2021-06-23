<?php
//this file is run by the server crontab
//used to declare the functions to be run 
include('backgroundchecks.php');
checkstationtransmission(); //check if stations sent data in time
checkupdatestate(); //check if stations recieved update. if not resend
return;
?>