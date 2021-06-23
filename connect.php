<?php
// connection information
$host = '/zstorage/home/ece00753/mysql/run/mysql.sock';
$dbname = 'ptixiaki';
$user = 'root';
$pass = '';
// connect to database or return error
 $connect = new PDO("mysql:unix_socket=$host;dbname=$dbname;charset=utf8", $user,
$pass);
 $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $connect->query('set character_set_client=utf8');
 $connect->query('set character_set_connection=utf8');
 $connect->query('set character_set_results=utf8');
 $connect->query('set character_set_server=utf8');
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 return $connect;


?>