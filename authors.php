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
    <a href="add_book.php" class="btn btn-danger mb-3">Add book</a>
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
    $('#example').DataTable();
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