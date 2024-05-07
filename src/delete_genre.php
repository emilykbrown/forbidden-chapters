<?php
// Include database configuration
include "../config/db.php";

// Check if genre_id is set in the URL
if(isset($_GET['genre_id'])) {
    // Get the ID of the row you want to delete
    $genre_id = $_GET['genre_id'];
    
    // Construct the SQL query to delete the row
    $sql = "DELETE FROM genre WHERE genre_id = $genre_id";

    // Execute the query
    if ($conn) { // Check if connection is established
        if (mysqli_query($conn, $sql)) {
            echo "Row deleted successfully";
        } else {
            echo "Error deleting row: " . mysqli_error($conn);
        }
    } else {
        echo "Database connection failed!";
    }
} else {
    echo "genre_id parameter not set in the URL";
}

// Close the database connection (if required)
mysqli_close($conn);
?>
