<?php

include 'variables.php';

$validCheck = 0;

if (isset($_POST['add-book'])) {
    $title = htmlspecialchars($_POST['book-title']); 
    // Validation checks

    if (empty($title)) {
        $titleError = "Enter title";
    } elseif (!preg_match($textRegex, $title)) {
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
    } elseif (!preg_match($textRegex, $author_id)) {
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
   // $id = create_unique_id();

    $img_file = $_FILES['book_img']['name'];
    $tmpName = $_FILES['book_img']['tmp_name'];
    $fileSize = $_FILES['book_img']['size'];
    $contentType = mime_content_type($_FILES['book_img']['tmp_name']);

    if ($fileSize < 500000000) {
        $file = explode('.', $img_file);
        $end = end($file);
        $Allowed_ext = array('image/png', 'image/PNG', 'image/jpg', 'image/JPG', 'image/jpeg', 'image/JPEG');

        if (in_array($contentType, $Allowed_ext)) {
            $file = explode('/', $contentType);
            $book_img = date('Ymd') . time();
            $file_location = 'upload/' . $book_img . '.' . $end;

            // Above is working

            try {
                $id = create_unique_id();
                $query = "INSERT INTO `books` SET title=:title";
            
                $stmt = $con->prepare($query);
                //$stmt->bindParam(':id', $id);
                $stmt->bindParam(':title', $title);
                // $stmt->bindParam(':isbn', $isbn);
                // $stmt->bindParam(':author_id', $author_id);
                // $stmt->bindParam(':genre_id', $genre_id);
                // $stmt->bindParam(':blurb', $blurb);
                // $stmt->bindParam(':price', $price);
                // $stmt->bindParam(':qty', $qty);
                // $stmt->bindParam(':cover', $file_location);
                $stmt->execute();
                
                echo "Book inserted successfully.";
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // if ($stmt->execute()) {
            //     echo "<script>window.location='inventory.php'</script>";
            // }

        }
    } else {
        echo "Validation failed";
    }
} else {
    // echo "Image size too large";
}
//}
