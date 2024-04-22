<?php

if(isset($_POST['login'])) {
    include 'config/db.php';
   
    // Set variables
    $id = create_unique_id();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $upass = $_POST['upass'];
    // Fetch data from database from 
    $query = "SELECT fname, lname, username, email, phone, upass, urole FROM users WHERE (username=:username || email=:username)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Matching username and password
    if ($stmt->rowCount() == 1) {
      foreach ($results as $row) {
        $hashpass = $row->upass;
        $urole = $row->urole;
      }
      if(password_verify($upass, $hashpass) &&($urole == 'User' || $urole == 'Admin')) {
        $_SESSION['userlogin'] = $_POST['username'];
        $_SESSION['urole'] = $urole;
        print_r($_SESSION['userlogin']); 
       if($urole == 'Admin' ) {
        echo "<script>document.location='admin.php'</script";
      } if ($urole == 'User') {
        echo "<script>document.location='user.php'</script>";
      } 
    } else {
      echo "Wrong username or password. Please try again";
    } 
}
}

?>