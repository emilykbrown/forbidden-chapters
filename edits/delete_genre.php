<?php

// Include database
include "config/db.php";

$id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

// Check if ID is set and not empty
if (isset($id)) {

    //echo $id;

    // Make a query
    $query = "DELETE FROM genres WHERE id=?";
    // Prepare query
    $stmt = $con->prepare($query);
    // Bind params
    $stmt->bindParam(1, $id);    
    // Execute query
    $success = $stmt->execute();

    // Return success response
    echo json_encode(['success' => $success]);
    exit();

    if ($stmt->execute()) {
        echo '<div class="alert alert-success" role="alert">
        Record has been successfully deleted!
  </div>';
        header('Refresh:25; URL=http://localhost:8090/cweb1131-project/homework/homework-02');
    } else {
        echo '<div class="alert alert-danger" role="alert">Failed to delete record</div>';
    }

}

// If ID is not set or empty, return failure response
echo json_encode(['success' => false]);

?>