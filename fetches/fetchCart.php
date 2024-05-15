<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files
include 'config/db.php';
include 'config/variables.php';

// Check if user_id cookie is set, if not, set it
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = uniqid();
    setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 30);
}

// Check if add_to_cart form is submitted
if (isset($_POST['add_to_cart'])) {
    // Check if user is logged in (session user_id is set)
    if (isset($_SESSION['user_id'])) {
        // Retrieve user_id from session
        $user_id = $_SESSION['user_id'];
    }

    // Retrieve book_id and qty from form submission
    $book_id = $_POST['book_id'];
    $qty = $_POST['qty'];
    
    // Prepare and execute queries
    $verify_cart = $con->prepare("SELECT * FROM `cart` WHERE user_id=? AND book_id=?");
    $verify_cart->execute([$user_id, $book_id]);
    
    $max_cart_items = $con->prepare("SELECT * FROM `cart` WHERE user_id=?");
    $max_cart_items->execute([$user_id]);

    // Fetch data from the PDOStatement objects
    $verify_cart_data = $verify_cart->fetch();
    $max_cart_items_data = $max_cart_items->fetchAll();

    if ($verify_cart->rowCount() >0){
        echo "Already added to cart!";
      } elseif($max_cart_items->rowCount()==10) {
        echo "Cart is full!";
      } else {
        $select_price = $con->prepare("SELECT * from books WHERE book_id=? LIMIT 1");
        $select_price->execute([$book_id]);
        $fetch_price = $select_price ->fetch(PDO::FETCH_ASSOC);
        // $insert_cart = $con->prepare("INSERT INTO 'cart' (id, user_id, book_id, price, qty) VALUES (?,?,?,?,?)");
        $insert_cart = $con->prepare("INSERT INTO cart (cart_id, user_id, book_id, price, qty) VALUES (?,?,?,?,?)");
        $cart_id = uniqid();
        $insert_cart->execute([$cart_id, $user_id, $book_id, $fetch_price['price'], $qty]);
        echo 'Added to cart!';
      }
    
}

// Update cart
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $update_qty = $con->prepare("UPDATE `cart` SET qty=? WHERE cart_id=?");
    $update_qty->execute([$qty, $cart_id]);

    echo "Cart quantity updated!";
}

// Delete item from cart
if (isset($_POST['delete-item'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart_id = $con->prepare("DELETE FROM `cart` WHERE cart_id=?");
    $delete_cart_id->execute([$cart_id]);
    echo "Cart item deleted!";
}

// Empty cart
if (isset($_POST['empty_cart'])) {
    $delete_cart_id = $con->prepare("DELETE FROM `cart` WHERE user_id=?");
    $delete_cart_id->execute([$user_id]);
    echo "Cart emptied!";
}
?>
