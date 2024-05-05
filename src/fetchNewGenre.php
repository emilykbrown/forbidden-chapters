<?php

include 'variables.php'; 

$validCheck = 0; 

if(isset($_POST['add-genre'])) {

    $genre = htmlspecialchars($_POST['genre']);

    if (empty($genre)) {
        $genreError = "Enter genre";
    } elseif (!preg_match($textRegex, $genre)) {
        $genreError = "Invalid genre";
    } else {
        $validCheck += 1;
    }
<<<<<<< HEAD

    if ($validCheck == 1) { // Changed to 1
        $genre_id = create_unique_id();
=======
    // Set variables
    $genre = $_POST['genre'];

    if ($validCheck == 1) {
>>>>>>> 17ddd3bd128dcc8f14c3b146569e56b852811057
    
        $query = "INSERT INTO `genres` SET genre=:genre";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':genre', $genre);

        if ($stmt->execute()) {
            // Success
        } else {
            // Handle database error
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>
