<?php
include_once '../config/db.php';
include '../src/variables.php'; 

$validCheck = 0;

$book_id = isset($_GET['id']) ? $_GET['id'] : die('No ID Found!');

if (isset($author_id)) {
    // Fetch author details
    $query = "SELECT book_id, title, isbn, author_id, genre_id, blurb, price, qty, book_img FROM books WHERE book_id= ?";
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
    if (isset($_POST['edit-book'])) {
        // Check if genre is set in POST data
        if(isset($_POST['book-title'])){
            $validCheck = 0;
            $title = htmlspecialchars($_POST['book-title']);
            $isbn = htmlspecialchars($_POST['isbn']);
            $author_id = htmlspecialchars($_POST['author_select']);
            $genre_id = htmlspecialchars($_POST['genre_select']);
            $blurb = htmlspecialchars($_POST['blurb']);
            $price = htmlspecialchars($_POST['price']);
            $qty = htmlspecialchars($_POST['qty']);
            // Validation checks

            if (empty($title)) {
                $titleError = "Enter title";
            } elseif (!preg_match($nameRegex, $title)) {
                $titleError = "Invalid title name";
            } else {
                $validCheck += 1;
            }

            if (empty($isbn)) {
                $isbnError = "Enter ISBN name";
            } elseif (!preg_match($isbnRegex, $isbn)) {
                $isbnError = "Invalid ISBN name";
            } else {
                $validCheck += 1;
            }

            $author_select = $con->prepare("SELECT author_id from authors WHERE author_id=?");
            $author_select->bindParam(1, $author_id);
            $author_select->execute();

            if ($author_select->rowCount() == 0) {
                $author_selectError = "Enter author";
            } else {
                $author_id = $author_select->fetch(PDO::FETCH_ASSOC);
                $author_id = $author_id['author_id'];
                $validCheck += 1;
            }

            $genre_select = $con->prepare("SELECT genre_id from genres WHERE genre_id=?");
            $genre_select->bindParam(1, $genre_id);
            $genre_select->execute();

            if ($genre_select->rowCount() == 0) {
                $genre_selectError = "Enter genre";
            } else {
                $genre_id = $genre_select->fetch(PDO::FETCH_ASSOC);
                $genre_id = $genre_id['genre_id'];
                $validCheck += 1;
            }

            if (empty($blurb)) {
                $blurbError = "Enter blurb";
            } elseif (!preg_match($textRegex, $blurb)) {
                $blurbError = "Invalid blurb";
            } else {
                $validCheck += 1;
            }

            if (empty($price)) {
                $priceError = "Enter price";
            } elseif (!preg_match($priceRegex, $price)) {
                $priceError = "Invalid price";
            } else {
                $validCheck += 1;
            }

            if (empty($qty)) {
                $qtyError = "Enter quantity";
            } elseif (!preg_match($qtyRegex, $qty)) {
                $qtyError = "Invalid quantity";
            } else {
                $validCheck += 1;
            }

            // Check for file upload errors
            if ($_FILES['book_img']['error'] != UPLOAD_ERR_OK) {
                $coverError = "Error uploading file";
            } else {
                // File upload handling
            $img_file = $_FILES['book_img']['name'];
            $ext = pathinfo($img_file, PATHINFO_EXTENSION);
            $file_name = create_unique_id() . '.' . $ext;
            $file_path = '../upload/' . $file_name;

            if (!move_uploaded_file($_FILES['book_img']['tmp_name'], $file_path)) {
                $coverError = "Error moving uploaded file";
            } else {
                $validCheck += 1;
            }
        }


        if ($validCheck == 8) {
            $query = "UPDATE `books` 
                SET 
                    book_id=:book_id,
                    title=:title, 
                    isbn=:isbn,
                    author_id=(SELECT author_id FROM `authors` WHERE author_id = :author_id), 
                    genre_id=(SELECT genre_id FROM `genres` WHERE genre_id = :genre_id), 
                    blurb=:blurb, 
                    price=:price, 
                    qty=:qty, 
                    book_img=:book_img
                WHERE book_id=:book_id";

            $stmt = $con->prepare($query);
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':genre_id', $genre_id);
            $stmt->bindParam(':blurb', $blurb);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':book_img', $file_path);
            
            // Check if the update was successful
            if ($stmt->execute()) {
                echo "Update successful";
            } else {
                echo "Update failed";
            }
        } else {
            echo "Validation failed";
        }
}}}   
?>

<body>

    <div class="container mt-3 mb-3 d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
                        <label for="book-title">Book Title</label>
                        <input type="text" class="form-control" name="book-title" id="book-title" value="<?php echo $title; ?>">
                    </div>
                    <span class="error">
                        <?php echo $titleError; ?>
                    </span>
                    <div class="mb-3 mt-3">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn"  value="<?php echo $isbn; ?>">
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
                        <textarea class="form-control" id="blurb" name="blurb" rows="3" value="<?php echo $blurb; ?>"></textarea>
                    </div>
                    <span class="error">
                        <?php echo $blurbError; ?>
                    </span>
                    <div class="row">
                        <div class="mb-3 mt-3 col">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" value="<?php echo $price; ?>" name="price" min="0.01" max="10000.00"
                                step="0.01">
                            <span class="error">
                                <?php echo $priceError; ?>
                            </span>
                        </div>
                        <div class="mb-3 mt-3 col">
                            <label for="qty">Quanity</label>
                            <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $qty; ?>" min="1" max="10000">
                            <span class="error">
                                <?php echo $qtyError; ?>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="book_img" class="form-label">Book Cover</label>
                        <input type="file" class="form-control" name="book_img" id="book_img" value="<?php echo $book_img; ?>">
                    </div>
                    <span class="error">
                        <?php echo $coverError; ?>
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