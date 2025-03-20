<?php
$servername = "172.28.65.8";
$username = "computek";
$password = "";
$dbname="computek";

$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>