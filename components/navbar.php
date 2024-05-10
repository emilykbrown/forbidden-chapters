<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="index.php" class="navbar-brand">Forbidden Chapters</a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav">

      </div>
      <div class="d-flex ms-auto">
        <a href="signup.php" class="btn btn-primary btn-sm">New Account</a>&nbsp;&nbsp;
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
          data-bs-target="#login_modal">Login</button>
      </div>
</nav>

<!-- Login Modal -->
<div class="modal" id="login_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <?php

      include 'modals/login.php';

      ?>

    </div>
  </div>
</div>