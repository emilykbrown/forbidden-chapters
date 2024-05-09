<?php

include_once 'config/db.php';
include_once 'variables.php';

if (isset($_POST['add-book'])) {
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

    // Validate Author ID
    $author_select = $con->prepare("SELECT author_id FROM authors WHERE author_id = ?");
    $author_select->bindParam(1, $author_id);
    $author_select->execute();

    if ($author_select->rowCount() == 0) {
        $author_selectError = "Select a valid author";
    } else {
        $validCheck += 1;
    }

    // Validate Genre ID
    $genre_select = $con->prepare("SELECT genre_id FROM genres WHERE genre_id = ?");
    $genre_select->bindParam(1, $genre_id);
    $genre_select->execute();

    if ($genre_select->rowCount() == 0) {
        $genre_selectError = "Select a valid genre";
    } else {
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

    if ($_FILES['book_img']['error'] == UPLOAD_ERR_OK) {
        $img_file = $_FILES['book_img']['name'];
        $ext = pathinfo($img_file, PATHINFO_EXTENSION);
        $file_name = create_unique_id() . '.' . $ext;
        $file_path = 'upload/' . $file_name;
        $file_size = $_FILES['book_img']['size'];

        if (!preg_match($imgRegex, $file_path)) {
            $coverError = "Unsupported file type";
        } elseif ($file_size > 2000000) {
            $coverError = "Image too big";
        } else {
            move_uploaded_file($_FILES['book_img']['tmp_name'], $file_path);
            $validCheck += 1;
        }
    } else {
        $coverError = "Error uploading file";
    }

    if ($validCheck == 8) {
        $book_id = create_unique_id();
        $query = "INSERT INTO `books` 
            SET 
                book_id = :book_id,
                title = :title, 
                isbn = :isbn, 
                author_id = :author_id, 
                genre_id = :genre_id, 
                blurb = :blurb, 
                price = :price, 
                qty = :qty, 
                book_img = :book_img";

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
        $stmt->execute();

        // Redirect or display success message
    } else {
        echo "Validation failed";
    }
}

?>
