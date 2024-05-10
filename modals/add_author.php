<?php
include 'fetches/fetchNewAuthor.php';
?>

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="author_fname">First Name</label>
                        <input type="text" class="form-control" name="author_fname" id="author_fname" placeholder="First Name">
                    </div>
                    <span class="error">
                        <?php echo $author_fnameError; ?>
                    </span>   
                    <div class="mb-3 mt-3">
                        <label for="author_lname">Last Name</label>
                        <input type="text" class="form-control" name="author_lname" id="author_lname" placeholder="Last Name">
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
