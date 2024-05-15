
<style>
    @import url(app/css/book-card.css);
</style>

<?php
include 'config/db.php';

include 'fetches/fetchCart.php';

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
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="col">
            <div class="card book-card">
                <div class="img-container">
                    <img src="<?php echo $row['book_img']; ?>" class="card-img-top img book-cover" alt="Product images" width="161.367px" height="243px">
                    <div class="overlay"> 
                        <button type="button" class="btn btn-dark blurb-btn" data-toggle="modal"
                            data-target="#blurb_modal_<?php echo $row['book_id']; ?>">Blurb
                        </button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5><?php echo $row['title']; ?></h5>
                        <p><?php echo $row['author_fname'] . ' ' . $row['author_lname']; ?> | <?php echo $row['genre']; ?></p>
                        <form method="POST">
                            <p>$<?php echo $row['price']; ?></p>
                    </div>
                </div>

                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                    
                    <!-- Product actions-->
                    <div class="d-grid gap-2 mb-5 d-md-block text-center">
                        <button type="submit" class="btn btn-dark">Buy Now</button>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="row">
                            <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2"
                            class="col form-control text-center border border-dark">
                            <div class="col text-center"><button type="submit" class="btn btn-dark mt-auto" name="add_to_cart">
                                <i class="fa fa-solid fa-cart-shopping"></i>
                            </button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal for Blurb -->
        <div class="modal" id="blurb_modal_<?php echo $row['book_id']; ?>">
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
        <?php
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src=""></script>
