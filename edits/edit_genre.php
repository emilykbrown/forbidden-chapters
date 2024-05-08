<?php
// Include database configuration
include_once '../config/db.php';

// Include variables
include '../src/variables.php'; 

// Check if genre_id parameter is provided in the URL
$genre_id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

if (isset($genre_id)) {

    // Make a query
    $query = "SELECT genre_id, genre FROM genres WHERE genre_id= ?";
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
    header("Location: index.php");
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit-genre'])) {
        // Check if genre is set in POST data
        if(isset($_POST['genre'])){
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
            // Execute query
            if ($stmt->execute()) {
                echo 'Genre updated!';
            } else {
                echo 'Failed to update!';
            }
        }
    }
}
?>

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" name="genre" id="genre" value="<?php echo $genre; ?>" placeholder="Genre">
                    </div>
                    <span class="error">
                        <?php echo isset($genreError) ? $genreError : ''; ?>
                    </span>
                    <div class="d-grid gap-4">
                        <button type="submit" name="edit-genre" value="edit-genre" class="btn btn-success">Edit Genre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
