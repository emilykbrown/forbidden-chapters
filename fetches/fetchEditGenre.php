<?php

// Include database configuration
include '../config/db.php';

// Include variables
include '../config/variables.php';

// Check if genre_id parameter is provided in the URL
$genre_id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

if (isset($genre_id)) {

    // Feptch genre record
    $query = "SELECT genre_id, genre FROM genres WHERE genre_id= ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $genre_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);

} else {
    header("Location: genres.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit-genre'])) {
        // Check if genre is set in POST data
        if (isset($_POST['genre'])) {
            $validCheck = 0;
            $genre = htmlspecialchars($_POST['genre']);

            if (empty($genre)) {
                $genreError = "Enter genre";
            } elseif (!preg_match($textRegex, $genre)) {
                $genreError = "Invalid genre";
            } else {
                // Set validCheck to 1 if all validations pass
                $validCheck += 1;
            }
        } else {
            // Handle case where genre is not set in POST data
            $genreError = "Genre is required";
        }

        if ($validCheck == 1) {
            // Prepare update query
            $query = "UPDATE genres SET genre=:genre WHERE genre_id=:genre_id";
            $stmt = $con->prepare($query);
            // Bind parameters
            $stmt->bindParam(':genre_id', $genre_id);
            $stmt->bindParam(':genre', $genre);
            $success = $stmt->execute();

            if ($success) {
                echo '<div class="alert alert-success" role="alert">
        Genre has been successfully updated </div>';
                header('Refresh:25; URL=http://localhost:8090/forbidden-chapters/genres.php');
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to delete record</div>';
            }

        }
    }
}

?>