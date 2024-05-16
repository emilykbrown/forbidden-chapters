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
		
		include "fetches/fetchCart.php";
?>
<!DOCTYPE html>
<html>

<head>
<?php include 'components/header.php'; ?>
</head>

<body>
	<!-- Navbar -->
	<?php include 'components/userNavbar.php'; ?>
	<!-- End navbar -->

	

	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				<h2>My Cart</h2>
			</div>

			<div class="card-body">
				<table class="table table-hover table-condensed" id="cart_table">
					<thead>
						<tr>
							<th>Book</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Subtotal</th>
							<th>Remove</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$grand_total = 0;
						$select_cart = $con->prepare("SELECT * FROM `cart` WHERE user_id = ?");
						$select_cart->execute([$user_id]);
						while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
							$select_books = $con->prepare("SELECT * FROM `books` WHERE book_id = ?");
							$select_books->execute([$fetch_cart['book_id']]);
							$fetch_book = $select_books->fetch(PDO::FETCH_ASSOC);
							$subtotal = $fetch_cart['price'] * $fetch_cart['qty'];
							$grand_total += $subtotal;
						?>
							<tr>
								<td><img src="<?php echo $fetch_book['book_img']; ?>" width="100" height="100"></td>
								<td><?php echo $fetch_cart['price']; ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
										<input type="number" name="qty" required min="1" value="<?php echo $fetch_cart['qty']; ?>" max="99" class="qty w-25 form-control float-end text-end border border-success">
										<button type="submit" class="btn btn-success btn-sm" name="update_cart"><i class="fa-solid fa-pen-to-square"></i></button>
									</form>
								</td>
								<td><?php echo $subtotal; ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
										<button type="submit" name="delete_item" value="Delete" class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></button>
									</form>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>

				<form action="" method="POST">
					<input type="submit" value="Empty cart" name="empty_cart" class="btn btn-danger">
				</form>
			</div>

			<div class="float-end">
				<a href="userIndex.php" class="btn btn-primary">Back to shopping</a>
				<a href="checkout.php" class="btn btn-success">Checkout</a>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>1
	<script>

	$(document).ready(function() {
	    $('#cart_table').DataTable();
	});

	</script>
</body>

</html>
<?php
	}
}
?>