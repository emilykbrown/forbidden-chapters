<?php
session_start();
include 'config/db.php';
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
    if ($urole == "User") {
        echo $urole;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
  include 'src/header.php';
  ?>
</head>
<body>
    <p>hi user</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</body>
</html>

<?php
    } else {
        //echo "<script>document.location='logout.php'</script>";
        echo "foo";
    }
} else {
    // echo"<script>document.location='logout.php'</script>";
    echo "bar";
}
?>