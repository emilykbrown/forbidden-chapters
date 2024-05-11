<?php

include 'fetches/fetchEditGenre.php';

?>

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" name="genre" id="genre" value="<?php echo $genre; ?>"
                            placeholder="Genre">
                    </div>
                    <span class="error">
                        <?php echo isset($genreError) ? $genreError : ''; ?>
                    </span>
                    <div class="d-grid gap-4">
                        <button type="submit" name="edit-genre" value="edit-genre" class="btn btn-success">Update
                            Genre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>