<?php
$loggedin = 0;
if(isset($_SESSION["username"])) // is logged in?
{
$loggedin = 1;
}
else
{
    echo "<script>window.location = 'login.php'</script>"; // sends the user to login if username is not set
}
?>