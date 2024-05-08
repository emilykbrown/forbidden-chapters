<?php
// Include database configuration
include_once '../config/db.php';

// Include variables
include '../src/variables.php'; 

$validCheck = 0;

// Check if author_id parameter is provided in the URL
$author_id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

if (isset($author_id)) {

    // Make a query
    $query = "SELECT author_id, author_fname, author_lname FROM authors WHERE author_id= ?";
    // Prepare query
    $stmt = $con->prepare($query);
    // Bind params
    $stmt->bindParam(1, $author_id);
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
    if (isset($_POST['edit-author'])) {
        // Check if genre is set in POST data
        if(isset($_POST['author'])){
            $validCheck = 0;
        // Check if author is set in POST data
            $author_fname = htmlspecialchars($_POST['author_fname']);
            $author_lname = htmlspecialchars($_POST['author_lname']);

            if (empty($author)) {
                $authorError = "Enter author";
            } elseif (!preg_match($textRegex, $author)) {
                $authorError = "Invalid author";
            } else {
                // Set validCheck to 1 if all validations pass
                $validCheck += 1;
            }
        } else {
            // Handle case where author is not set in POST data
            $authorError = "author is required";
        }

        if ($validCheck == 2) {
            // Prepare update query
            $query = "UPDATE authors SET author=:author WHERE author_id=:author_id";
            $stmt = $con->prepare($query);
            // Bind parameters
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':author', $author);
            // Execute query
            if ($stmt->execute()) {
                echo 'Author updated!';
            } else {
                echo 'Failed to update!';
            }
        }
    }}

?>

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="author_fname">First Name</label>
                        <input type="text" class="form-control" name="author_fname" id="author_fname" value="<?php echo $author_fname; ?>"placeholder="First Name">
                    </div>
                    <span class="error">
                        <?php echo $author_fnameError; ?>
                    </span>   
                    <div class="mb-3 mt-3">
                        <label for="author_lname">Last Name</label>
                        <input type="text" class="form-control" name="author_lname" id="author_lname" value="<?php echo $author_lname; ?>" placeholder="Last Name">
                    </div>
                    <span class="error">
                        <?php echo $author_lnameError; ?>
                    </span>
                    <div class="d-grid gap-4">
                        <button type="submit" name="add-author" value="add-author" class="btn btn-success">Add Author</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
