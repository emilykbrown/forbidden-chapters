<?php

include '../fetches/fetchEditAuthor.php';
 
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