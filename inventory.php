<?php
session_start();
include_once 'bin/db.php';
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
        
        include_once 'fetches/fetchNewBook.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/header.php'; ?>
</head>
<body>

<?php include 'components/adminNavbar.php'; ?>

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
                $books_tbl = $con->prepare("SELECT books.book_id, books.title, books.isbn, authors.author_fname, authors.author_lname, genres.genre, books.price, books.qty, books.book_img
                    FROM books
                    LEFT JOIN authors ON books.author_id = authors.author_id
                    LEFT JOIN genres ON books.genre_id = genres.genre_id
                    GROUP BY books.author_id");
                $books_tbl->execute();
                while ($book_row = $books_tbl->fetch(PDO::FETCH_ASSOC)) {
                    extract($book_row);
                    echo '<tr>';
                    echo '<td>', $book_id, '</td>';
                    echo '<td>', $title, '</td>';
                    echo '<td><img src="' . $book_img . '" width="75px" height="110px"></td>';
                    echo '<td>', $isbn, '</td>';
                    echo '<td>', $author_fname, '</td>';
                    echo '<td>', $author_lname, '</td>';
                    echo '<td>', $price, '</td>';
                    echo '<td>', $qty, '</td>';
                    echo '<td>', $genre, '</td>';
                    echo '<td>';
                    echo "<a href='edits/edit_book.php?id={$book_id}' name='edit-book' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp;&nbsp;";
                    echo "<button onclick='confirmDeleteBook($book_id)' name='delete-book' class='btn btn-danger btn-sm'><i class='fa-solid fa-x'></i></button>";
                    echo '</td>';
                    echo '</tr>';
                }; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#inventory_table').DataTable();
    });

    function confirmDeleteBook(book_id) {
        var result = confirm("Are you sure you want to delete this record?");
        if (result) {
            // Redirect to delete.php with the ID parameter
            window.location.href = 'edits/delete_book.php?id=' + book_id;
        } else {
            // Do nothing
        }
    }
</script>
</body>
</html>
<?php
}
}
?>