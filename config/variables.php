<?php

// Regex
$nameRegex = '/^[a-zA-Z\s]+$/';
$emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$usernameRegex = '/^[a-zA-Z0-9_-]{3,20}$/';
$phoneRegex = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
$upassRegex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{6,}$/';
$textRegex = '/^[0-9a-zA-Z_ ]+$/';
$isbnRegex = '/^(97(8|9))?\d{9}(\d|X)$/';
$priceRegex = '/^\$?([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/';
$qtyRegex = '/^[1-9]{1}\d*$/';
$imgRegex = '/^.*\.(jpg|JPG|png|PNG|jpeg|JPEG)$/';

// Variables
$fnameError = "";
$lnameError = "";
$emailError = "";
$usernameError = "";
$phoneError = "";
$upassError = "";
$cpassError = "";
$titleError = "";
$isbnError = "";
$authorSelectError = "";
$genreSelectError = "";
$blurbError = "";
$priceError = "";
$qtyError = "";
$imgError = "";
$author_fnameError = "";
$author_lnameError = "";
$genreError = "";

?>