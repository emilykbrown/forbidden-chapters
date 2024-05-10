<?php

session_start();

if(isset($_POST['login'])) {
    include 'config/db.php';
   
    // Set variables
    $user_id = uniqid();
    $username = $_POST['username'];
    $upass = $_POST['upass'];
    
    // Fetch data from the database
    $query = "SELECT fname, lname, username, email, phone, upass, urole FROM users WHERE (username=:username OR email=:username)";
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
        if(password_verify($upass, $hashpass) && ($urole == 'User' || $urole == 'Admin')) {
            $_SESSION['userlogin'] = $_POST['username'];
            $_SESSION['urole'] = $urole;
            if($urole == 'Admin' ) {
              echo "<script>document.location='inventory.php'</script>";
            } if ($urole == 'User') {
              echo "<script>document.location='index.php'</script>";
            } 
        } else {
            echo "<p class='error'>nvalid username or password</p>";
        }
    } else {
        echo "<p class='error'>nvalid username or password</p>";
    }
}
?>

<body> 
  <div class="container mt-2 mb-2">
    <div class="card">
      <div class="card-header">Welcome back</div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="mb-3 mt-3">
            <label for="text" class="form-label">Username or email</label>
            <input type="text" class="form-control" id="username" placeholder="Username or email" name="username">
          </div>
          <div class="mb-3">
            <label for="upass" class="form-label">Password</label>
            <input type="password" class="form-control" id="upass" placeholder="Password" name="upass">
          </div>
          <div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
            <a href="signup.php" class="btn btn-primary">New Account</a>
          </div>
        </form> 
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>