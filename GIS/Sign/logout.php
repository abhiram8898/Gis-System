<?php session_start();
require '../CHF/connection.php'; 
require '../CHF/header.php'; 

session_destroy();
header("location:sign.php");

require '../CHF/footer.php'; ?>