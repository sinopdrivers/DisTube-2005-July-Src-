<!-- apparently some people don't believe i can program in php smh...
epic10 channels will be the programmed by me. -->
<?php
include('header.php');
$aboutme = addslashes($_POST['desc']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET aboutme=? WHERE username=?");
$stmt->bind_param("ss", $aboutme, $user); // set your about me for your channel through prepared statements
$stmt->execute();
echo "<br><br><center><h1>Your About Me has been set.</h1></center><br><br>"; // pog
?>