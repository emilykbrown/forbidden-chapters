<?php
// Include database configuration
include_once '../config/db.php';

// Include variables
include '../src/variables.php'; 

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

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="author_fname">First Name</label>
                        <input type="text" class="form-control" name="author_fname" id="author_fname" value="<?php echo isset($author_fname) ? $author_fname : ''; ?>">
                        <span class="error">
                            <?php echo isset($author_fnameError) ? $author_fnameError : ''; ?>
                        </span>   
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="author_lname">Last Name</label>
                        <input type="text" class="form-control" name="author_lname" id="author_lname" value="<?php echo isset($author_lname) ? $author_lname : ''; ?>">
                        <span class="error">
                            <?php echo isset($author_lnameError) ? $author_lnameError : ''; ?>
                        </span>
                    </div>
                    <div class="d-grid gap-4">
                        <button type="submit" name="edit-author" value="edit-author" class="btn btn-success">Update Author</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
