<?php

// Include database
include "../config/db.php";

$genre_id = isset($_GET['genre_id']) ? $_GET['genre_id'] : die('No ID Found!');

// Check if ID is set and not empty
if (isset($genre_id)) {

    //echo $genre_id;

    // Make a query
    $query = "DELETE FROM genres WHERE genre_id=?";
    // Prepare query
    $stmt = $con->prepare($query);
    // Bind params
    $stmt->bindParam(1, $genre_id);    
    // Execute query
    $success = $stmt->execute();

    // Return success response
    echo json_encode(['success' => $success]);
    exit();

    if ($stmt->execute()) {
        echo "Yay";
    } else {
        echo "Nope";
    }

}

// If ID is not set or empty, return failure response
echo json_encode(['success' => false]);

?>