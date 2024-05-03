<?php

include 'config/db.php';

include 'variables.php'; 

$validCheck = 0;

if (isset($_POST['signup'])) {

  $fName = htmlspecialchars($_POST['fname']);
  $lName = htmlspecialchars($_POST['lname']);
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $upass = htmlspecialchars($_POST['upass']);
  $cpass = htmlspecialchars($_POST['cpass']);

  if (empty($fName)) {
    $fnameError = "Enter first name";
  } elseif (!preg_match($nameRegex, $fName)) {
    $fnameError = "Invalid first name";
  } else {
    $validCheck += 1;
  }

  
  if (empty($lName)) {
    $lnameError = "Enter last name";
  } elseif (!preg_match($nameRegex, $lName)) {
    $lnameError = "Invalid last name";
  } else {
    $validCheck += 1;
  }

  if (empty($username)) {
    $usernameError = "Enter a username";
  } elseif (!preg_match($usernameRegex, $username)) {
    $usernameError = "Invalid username";
  } else {
    $validCheck += 1;
  }

  if (empty($email)) {
    $emailError = "Enter email";
  } elseif (!preg_match($emailRegex, $email)) {
    $emailError = "Invalid email";
  } else {
    $validCheck += 1;
  }

  if (empty($phone)) {
    $phoneError = "Enter phone number";
  } elseif (!preg_match($phoneRegex, $phone)) {
    $phoneError = "Invalid phone number";
  } else {
    $validCheck += 1;
  }

  if (empty($upass)) {
    $upassError = "Enter a password";
  } elseif (!preg_match($upassRegex, $upass)) {
    $upassError = "Invalid password";
  } else {
    $validCheck += 1;
  }

  if (empty($cpass)) {
    $cpassError = "Confirm password";
  } elseif ($cpass != $upass) {   
    $cpassError = "Your passwords did not match.";
  } else {
    $validCheck += 1;
  }

  if ($validCheck == 7) {
    $user_id = create_unique_id();
  
    // Hash password
    $options = ['cost' => 12];
    $hashpass = password_hash($upass, PASSWORD_BCRYPT, $options);
  
    // Validate username and email
    $query = "SELECT * FROM users WHERE (username=? OR email=?)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  
    // Unique username and email
    if ($stmt->rowCount() == 0) {
      $query = "INSERT INTO users SET user_id=:user_id, fname=:fname, lname=:lname, email=:email, phone=:phone, username=:username, upass=:upass, urole=:urole";
      
      
      $stmt = $con->prepare($query);
      $urole = "User";
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':fname', $fName);
      $stmt->bindParam(':lname', $lName);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':phone', $phone);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':upass', $hashpass);
      $stmt->bindParam(':urole', $urole);
      $stmt->execute();
      $lastInsertId = $con->lastInsertId();
    }
  }
}
?>
