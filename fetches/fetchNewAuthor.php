<?php

include 'config/db.php';

include 'config/variables.php'; 

$validCheck = 0;

if(isset($_POST['add-author'])) {
    
    $author_id = uniqid();
    $author_fname = $_POST['author_fname'];
    $author_lname = $_POST['author_lname'];

    if (empty($author_fname)) {
        $author_fnameError = "Enter first name";
    } elseif (!preg_match($nameRegex, $author_fname)) {
        $author_fnameError = "Invalid first name";
    } else {
        $validCheck += 1;
    }
    
    if (empty($author_lname)) {
        $author_lnameError = "Enter last name";
    } elseif (!preg_match($nameRegex, $author_lname)) {
        $author_lnameError = "Invalid last name";
    } else {
        $validCheck += 1;
    }

    if ($validCheck == 2){
        $query = "INSERT INTO `authors` SET author_id=:author_id, author_fname=:author_fname, author_lname=:author_lname";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':author_fname', $author_fname);
        $stmt->bindParam(':author_lname', $author_lname);
        $stmt->execute();
    }
}

?>