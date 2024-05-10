<?php

$host = "localhost";
$dbName = "forbidden-chapters";
$userName = "root";
$password = "";

try
{
	$con = new PDO("mysql:host={$host};dbname={$dbName}",$userName,$password);
}

catch(PDOException $e)
{
	echo "Connection error: ".$e->getMessage();
}


?> 