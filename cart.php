<!DOCTYPE html>
<html>

<head>
<?php include 'components/header.php'; ?>
</head>

<body>
	<!-- Navbar -->
	<?php include 'components/navbar.php'; ?>
	<!-- End navbar -->

	<?php
	// Database connection
	require_once 'config/db.php'; 

	// Handle cookies
	if (isset($_COOKIE['user_id'])) {
		$user_id = $_COOKIE['user_id'];
	} else {
		$user_id = uniqid();
		setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 30); // Set cookie for 30 days
	}

	// Update cart
	if (isset($_POST['update_cart'])) {
		$cart_id = $_POST['cart_id'];
		$qty = $_POST['qty'];
		$update_qty = $con->prepare("UPDATE `cart` SET qty=? WHERE cart_id=?");
		$update_qty->execute([$qty, $cart_id]);

		$success_msg[] = "Cart quantity updated!";
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
							<th>Action</th>
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
								<td><img src="<?php echo $fetch_song['book_title']; ?>" width="100" height="100"></td>
								<td><?php echo $fetch_cart['price']; ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cart_id']; ?>">
										<input type="number" name="qty" required min="1" value="<?php echo $fetch_cart['qty']; ?>" max="99" class="qty w-25 form-control float-end text-end border border-primary rounded-pill">
										<button type="submit" class="btn btn-outline-primary rounded-pill" name="update_cart">Update</button>
									</form>
								</td>
								<td><?php echo $subtotal; ?></td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
										<input type="submit" name="delete-item" value="Delete" class="btn btn-outline-danger rounded-pill">
									</form>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>

				<form action="" method="POST">
					<input type="submit" value="Empty cart" name="empty_cart" class="btn btn-outline-danger">
				</form>
			</div>

			<div class="float-end">
				<a href="index.php" class="btn btn-outline-primary">Back to shopping</a>
				<a href="checkout.php" class="btn btn-outline-success">Checkout</a>
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
