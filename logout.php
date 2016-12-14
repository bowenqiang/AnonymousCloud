<?php
#Start Session:
session_start();
unset($_SESSION['username']);//Delete the username key
unset($_SESSION['category']);//Delete the username key
//session_destroy(); //Delete all session key
header('Location: login.php'); //

?>