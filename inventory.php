<?php
session_start();
include_once 'config/db.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30);
}

if (empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
}

if (!empty($_SESSION['userlogin'])) {

    $urole = $_SESSION['urole'];
    if ($urole == "Admin") {
        include 'src/fetchNewBook.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'src/header.php'; ?>
</head>
<body>

<?php include 'src/adminNavbar.php'; ?>

<div class="container mt-5">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#book_modal">Add Book</button>

    <!-- The Modal -->
    <div class="modal" id="book_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php include 'add_book.php'; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <table id="inventory_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Book Id</th>
                    <th>Title</th>
                    <th>Cover</th>
                    <th>ISBN</th>
                    <th>Author First Name</th>
                    <th>Author Last Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Genre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $books_tbl = $con->prepare("SELECT books.id, books.title, books.isbn, authors.author_fname, authors.author_lname, genres.genre, books.price, books.qty, books.cover
                    FROM books
                    LEFT JOIN authors ON books.author_id = authors.author_id
                    LEFT JOIN genres ON books.genre_id = genres.genre_id
                    GROUP BY books.author_id");
                $books_tbl->execute();
                while ($book_row = $books_tbl->fetch(PDO::FETCH_ASSOC)) {
                    extract($book_row);
                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $cover; ?></td>
                    <td><?php echo $isbn; ?></td>
                    <td><?php echo $author_fname; ?></td>
                    <td><?php echo $author_lname; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $qty ?></td>
                    <td><?php echo $genre; ?></td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-x"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#inventory_table').DataTable();
    });
</script>

</body>
</html>
<?php
}
}
?>