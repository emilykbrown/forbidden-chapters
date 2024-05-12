<style>

@import url(app/book-card.css);

</style>

<?php

include 'config/db.php';

if (isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
} else {
	setcookie('user_id', uniqid(), time() + 60 * 60 * 24 * 30);
}
$select_books = "SELECT books.*, authors.author_fname, authors.author_lname, genres.genre 
FROM books 
JOIN authors ON books.author_id = authors.author_id 
JOIN genres ON books.genre_id = genres.genre_id";
$stmt = $con->prepare($select_books);
$stmt->execute();

if ($stmt->rowCount() > 0) {
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
?>
<section class="py-5">
<div class="container px-4 px-lg-5 mt-5">
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
<div class="col mb-5">
<div class="card h-100">
<div class="img-container">
   <img src="<?php echo $row['book_img']; ?>" class="card-img-top img book-cover w-100" alt="Product images">
   <div class="overlay">
       <button type="button" class="btn btn-dark blurb-btn" data-toggle="modal" data-target="#blurb_modal">Blurb</button>
   </div>
</div>
   <div class="card-body p-4">
       <div class="text-center">
           <!-- Product name-->
           <h5><?php echo $row['title']; ?></h5>
           <p><?php echo $row['author_fname'] . ' ' . $row['author_lname']; ?> | <?php echo $row['genre']; ?></p>
           <p>$<?php echo $row['price']; ?></p>
       </div>
   </div>
   <!-- Product actions-->
   <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
       <div class="row">
           <div class="col text-center"><a class="btn btn-dark mt-auto" href="#">Buy Now</a>
           </div>
           <div class="col text-center"><a class="btn btn-dark mt-auto" href="#"><i
                       class="fa fa-solid fa-cart-shopping"></i></a></div>
       </div>
   </div>

</div>
</div>
</div>
</div>
</section>

<div class="modal" id="blurb_modal">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title"><?php echo $row['title']; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <?php echo $row['blurb']; ?>

    </div>


    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
  }
}
?>
