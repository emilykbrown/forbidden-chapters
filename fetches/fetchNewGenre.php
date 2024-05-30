<?php

include 'config/db.php'; 
include 'config/variables.php'; 

$validCheck = 0;

if(isset($_POST['add-genre'])) {

    // Set variables
    $genre_id = uniqid();
    $genre = $_POST['genre'];

    if (empty($genre)) {
        $genreError = "Enter genre";
    } elseif (!preg_match($nameRegex, $genre)) {
        $genreError = "Invalid first name";
    } else {
        $validCheck += 1;
    }
    
    if ($validCheck == 1) {
        $query = "INSERT INTO `genres` SET genre_id=:genre_id, genre=:genre";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':genre_id', $genre_id);
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();

    }

}
?>