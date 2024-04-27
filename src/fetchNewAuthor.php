<?php

if(isset($_POST['add-author'])) {
    // Set variables
    $author_id = create_unique_id();
    $author_fname = $_POST['author_fname'];
    $author_lname = $_POST['author_lname'];

    $query = "INSERT INTO `authors` SET author_id=:author_id, author_fname=:author_fname, author_lname=:author_lname";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':author_id', $author_id);
    $stmt->bindParam(':author_fname', $author_fname);
    $stmt->bindParam(':author_lname', $author_lname);
    $stmt->execute();
}



?>