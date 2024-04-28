<?php
if (isset($_POST['add-book'])) {
    // Set variables
    $id = create_unique_id();
    $title = $_POST['book-title'];
    $isbn = $_POST['isbn'];
    $author_id = $_POST['author_select'];
    $genre_id = $_POST['genre_select'];
    $blurb = $_POST['blurb'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $book_img = $_FILES['book-cover']['name'];
    $ext = pathinfo($book_img, PATHINFO_EXTENSION);
    $rename = create_unique_id() . '.' . $ext;

    // Save image
    $img_tmp_name = $_FILES['book-cover']['tmp_name'];
    $img_size = $_FILES['book-cover']['size'];
    $img_folder = 'upload/' . $rename;

    $author_match = $con->prepare("SELECT author_id from authors WHERE author_id=?");
    
    

    if ($img_size > 2000000) {
        echo 'Image too big';
    } else {
        try {
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
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
