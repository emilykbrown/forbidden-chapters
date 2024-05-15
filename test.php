<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/db.php';
include 'config/variables.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', uniqid(), time() + 60 * 60 * 24 * 30);
}


if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $book_id = $_POST['book_id'];
        $cart_id = uniqid();
        $qty = $_POST['qty'];
        $verify_cart = $con->prepare("SELECT * FROM `cart` WHERE user_id=? AND book_id=?");
        $verify_cart->execute([$user_id, $book_id]);
        $max_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id=?");
        $max_cart_items->execute([$user_id]);
      
        if ($verify_cart->rowCount() > 0) {
            echo "Already added to cart!";
        } elseif ($max_cart_items->rowCount() == 10) {
            echo "Cart is full!";
        } else {
            $select_price = $con->prepare("SELECT * from books WHERE book_id=? LIMIT 1");
            $select_price->execute([$book_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);
            $insert_cart = $con->prepare("INSERT INTO cart (cart_id, user_id, book_id, price, qty) VALUES (?,?,?,?,?)");
            $insert_cart->execute([$cart_id, $user_id, $book_id, $fetch_price['price'], $qty]);
            echo 'Added to cart!';
        }
    } else {
        echo '<script>$("#login_modal").modal("show");</script>';
    }
}