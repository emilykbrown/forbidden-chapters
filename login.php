<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include('src/header.php');
?>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'config/alert.php'; ?>
  
</body>
</html>
