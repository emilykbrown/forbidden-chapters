<?php

$host = "localhost";
$dbName = "forbidden-chapters";
$userName = "root";
$password = "";

try
{
	$con = new PDO("mysql:host={$host};dbname={$dbName}",$userName,$password);
<<<<<<< HEAD
	function create_unique_id() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterlength = strlen($characters);
        $randomString = '';
        for ($i=0; $i < 20; $i++) {
            $randomString .= $characters[mt_rand(0, $characterlength -1)];
        }

        return $randomString;
    }
=======
    // echo uniqid();

	// function create_unique_id() {
    //     // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     // $characterlength = strlen($characters);
    //     // $randomString = '';
    //     // for ($i=0; $i < 20; $i++) {
    //     //     $randomString .= $characters[mt_rand(0, $characterlength -1)];
    //     // }

    //     // return $randomString;

    //         return uniqid();
        
        

    
    
>>>>>>> 17ddd3bd128dcc8f14c3b146569e56b852811057
}

catch(PDOException $e)
{
	echo "Connection error: ".$e->getMessage();
}


?> 