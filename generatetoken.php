<?php

use \Firebase\JWT\JWT;
function GenerateToken($user){

include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';

header("Access-Control-Allow-Origin: http://localhost/ptest/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$token = array(
   "iss" => $iss,
   "data" => array(
       "username" => $user['username'],
       "password" => $user['password'],
       "id" => $user['userid'],
       "firstname" => $user['firstname'],
       "lastname" => $user['lastname'],
       "email" => $user['email'],
       "timestamp" => time()
   )
);


return $jwt = JWT::encode($token, $key);
}

?>