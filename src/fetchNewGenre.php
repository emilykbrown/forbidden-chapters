<?php

include 'variables.php'; 


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
    $genre_id = create_unique_id();
    $genre = $_POST['genre'];

    if ($validCheck == 1) {
        $genre_id = create_unique_id();
    
        $query = "INSERT INTO `genres` SET genre_id=:genre_id, genre=:genre";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':genre_id', $genre_id);
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();

    }

}
?>