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
    } elseif (!preg_match($nameRegex, $author_id)) {
        $author_selectError = "Invalid author";
    } else {
        $validCheck += 1;
    }

    $genre_select = $con->prepare("SELECT genre_id from genres WHERE genre_id=?");
    $genre_select->bindParam(1, $genre_id);
    $genre_select->execute();

    if ($genre_select->rowCount() == 0) {
        $genre_selectError = "Enter genre";
    } elseif (!preg_match($nameRegex, $genre_id)) {
        $genre_selectError = "Invalid genre";
    } else {
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
    $id = create_unique_id();

    $img_file = $_FILES['book_img']['name'];
	$ext = pathinfo($img_file, PATHINFO_EXTENSION);
    $file_name = create_unique_id() . '.' . $ext;
    echo $file_name;

    // Above is working

    // $tmpName = $_FILES['book_img']['tmp_name'];
    // $fileSize = $_FILES['book_img']['size'];
    // $file = explode('.', $img_file);
    // $end = end($file);
    // $img_folder = 'upload/' . $rename;
    //     $Allowed_ext = array('image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG');
    //         $file_location = 'upload/' . $book_img . '.' . $end;
    //         echo $file_location;

    if ($img_size > 2000000) {
		echo "Image too big";
	} else {
        $validCheck += 1;
    }

    if ($validCheck == 8) {
        echo "all good";
    } else {
        echo "fuck";
    }

}
?>