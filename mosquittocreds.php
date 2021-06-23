<?php
require_once('phpMQTT.php');

$server = 'zafora.ece.uowm.gr';     // change if necessary
$port = 45000;                  // change if necessary
$username = 'giannis';                   // set your username
$password = '12345';                   // set your password
$client_id = uniqid(); // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

?>