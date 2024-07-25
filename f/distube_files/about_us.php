<?php 
session_start(); // Start the session at the beginning of the script
include("header.php"); 
?>
<table width="800" cellpadding="0" cellspacing="0" border="0" align="center">
  <tbody><tr>
    <td bgcolor="#FFFFFF" style="padding-bottom: 25px;">
      <div style="padding: 0px 5px 0px 5px;">

        <div class="tableSubTitle">About Us</div>

        <span class="highlight">About DisTube</span>

        <br><br>

        DisTube Was Created in June, This site provides a forum for people to connect, inform, and inspire others across the globe and acts as a distribution platform for original content creators.
        <br>
        
        <br>
        <br>
        
        <span class="highlight">What is DisTube?</span>
        
        <br>
        <br>
        DisTube is a way to get your videos to the people who matter to you. With DisTube you can:
        <ul>
          <li> Show off your favorite videos to the world</li>
          <li> Take videos of your dogs, cats, and other pets</li>
          <li> Blog the videos you take with your digital camera or cell phone</li>
          <li> Securely and privately show videos to your friends and family around the world</li>
          <li> ... and much, much more!</li>
        </ul>

        <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
          <br><span class="highlight"><a href="signup.php">Sign up now</a> and open a free account.</span>
        <?php endif; ?>

        <br><br><br>

        To learn more about our service, please see our <a href="help.php">Help</a> section.<br><br>

        Please feel free to <a href="contact.php">contact us</a>.

      </div>
    </td>
  </tr>
  </tbody>
</table>

<?php include("footer.php"); ?>
