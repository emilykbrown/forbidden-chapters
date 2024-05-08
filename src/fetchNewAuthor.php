<?php

include 'variables.php'; 

$validCheck = 0;

if(isset($_POST['add-author'])) {
    
    $author_fname = htmlspecialchars($_POST['author_fname']);
    $author_lname = htmlspecialchars($_POST['author_lname']);

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
        $author_id = create_unique_id();
        $query = "INSERT INTO `authors` SET author_id=:author_id, author_fname=:author_fname, author_lname=:author_lname";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':author_fname', $author_fname);
        $stmt->bindParam(':author_lname', $author_lname);
        $stmt->execute();
    }
}

?>