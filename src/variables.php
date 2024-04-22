<?php

$nameRegex = '/^[a-zA-Z\s]+$/';
$emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$usernameRegex = '/^[a-zA-Z0-9_-]{3,20}$/';
$phoneRegex = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
$upassRegex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{6,}$/';

// Validation
$fnameValid = false;
$lnameValid = false;
$emailValid = false;
$usernameValid = false;
$phoneValid = false;
$upassValid = false;
$cpassValid = false;


// Variables
$fnameError = "";
$lnameError = "";
$emailError = "";
$usernameError = "";
$phoneError = "";
$upassError = "";
$cpassError = "";

?>