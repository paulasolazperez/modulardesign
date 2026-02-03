<?php

$host = getenv("mysql.railway.internal");
$user = getenv("root");
$pass = getenv("TyJgMxGDPlopUAINuXXGWeJNLrcNwDCF");
$db = getenv("railway");

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_error){
    die ("Error de conexión: ".$conn->connect_error);
}
?>