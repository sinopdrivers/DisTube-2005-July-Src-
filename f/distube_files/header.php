<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
if ($detail2["registeredon"] == null) {
  $stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
  $stmt->bind_param("ss", $datenow, $username);
  $stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<center>
      <br>
      </center>
<table width="800" cellpadding="0" cellspacing="0" border="0" align="center">
  <tr>
    <td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
    

<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr valign="top">
    <td width="130" rowspan="2" style="padding: 0px 5px 5px 5px;"><a href="index.php"><img src="img/distube.png" width="120" height="48" alt="DisTube" border="0"></a></td>
    <td valign="top">
    
    <table width="670" cellpadding="0" cellspacing="0" border="0">
      <tr valign="top">
        <td style="padding: 0px 5px 0px 5px; font-style: italic;">Upload, tag and share your videos worldwide!</td>
        <td align="right">
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          
            <?php if(isset($_SESSION["username"])) {
    echo "<td><b>Hello, <a href='profile.php?user=".$username."'>".$username."</a></b></td>
    <td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a href='my_profile.php'>My Profile</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a href='logout.php'>Log Out</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a href='online_chat.php'>Chat</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a href='help.php'>Help</a></td>";
  } else {
    echo "<td><a href='signup.php'><strong>Sign Up</strong></a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a href='login.php'>Log In</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a href='help.php'>Help</a></td>";
  }?>

        
      </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
  </tr>

    <tr>
    <td width="100%">
    
    <div style="font-size: 12px; font-weight: bold; float: right; padding: 10px 5px 0px 5px;"><a href="my_videos_upload.php">Upload Videos</a> &nbsp;//&nbsp; <a href="browse.php">Browse Videos</a> <a href="my_friends_invite.php">     </a></div>
    
    <table cellpadding="2" cellspacing="0" border="0">
      <tr>
        <form method="GET" action="results.php">
        <td>
          <input type="text" value="" name="search" size="30" maxlength="128" style="color:#FF1493; font-size: 14px; padding: 2px;">
        </td>
        <td>
          <input type="submit" value="Search Videos">
        </td>
        </form>
      </tr>
    </table>
    
    </td>
  </tr>

      
</table>

<table align="center" width="100%" bgcolor="#D5E5F5" cellpadding="0" cellspacing="0" border="0" style="margin: 5px 0px 10px 0px;">
  <tr>
    <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
    <td><img src="img/pixel.gif" width="1" height="5"></td>
    <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
  </tr>
  <tr>
    <td><img src="img/pixel.gif" width="5" height="1"></td>
    
    <td width="100%">

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td>
                      <table cellpadding="2" cellspacing="0" border="0">
            <tr>
              <td>&nbsp;<a href="index.php">Home</a></td>
              <!--
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_videos.php">My Videos</a></td>
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_favorites.php">My Favorites</a></td>
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_friends.php">My Friends</a>&nbsp;<img src="img/new.gif"></td>
              -->
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_videos.php">My Videos</a></td>
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_favorites.php">My Favorites</a></td>
              <td>&nbsp;|&nbsp;</td>
              <td><a href="my_profile.php">My Profile</a></td>
            </tr>
            </table>
          </td>
        </tr>
      </table>
      
      </td>
  
    <td><img src="img/pixel.gif" width="5" height="1"></td>
  </tr>
  <tr>
    <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
    <td><img src="img/pixel.gif" width="1" height="5"></td>
    <td><img src="img/box_login_br.gif" width="5" height="5"></td>
  </tr>
</table>