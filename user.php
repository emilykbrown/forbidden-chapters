<?php
session_start();
include 'config/db.php';

if(empty($_SESSION['userlogin']) == 0) {
    echo "<script>document.location='signup.php'</script>";
}

if(!empty($_SESSION['userlogin']) == 0) {
    $urole = $_SESSION['userlogin'];
    if ($urole == "User") {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>hi user</p>
</body>
</html>

<?php
    }
}
?>