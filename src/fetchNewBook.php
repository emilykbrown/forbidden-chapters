
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'variables.php';


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



    $img_file = $_FILES['book_img']['name'];
    $ext = pathinfo($img_file, PATHINFO_EXTENSION);
    $file_name = uniqid() . '.' . $ext;
    $tmp_name = $_FILES['book_img']['tmp_name'];
    $file_size = $_FILES['book_img']['size'];
    $file_path = 'upload/' . $file_name; 

    // Above is working

    if (empty($_FILES['book_img'])) {
        $coverError = "Enter book cover";
    } elseif (!preg_match($imgRegex, $file_path)) {
        $coverError = "Unsupported file type";
    } elseif ($file_size > 2000000) {
        $coverError = "Image too big";
    } else {
        $validCheck += 1;
    }

         if ($validCheck == 8) {
            $query = "INSERT INTO `books` 
            SET 
                book_id=:book_id,
                title=:title, 
                isbn=:isbn, 
                author_id=(SELECT author_id FROM `authors` WHERE author_id = :author_id), 
                genre_id=(SELECT genre_id FROM `genres` WHERE genre_id = :genre_id), 
                blurb=:blurb, 
                price=:price, 
                qty=:qty, 
                book_img=:book_img";
            
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

        } else {
            echo "Validation failed";
        }
    }

?>