<?php
session_start();
include 'config/db.php';

if(empty($_SESSION['userlogin'])) {
    echo "<script>document.location='logout.php'</script>";
}

if(!empty($_SESSION['userlogin'])) {

    $urole = $_SESSION['urole'];
    if ($urole == "Admin") {
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
    <p>hi admin</p>
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