<?php
session_start();
include("db.php");
$i = 1; // i does the count
$id = $_POST["video_id"]; // get video id so it knows what video you are going to comment
$comment = $_POST["comment"]; // what are you going to comment?
$commentid = 0; // initialize
$datenow = date("Y-m-d"); // get the current date

// Check connection
if ($connect->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sqllist = 'SELECT id, commentid, comment, user, date FROM comments ORDER by commentid DESC'; // to count what comment id is next
$result = $connect->query($sqllist);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  if($row["id"] = $id) {
		  $i++;
	  }
  }
} else {

}
$commentid = $i;
$username = $_SESSION["username"];
if(!empty($_SESSION["username"])) {
	$stmt = $connect->prepare("INSERT INTO comments (id, commentid, comment, user, date) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sisss", $id, $commentid, $comment, $username, $datenow); // prepared statements for inserting comments into db
	$stmt->execute();
	echo "<script>window.location = 'watch.php?v=".$id."'</script>";
} else {
	echo "You are not logged in.";
}
?>