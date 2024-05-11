<?php

// Include database configuration
include '../config/db.php';

// Include variables
include '../config/variables.php';


// Check if author_id parameter is provided in the URL
$author_id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

if (isset($author_id)) {
        // Fetch author details
    $query = "SELECT author_id, author_fname, author_lname FROM authors WHERE author_id= ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $author_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);

} else {
    header("Location: authors.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit-author'])) {
        // Check if genre is set in POST data
       if(isset($_POST['author_fname'])){
            $validCheck = 0;
            $author_fname = htmlspecialchars($_POST['author_fname']);
            $author_lname = htmlspecialchars($_POST['author_lname']);
            
            if (empty($author_fname)) {
                $author_fnameError = "Enter first name";
            } elseif (!preg_match($nameRegex, $author_fname)) {
                $author_fnameError = "Invalid first name";
            } else {
                $validCheck += 1;
            }

            if (empty($author_lname)) {
                $author_lnameError = "Enter last name";
            } elseif (!preg_match($nameRegex, $author_lname)) {
                $author_lnameError = "Invalid last name";
            } else {
                $validCheck += 1;
            } 
        } else {
            $authorError = "Author is required";
        }

        // If validation passes, update author
        if ($validCheck == 2) {
            // Prepare update query
            $query = "UPDATE authors SET author_fname=:author_fname, author_lname=:author_lname WHERE author_id=:author_id";
            $stmt = $con->prepare($query);
            // Bind parameters
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':author_fname', $author_fname);
            $stmt->bindParam(':author_lname', $author_lname);

            // Execute query
            if ($stmt->execute()) {
                echo 'Author updated!';
            } else {
                echo 'Failed to update!';
            }
        }
    }
}

?>