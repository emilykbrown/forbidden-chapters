<?php

echo"hi";

include 'config/db.php';

include 'variables.php'; 
$validCheck = 0; 

$genre_id = isset($_GET['genre_id']) ? $_GET['genre_id'] : die('No ID Found!');

if (isset($genre_id)) {

    // Make a query
    $query = "SELECT genre_id, genre FROM student_records WHERE genre_id= ?";
    // Prepare query
    $stmt = $con->prepare($query);
    // Bind params
    $stmt->bindParam(1, $genre_id);
    // Execute query
    $stmt->execute();
    // Store the data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Extract variables
    extract($row);

} else {
    // Redirect if IcD paramter is not provided
    header("Location: genres.php");
    exit();
}
  


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $genre = htmlspecialchars($_POST['genre']);

    if (empty($genre)) {
        $genreError = "Enter genre";
    } elseif (!preg_match($nameRegex, $genre)) {
        $genreError = "Invalid first name";
    } else {
        $validCheck += 1;
    }
    // // Set variables
    // $genre_id = create_unique_id();
    // $genre = $_POST['genre'];

    if ($validCheck == 1) {
        $genre_id = create_unique_id();
    
        $query = "UPDATE `genres` SET genre_id=:genre_id, genre=:genre";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':genre_id', $genre_id);
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();

        if ($stmt->execute()) {
            echo 'Genre update!';
        } else {
            echo 'Failed to update!';
        }

    }
}