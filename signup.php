<?php

include 'fetches/fetchNewUser.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'components/header.php';
  ?>
</head>

<body>

  <div class="container mt-3 w-50">
    <div class="card">
      <div class="card-header">New User</div>
      <div class="card-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="mb-3 mt-3">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" b placeholder="First name">
          </div>
          <span class="error">
            <?php echo $fnameError; ?>
          </span>

          <div class="mb-3 mt-3">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name">
          </div>
          <span class="error">
            <?php echo $lnameError; ?>
          </span>
          <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
          </div>
          <span class="error">
            <?php echo $emailError; ?>
          </span>
          <div class="form-group mb-3 mt-3">
            <label for="phone" class="form-label">Contact No.</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="(555) 555-1234">
          </div>
          <span class="error">
            <?php echo $phoneError; ?>
          </span>
          <div class="mb-3 mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" class="form-control" id="usermame" placeholder="Username" name="username">
          </div>
          <span class="error">
            <?php echo $usernameError; ?>
          </span>
          <div class="mb-3 mt-3">
            <label for="upass" class="form-label">Password</label>
            <input type="password" class="form-control" id="upass" placeholder="Password" name="upass">
          </div>
          <span class="error">
            <?php echo $upassError; ?>
          </span>
          <div class="mb-3 mt-3">
            <label for="cpass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id=cpass" placeholder="Confirm password" name="cpass">
          </div>
          <span class="error">
            <?php echo $cpassError; ?>
          </span>
          <div>
            <button type="submit" class="btn btn-primary" name="signup">Sign up</button>
            <p>Already have an account?</p>
            <a href="login.php" class="btn btn-primary">Login</a>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</body>

</html>