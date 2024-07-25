<?php
session_start(); // Start the session

// Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php"); // Redirect to homepage or another appropriate page
    exit;
}

include("header.php");
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if(isset($_POST["signupsubmit"])){
    if(ctype_alnum($_POST["username"])) {
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim(htmlspecialchars($_POST["username"]));
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username = trim(htmlspecialchars($_POST["username"]));
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        $username_err = "Username must be alphabetical-numerical, special characters or spaces not permitted.";
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && $username !== "default/default"){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>window.location = 'login.php'</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
        $username_err = "Please re-enter your account credentials.";
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<table width="800" cellpadding="0" cellspacing="0" border="0" align="center">
  <tbody><tr>
    <td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
      <div style="padding: 0px 5px 0px 5px;">
        <script>
          function formValidator()
          {
            var signup_button = document.getElementById("signupbutton");
            signup_button.disabled='true';
            signup_button.value='Please wait...';
          }
        </script>

        <div class="tableSubTitle">Sign Up</div>

        Please enter your account information below. All fields are required.<br><br>
        <table width="100%" cellpadding="5" cellspacing="0" border="0">
          <form method="post" onsubmit="return formValidator();" action="signup.php">
            <tbody>
              <tr>
                <td align="right"><span class="label">User Name:</span></td>
                <td><input type="text" size="20" maxlength="20" name="username" value=""></td>
              </tr>
              <tr>
                <td align="right"><span class="label">Password:</span></td>
                <td><input type="password" size="20" maxlength="20" name="password" value=""></td>
              </tr>
              <tr>
                <td align="right"><span class="label">Retype Password:</span></td>
                <td><input type="password" size="20" maxlength="20" name="confirm_password" value=""></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><br>- I certify I am over 13 years old.
                <br>- I agree to the <a href="terms.php" target="_blank">terms of use</a> and <a href="privacy.php" target="_blank">privacy policy</a>.</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="signupsubmit" id="signupsubmit" type="submit" value="Sign Up"></td>
              </tr>
            </tbody>
          </form>
          
          <tr>
            <td>&nbsp;</td>
            <td><?php echo $username_err; ?></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><?php echo $password_err; ?></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><?php echo $confirm_password_err; ?></td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><br>Or, <a href="/">return to the homepage</a>.</td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</tbody></table>

<?php
include("footer.php");
?>
>