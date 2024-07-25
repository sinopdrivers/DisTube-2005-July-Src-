<?php
include("header.php");
if(isset($_POST['prof_name'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_name=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_age'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_age=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_city'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_city=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_hometown'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_hometown=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_country'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_country=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_occupation'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_occupation=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_interests'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_interests=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_music'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_music=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_books'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_books=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_movies'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_movies=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
if(isset($_POST['prof_website'])) {
$setinfo = addslashes($_POST['textbox']); // addslashes for quotes
$user = $_SESSION['username']; // get username to set about to
$stmt = $connect->prepare("UPDATE users SET prof_website=? WHERE username=?");
$stmt->bind_param("ss", $setinfo, $user);
$stmt->execute();
echo "<br><br><center><h1>Set info.</h1></center><br><br>";
}
?>