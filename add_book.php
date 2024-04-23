<?php

include_once 'config/db.php';
if (isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
} else {
	setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30);
}

if (isset($_POST['add-book'])) {
    $id = create_unique_id();
    $title = $_POST['book-title'];
    $author = $_POST['author'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
<?php
    include 'src/header.php';
?>    
</head>
<body>
    

	<div class="container mt-5 mb-5 d-flex justify-content-center">
		<div class="card w-50">
			<div class="card-body">
				<form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 mt-3">
						<label for="book-title">Book Title</label>
						<input type="text" class="form-control" name="book-title" id="book-title" placeholder="Book title">
				    </div>
                    <div class="mb-3 mt-3">
						<label for="author">Author</label>
						<input type="text" class="form-control" name="author" id="author" placeholder="Author">
				    </div>
                    <div class="mb-3 mt-3">
						<label for="genre">Genre</label>
						<input type="text" class="form-control" name="genre" id="genre" placeholder="Genre">
				    </div>
                    <div class="mb-3 mt-3">
						<label for="blurb">Blurb</label>
                        <textarea class="form-control" id="blurb" name="blurb" rows="3" placeholder="Blurb"></textarea>
				    </div>
                    <div class="row">
                        <div class="mb-3 mt-3 col">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" min="0.01" max="10000.00" step="0.01">
                        </div>
                        <div class="mb-3 mt-3 col">
                            <label for="qty">Quanity</label>
                            <input type="number" class="form-control" id="qty" name="qty" min="1" max="10000">
                        </div>
                    </div>
                    
					<div class="mb-3 mt-3">
						<label for="book-cover" class="form-label">Book Cover</label>
						<input type="file" class="form-control" name="book-cover" id="book-cover">
					</div>
                    <div class="mb-3 mt-3">
                        
                    </div>
                    <div class="d-grid gap-4">
						<button type="submit" name="add-book" value="add-book" class="btn btn-outline-primary">Add to Inventory</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>