<?php

include 'config/db.php';

if (isset($_POST['signup']
)) {
  // Set variables
  $email = $_POST['email'];
  $username = $_POST['username'];
  $upass = $_POST['pswd'];

  // Hash password
  $options = ['cost' => 12];
  $hashpass = password_hash($upass, PASSWORD_BCRYPT, $options);

  // Validate username and email
  $query = "SELECT * FROM users WHERE(username=? || email=?)";
  $stmt = $con->prepare($query);
  $stmt->bindParam(1,$username);
  $stmt->bindParam(2,$email);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);

  // Unique username and email
 if ($stmt->rowCount() == 0) {
    $query = "INSERT INTO users SET username=:username, email=:email, upass=:upass, urole=:urole";
    $stmt = $con->prepare($query);
    $urole = "User";
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':upass', $hashpass, PDO::PARAM_STR);
    $stmt->bindParam(':urole', $urole, PDO::PARAM_STR);
    $stmt->execute();
    $lastInsertId = $con->lastInsertId();
    if($lastInsertId) {
      $success_msg[] = "Account created";
    } else {
      $error_msg[] = "Unable to create account";
    }
 } else {
    $warning_msg[] = "Please try again";
 } 
} else {
  $warning_msg[] = "Please try again";
} 


?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <title>New User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
  <div class="container mt-3 w-50">
    <div class="card">
      <div class="card-header">New User</div>
      <div class="card-body">
        <form action="#" method="POST">
          <div class="mb-3 mt-3">
            
          <div class="form-group mb-3 mt-3">
                        <label for="fname">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" name="fname" id="fname" b placeholder="First name">
                        </div>
                        <span class="error">
                            <?php //echo $fnameError; ?>
                        </span>
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <label for="lname">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name">
                        </div>
                        <span class="error">
                            <?php //echo $lnameError; ?>
                        </span>
                    </div>
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
          </div>
          <div class="mb-3 mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="usermame" placeholder="Username" name="username">
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd">
          <div>
            <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
            <p>Already have an account?</p>
            <a href="login.php" class="btn btn-primary">Login</a>
          </div>
        </form> 
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'config/alert.php'; ?>
  
</body>
</html>
