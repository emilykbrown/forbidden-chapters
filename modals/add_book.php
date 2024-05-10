<?php
include 'fetches/fetchNewBook.php';
?>

<body>

    <div class="container mt-3 mb-3 d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="book-title">Book Title</label>
                        <input type="text" class="form-control" name="book-title" id="book-title"
                            placeholder="Book title">
                    </div>
                    <span class="error">
                        <?php echo $titleError; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN">
                    </div>
                    <span class="error">
                        <?php echo $isbnError; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="author">Author</label>
                        <select name="author_select" class="form-control select-control" id="author_select">
                            <option value="">--Select an author--</option>
                            <?php
                            $authors = $con->prepare("SELECT * FROM authors ORDER BY author_lname");
                            $authors->execute();
                            while ($author_list = $authors->fetch(PDO::FETCH_ASSOC)) {
                                extract($author_list)
                                    ?>
                                <option value="<?php echo $author_id ?>">
                                    <?php echo $author_fname;
                                    echo "<div>&nbsp;</div>";
                                    echo $author_lname ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <span class="error">
                        <?php echo $authorSelectError; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="genre">Genre</label>

                        <select name="genre_select" class="form-control select-control" id="genre_select">
                            <option value="">--Select a genre--</option>
                            <?php
                            $genres = $con->prepare("SELECT * FROM genres ORDER BY genre");
                            $genres->execute();
                            while ($genre_list = $genres->fetch(PDO::FETCH_ASSOC)) {
                                extract($genre_list)
                                    ?>
                                
                                <option value="<?php echo $genre_id ?>"><?php echo $genre ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <span class="error">
                        <?php echo $genreSelectError; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="blurb">Blurb</label>
                        <textarea class="form-control" id="blurb" name="blurb" rows="3" placeholder="Blurb"></textarea>
                    </div>
                    <span class="error">
                        <?php echo $blurbError; ?>
                    </span>
                    <div class="row">
                        <div class="mb-3 mt-3 col">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" min="0.01" max="10000.00"
                                step="0.01">
                            <span class="error">
                                <?php echo $priceError; ?>
                            </span>
                        </div>
                        <div class="mb-3 mt-3 col">
                            <label for="qty">Quanity</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="1" max="10000">
                            <span class="error">
                                <?php echo $qtyError; ?>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="book_img" class="form-label">Book Cover</label>
                        <input type="file" class="form-control" name="book_img" id="book_img">
                    </div>
                    <span class="error">
                        <?php echo $imgError; ?>
                    </span>
                    <div class="mb-3 mt-3">

                    </div>
                    <div class="d-grid gap-4">
                        <button type="submit" name="add-book" value="add-book" class="btn btn-success">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>