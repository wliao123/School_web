<?php

$db['db_host'] = "localhost";
$db['db_user'] = "capstonesignup";
$db['db_pass'] = "Liao17";
$db['db_name'] = "capstonesignup";

foreach($db as $key => $value){

    define(strtoupper($key), $value);

}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);


?>