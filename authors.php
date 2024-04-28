<?php
session_start();
include_once 'config/db.php';
if (isset($_COOKIE['user_id'])) {
	$user_id = $_COOKIE['user_id'];
} else {
	setcookie('user_id', create_unique_id(), time() + 60 * 60 * 24 * 30);
}


if(empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
}

if(!empty($_SESSION['userlogin'])) {

    $urole = $_SESSION['urole'];
    if ($urole == "Admin")
    {
        include 'src/fetchNewBook.php';

?>

<!DOCTYPE html>
<html lang="en">
<head> 
<?php
    include 'src/header.php';
?>    
</head>
<body>
<?php
  include 'src/adminNavbar.php';
?>

<div class="container mt-5">

            <button type="button" class="btn btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#author_modal">Add
                Author</button>

            <!-- The Modal -->
            <div class="modal" id="author_modal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <?php

                        include 'add_author.php';

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
            <tr>
                <?php
                $authors = $con->prepare("SELECT authors.author_fname, authors.author_lname, authors.author_id, COUNT(books.author_id) AS author_book_count
                FROM authors 
                LEFT JOIN books ON authors.author_id = books.author_id
                GROUP BY authors.author_id");
                $authors->execute();
                while ($author = $authors->fetch(PDO::FETCH_ASSOC)) {
                    extract($author);
                ?>
                <td><?php echo $author_id; ?></td>
                <td><?php echo $author_fname; ?></td>
                <td><?php echo $author_lname; ?></td>
                <td><?php echo $author_book_count; ?></td>
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

$(document).ready(function() {
    $('#author_table').DataTable();
} );


   
</script>
</body>
</html>

<?php
} else {
    echo "<script>document.location='logout.php'</script>";    
    }
} else {
    echo "<script>document.location='logout.php'</script>";
}
?>