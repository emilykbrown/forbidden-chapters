<?php

include 'src/fetchNewGenre.php';

?>

<body>
    <div class="container mt-3 mb-3 justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 mt-3">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" name="genre" id="genre" placeholder="Genre">
                    </div>
                    <div class="d-grid gap-4">
                        <button type="submit" name="add-genre" value="add-genre" class="btn btn-success">Add Genre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
