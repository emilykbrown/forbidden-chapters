<?php

include 'config/db.php';

if(isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
} else {
	setcookie('user_id', uniqid(), time() + 60*60*24*30);
} 

$count_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id=?");
$count_cart_items->execute([$user_id]);
$total_cart_items = strval($count_cart_items->rowCount()); 

?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Forbidden Chapters</a>
        <div class="d-flex ms-auto">
        <a class="nav-link nav-link_shopping-cart" href="cart.php">
            <span class="fa-solid fa-cart-shopping" style="color: #fff;"><?php echo $total_cart_items; ?></span>&nbsp;&nbsp;
          </a>
          <div class="d-flex ms-auto">
            <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
        </div>
    </div>
</nav>