<?php

include 'variables.php'; 

$validCheck = 0;

if (isset($_POST['add-book'])) {

    $title = htmlspecialchars($_POST['book-title']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $author_id = htmlspecialchars($_POST['author_select']);
    $genre_id = htmlspecialchars($_POST['genre_select']);
    $blurb = htmlspecialchars($_POST['blurb']);
    $price = htmlspecialchars($_POST['price']);
    $qty = htmlspecialchars($_POST['qty']);

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

    if ($author_select->rowCount() == 0) {
        $author_selectError = "Enter author";
    } elseif (!preg_match($nameRegex, $author_select)) {
        $author_selectError = "Invalid author";
    } else {
        $author_id = $author_select->fetch(PDO::FETCH_ASSOC);
        $author_id = $author_id['author_id'];
        $validCheck += 1;
    }
    
    $genre_select = $con->prepare("SELECT genre_id from genres WHERE genre_id=?");
    $genre_select->bindParam(1, $genre_id);

    if ($genre_select->rowCount() == 0) {
        $genre_selectError = "Enter genre";
    } elseif (!preg_match($nameRegex, $genre_select)) {
        $genre_selectError = "Invalid genre";
    } else {
        $genre_id = $genre_select->fetch(PDO::FETCH_ASSOC);
        $genre_id = $genre_id['genre_id'];
        $validCheck += 1;
    }

    if (empty($blurb)) {
        $blurbError = "Enter blurb";
    } elseif (!preg_match($nameRegex, $blurb)) {
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

    if (empty($_FIES['book-cover']['tmp_name'])) {
        $coverError = "Add book cover";
    } elseif ($img_size > 2000000) {
        echo 'Image too big';
    } else {
        $validCheck += 1;
    }
    if($validCheck === 8) {
        $cover_id = create_unique_id();
        $ext = pathinfo($_FILES['book-cover']['name'], PATHINFO_EXTENSION);
        $rename = create_unique_id() . '.' . $ext;

        // Save image
        $img_tmp_name = $_FILES['book-cover']['tmp_name'];
        $img_size = $_FILES['book-cover']['size'];
        $img_folder = 'upload/' . $rename;

        // Insert into database
        $id = create_unique_id();
        $query = "INSERT INTO `books` SET id=:id, title=:title, author_id=:author_id, isbn=:isbn, genre_id=:genre_id, blurb=:blurb, price=:price, qty=:qty, cover=:cover";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':genre_id', $genre_id);
        $stmt->bindParam(':blurb', $blurb);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':cover', $img_folder);
        $stmt->execute();
    
        // Move uploaded file
        move_uploaded_file($img_tmp_name, $img_folder);
    
        echo "Book added successfully.";
    }
}
?>