<?php

if(isset($_POST['add-genre'])) {
    // Set variables
    $genre_id = create_unique_id();
    $genre = $_POST['genre'];

    $query = "INSERT INTO `genres` SET genre_id=:genre_id, genre=:genre";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':genre_id', $genre_id);
    $stmt->bindParam(':genre', $genre);
    $stmt->execute();
}
?>