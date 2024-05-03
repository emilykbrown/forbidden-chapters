<?php

include 'variables.php'; 

$validCheck = 0; 

if(isset($_POST['add-genre'])) {

    $genre = htmlspecialchars($_POST['genre']);

    if (empty($genre)) {
        $genreError = "Enter genre";
    } elseif (!preg_match($nameRegex, $genre)) {
        $genreError = "Invalid first name";
    } else {
        $validCheck += 1;
    }
    // Set variables
    $genre = $_POST['genre'];

    if ($validCheck == 1) {
    
        $query = "INSERT INTO `genres` SET genre=:genre";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();

    }
}
?>