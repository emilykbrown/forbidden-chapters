<?php
// Include database
include "../config/db.php";

// Check if ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $book_id = $_GET['id'];

    try {
        // Prepare and execute the DELETE query
        $query = "DELETE FROM books WHERE book_id=?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $book_id);
        
    } catch (Exception $e) {
        // Handle exceptions (e.g., database errors)
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit(); // Stop script execution
    }
} else {
    // If ID is not provided or empty, return failure response
    echo json_encode(['success' => false, 'error' => 'No ID found in the request.']);
    exit(); // Stop script execution
}
?>
