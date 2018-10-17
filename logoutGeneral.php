<?php
//logout.php
session_start();
unset($_SESSION['username']);
unset($_SESSION['pharmacy_id']);
header("location:loginpage");
?>