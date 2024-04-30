if (empty($_FILES['book-cover']['tmp_name'])) {
        $coverError = "Add book cover";
    } elseif ($_FILES['book-cover']['size'] > 2000000) {
        echo 'Image too big';
    } elseif ($_FILES['book-cover']['error'] !== UPLOAD_ERR_OK) {
        echo 'File upload error: ' . $_FILES['book-cover']['error'];
    } else {
        $validCheck += 1;
    }


        // Insert into database
        $id = create_unique_id();
        $query = "INSERT INTO `books` SET id=:id, title=:title, isbn=:isbn, author_id=:author_id, genre_id=:genre_id, blurb=:blurb, price=:price, qty=:qty, cover=:cover";
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
    } else {
        echo "Validation failed.";
    }

    echo $id;
        echo '<br>';
        echo $title;
        echo '<br>';
        echo $isbn;
        echo '<br>';
        echo $author_id;
        echo '<br>';
        echo $genre_id;
        echo '<br>';
        echo $blurb;
        echo '<br>';
        echo $price;
        echo '<br>';
        echo $qty;