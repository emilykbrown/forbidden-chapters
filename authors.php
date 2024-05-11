<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config/db.php';

// function create_unique_id() {
//     return uniqid('user_', true);
// }

if (isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
} else {
	setcookie('user_id', uniqid(), time() + 60 * 60 * 24 * 30);
}

if (empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
    exit;
}

if (!empty($_SESSION['userlogin'])) {
    $urole = $_SESSION['urole'];
    if ($urole == "Admin") {
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include 'components/header.php';
?>
</head>
<body>
<?php
    include 'components/adminNavbar.php';
?>

<div class="container mt-5">
    <button type="button" class="btn btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#author_modal">Add Author</button>
    <div class="modal" id="author_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php
                include 'modals/add_author.php';
                ?>
            </div>
        </div>
    </div>
    <div class="card">
        <table id="author_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Author ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number of Books</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $authors_tbl = $con->prepare("SELECT authors.author_fname, authors.author_lname, authors.author_id, COUNT(books.author_id) AS author_book_count
                FROM authors 
                LEFT JOIN books ON authors.author_id = books.author_id
                GROUP BY authors.author_id");
                $authors_tbl->execute();
                while ($author_row = $authors_tbl->fetch(PDO::FETCH_ASSOC)) {
                    extract($author_row);
                    echo '<tr>';
                    echo '<td>', $author_id, '</td>';
                    echo '<td>', $author_fname, '</td>';   
                    echo '<td>', $author_lname, '</td>';   
                    echo '<td>', $author_book_count, '</td>';
                    echo '<td>';
                    echo "<a href='edits/edit_author.php?id={$author_id}' name='edit-author' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>&nbsp;&nbsp;";
                    echo "<button onclick='confirmAuthorDelete()' class='btn btn-sm btn-danger deleteBtn' id='deleteBtn'><i class='fa-solid fa-x'></i></button>";
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#author_table').DataTable();
});

function confirmAuthorDelete() {
    var result = confirm("Are you sure you want to delete this author?");
    if (result) {
        // Redirect to delete.php with the ID parameter
        window.location.href = 'edits/delete_author.php?id=<?php echo $author_id; ?>';
    } else {
        // Do nothing
    }
}

</script>
</body>
</html>

<?php
    } else {
        echo "<script>document.location='logout.php'</script>";
        exit;
    }
} else {
    echo "<script>document.location='logout.php'</script>";
    exit;
}
?>
