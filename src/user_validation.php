<?php

include 'config/db.php';

include 'variables.php'; 


function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// Validation

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fName = sanitize_input($_POST['fname']);
  if (empty($fName)) {
    $fnameError = "Enter first name";
  } elseif (!preg_match($nameRegex, $fName)) {
    $fnameError = "Invalid first name";
  } else {
    $fnameValid = true;
    $fName = sanitize_input($_POST['fname']);
  }

  $lName = sanitize_input($_POST['lname']);
  if (empty($lName)) {
    $lnameError = "Enter last name";
  } elseif (!preg_match($nameRegex, $lName)) {
    $lnameError = "Invalid last name";
  } else {
    $lnameValid = true;
    $lName = sanitize_input($_POST['lname']);
  }

  $username = sanitize_input($_POST['username']);
  if (empty($username)) {
    $usernameError = "Enter a username";

  } elseif (!preg_match($usernameRegex, $username)) {
    $usernameError = "Invalid username";
  } else {
    $usernameValid = true;
    $username = sanitize_input($_POST['username']);
  }

  $email = sanitize_input($_POST['email']);
  if (empty($email)) {
    $emailError = "Enter email";
  } elseif (!preg_match($emailRegex, $email)) {
    $emailError = "Invalid email";
  } else {
    $emailValid = true;
    $email = sanitize_input($_POST["email"]);
  }

  $phone = sanitize_input($_POST['phone']);
  if (empty($phone)) {
    $phoneError = "Enter phone number";
  } elseif (!preg_match($phoneRegex, $phone)) {
    $phoneError = "Invalid phone number";
  } else {
    $phoneValid = true;
    $phone = sanitize_input($_POST["phone"]);
  }

  $upass = sanitize_input($_POST['upass']);
  if (empty($upass)) {
    $upassError = "Enter a password";
  } elseif (!preg_match($upassRegex, $password)) {
    $upassError = "Invalid password";
  } else {
    $upassValid = true;
    $upass = sanitize_input($_POST["upass"]);
  }

  $cpass = sanitize_input($_POST['cpass']);
  if (empty($cpass)) {
    $cpassError = "Confirm password";
  } elseif ($cpass != $upass) {
    $cpassError = "Your passwords did not match.";
  } else {
    $cpassValid = true;
  }
}

if (isset($_POST['signup'])) {
  $id = create_unique_id();
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $upass = $_POST['upass'];

  // Hash password
  $options = ['cost' => 12];
  $hashpass = password_hash($upass, PASSWORD_BCRYPT, $options);

  // Validate username and email
  $query = "SELECT * FROM users WHERE (username=? || email=?)";
  $stmt = $con->prepare($query);
  $stmt->bindParam(1, $username);
  $stmt->bindParam(2, $email);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);

  // Unique username and email
  if ($stmt->rowCount() == 0) {
    $query = "INSERT INTO users SET id=:id, fname=:fname, lname=:lname, email=:email, phone=:phone, username=:username, upass=:upass, urole=:urole";
    
    
    $stmt = $con->prepare($query);
    $urole = "User";
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':upass', $hashpass, PDO::PARAM_STR);
    $stmt->bindParam(':urole', $urole, PDO::PARAM_STR);
    $stmt->execute();
    $lastInsertId = $con->lastInsertId();
  }
}
?>
