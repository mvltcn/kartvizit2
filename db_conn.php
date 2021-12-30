<?php

$sname= "localhost";
$usname= "root";
$password = "";

$db_name = "kartvizit";

$conn = mysqli_connect($sname, $usname, $password, $db_name);

if (!$conn) {
	echo "Bağlantı hatası!";
}
?>