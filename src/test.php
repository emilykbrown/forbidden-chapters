<?php

echo $id;
echo '<br>';
echo $title;
echo '<br>';
echo $blurb;
echo '<br>';
echo $author_id;
echo '<br>';
echo $genre_id;
echo '<br>';
echo $price;
echo '<br>';
echo $qty;
echo '<br>';
echo $file_location;
echo '<br>';


                
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
            $stmt->bindParam(':cover', $file_location);
            
            if ($stmt->execute()) {
                echo "<script>window.location='inventory.php'</script>";
            }

?>