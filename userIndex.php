<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/db.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', uniqid(), time() + 60 * 60 * 24 * 30);
}

if (empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
}

if (!empty($_SESSION['userlogin'])) {

    $urole = $_SESSION['urole'];
    if ($urole == "User"){ 
    
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'components/header.php';
?>
</head>

<body>

  <?php
  
    include 'components/userNavbar.php';
  
  ?>
  <div class="container mt-5">

    <!-- Book cards -->
    <div class="row">

      <?php
      include 'components/book_card.php';
      ?>
      <div class="row">
      </div>

</body>

</html>

<?php
    }
}
?>