<?php
session_start();
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the login page or homepage
header("Location: login.php");
exit();
?>
