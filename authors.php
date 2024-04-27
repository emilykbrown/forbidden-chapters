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

            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#author_modal">Add
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


    <table id="author-table" class="table table-striped table-bordered">
        <thead>
           <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Number of Books</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            <tr>
                <td>Suzanne</td>
                <td>Collins</td>
                <td>6</td>
                <td>Edit Delete</td>
            </tr>
        </tbody>
</table>
</div>
</div>
<script>

$(document).ready(function() {
    $('#author-table').DataTable();
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