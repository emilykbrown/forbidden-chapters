<?php

if(isset($_POST['login'])) {
    include 'config/db.php';
   
    // Set variables
    //$email = $_POST['email'];
    $username = $_POST['username'];
    $upass = $_POST['pswd'];

    // Fetch data from database from 
    $query = "SELECT username, email, upass, urole FROM users WHERE (username=:username || email=:username)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Matching username and password
    if ($stmt->rowCount() == 1) {
      foreach ($results as $row) {
        $hashpass = $row->upass;
        $urole = $row->urole;
      }
      if(password_verify($upass, $hashpass) &&($urole == 'User' || $urole == 'Admin')) {
        $_SESSION['userlogin'] = $_POST['username'];
        $_SESSION['urole'] = $urole;
        print_r($_SESSION['userlogin']); 
       if($urole == 'Admin' ) {
        echo "<script>document.location='admin.php'</script>";
      } if ($urole == 'User') {
        echo "<script>document.location='user.php'</script>";
      } 
    } else {
      $warning_msg[] = "Wrong username or password. Please try again";
    } 
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
  <div class="container mt-3 w-50">
    <div class="card">
      <div class="card-header">Welcome back</div>
      <div class="card-body">
        <form action="#" method="POST">
          <div class="mb-3 mt-3">
            <label for="text" class="form-label">Username or email</label>
            <input type="text" class="form-control" id="username" placeholder="Username or email" name="username">
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd">
          </div>
          <div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
            <a href="signup.php" class="btn btn-primary">New Account</a>
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
