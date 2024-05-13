<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Forbidden Chapters</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>0
        <div class="d-flex ms-auto">
        <a class="nav-link nav-link_shopping-cart" href="shopping_cart.php">
            <span class="fa-solid fa-cart-shopping"><?php echo $total_cart_items; ?></span>
          </a>
          <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
    </div>
</nav>