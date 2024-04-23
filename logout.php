<?php

session_start();
unset($_SESSION['userlogin']);
unset($_SESSION['urole']);
session_destroy();
header("location:index.php");

?>
