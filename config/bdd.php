<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="computek";

$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>