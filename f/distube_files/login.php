<?php
include("header.php");
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script>history.go(-1)</script>";
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["loginsubmit"])){
  
  $onlinenow = date('h');
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim(htmlspecialchars($_POST["username"]));
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){             
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
              
                            // Redirect user to welcome page
                            echo "<script>window.location.replace('index.php');</script>";
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<table width="800" cellpadding="0" cellspacing="0" border="0" align="center">
  <tbody><tr>
    <td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
    





<div style="padding: 0px 5px 0px 5px;">


<div class="tableSubTitle">Log In</div>

<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
  <tbody><tr valign="top">
    <td style="padding-right: 15px;" width="510">
    
    
    <span class="highlight">What is DisTube?</span>

    DisTube is a way to get your videos to the people who matter to you. With DisTube you can:
    
    <ul>
    <li> Show off your favorite videos to the world
    </li><li> Blog the videos you take with your digital camera or cell phone
    </li><li> Securely and privately show videos to your friends and family around the world
    </li><li> ... and much, much more!
    </li></ul>

    <br><span class="highlight"><a href="signup.php">Sign up now</a> and open a free account.</span>
    <br><br><br>
    
    To learn more about our service, please see our <a href="help.php">Help</a> section.<br><br><br>
    </td>
    <td width="280">
    
    <table width="280" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#E5ECF9">
      <tbody><tr>
        <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
        <td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
        <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
      </tr>
      <tr>
        <td><img src="img/pixel.gif" width="5" height="1"></td>
        <td align="center">
    <table width="100%" cellpadding="5" cellspacing="0" border="0">
      <form method="post" name="loginForm" id="loginForm" action="login.php">

      <input type="hidden" name="field_command" value="login_submit">
        <tbody><tr>
          <td align="center" colspan="2"><div style="font-size: 14px; font-weight: bold; color:#003366; margin-bottom: 5px;">DisTube Log In</div></td>
        </tr>
        <tr>
          <td align="right"><span class="label">User Name:</span></td>
          <td><input tabindex="1" type="text" size="20" name="username" value=""></td>
        </tr>
        <tr>
          <td align="right"><span class="label">Password:</span></td>
          <td><input tabindex="2" type="password" size="20" name="password"></td>
        </tr>
        <tr>
          <td align="right"><span class="label">&nbsp;</span></td>
          <td><input type="submit" value="Log In" name="loginsubmit"></td>
        </tr>
        <tr>
          <td align="center" colspan="2"><a href="forgot.php">Forgot your password?</a><br><br></td>
        </tr>
      </form>
      <script language="javascript">
        onLoadFunctionList.push(function(){ document.loginForm.field_login_username.focus(); });
      </script>
      </tbody></table>
      
      </td>
        <td><img src="img/pixel.gif" width="5" height="1"></td>
      </tr>
      <tr>
        <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
        <td><img src="img/pixel.gif" width="1" height="5"></td>
        <td><img src="img/box_login_br.gif" width="5" height="5"></td>
      </tr>
    </tbody></table>
      
    </td>
  </tr>
</tbody></table>
    </div>
    </td>
  </tr>
</tbody></table>
<?php include("footer.php"); ?>