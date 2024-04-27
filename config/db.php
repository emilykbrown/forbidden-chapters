<?php

$host = "localhost";
$dbName = "forbidden-chapters";
$userName = "root";
$password = "";

try
{
	$con = new PDO("mysql:host={$host};dbname={$dbName}",$userName,$password);
    // echo uniqid();

	function create_unique_id() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterlength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < 20; $i++) {
            $randomString .= $characters[mt_rand(0, $characterlength -1)];
        }

        return $randomString;

    }
    
}

catch(PDOException $e)
{
	echo "Connection error: ".$e->getMessage();
}


?> 