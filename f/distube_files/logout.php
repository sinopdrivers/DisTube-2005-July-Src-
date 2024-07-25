<?php
// Initialize the session
session_start();
include("db.php");
$username = $_SESSION["username"];
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
echo "<script>history.go(-1)</script>";
exit;
?>