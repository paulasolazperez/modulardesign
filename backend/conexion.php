<?php

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db = getenv("MYSQLDATABASE");

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_error){
    die ("Error de conexión: ".$conn->connect_error);
}
?>