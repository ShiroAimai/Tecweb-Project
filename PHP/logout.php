<?php
require_once('config.php');
unset($_SESSION['user_code']);
unset($_SESSION['user_name']);
unset($_SESSION['user_surname']);
header("Location:Home.php");
?>