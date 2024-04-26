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

<div class="container mt-3">
    <div class="card"></div>
</div>

<div class="container" style="margin-top:10px;">
<div class="card">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
           <tr>
                <th>Title</th>
                <th>Cover</th>
                <th>ISBN</th>
                <th>Author First Name</th>
                <th>Author Last Name</th>
                <th>Genre</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            <tr>
                <td>The Hunger Games</td>
                <td><img src="test-img/hungergames.jpg" width="48" height="73.25"></td>
                <td>9780439023528</td>
                <td>Suzanne</td>
                <td>Collins</td>
                <td>Young Adult</td>
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