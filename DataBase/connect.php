<?php
require_once("config/config.php");
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;  
$con = new mysqli($host,$user,$pass,$dbname);

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>

