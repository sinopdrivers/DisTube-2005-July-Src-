<?php
include("header.php");

if (isset($_GET["user"])) {
    $user = $_GET["user"];
}

// If $user is not set, terminate the script
if (!isset($user)) {
    die("User not specified.");
}

// Assuming you store the logged-in user's username in a session variable
session_start();
$loggedInUser = $_SESSION['username'] ?? null;

$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='" . mysqli_real_escape_string($connect, $user) . "'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);

if (!$cdf) {
    die("User not found.");
}

$LastestVideo = htmlspecialchars($cdf['recent_vid']);
$Username = htmlspecialchars($cdf['username']);
$AboutMe = htmlspecialchars($cdf['aboutme']);
$VidsWatched = $cdf['videos_watched'];
$Name = htmlspecialchars($cdf['prof_name']);
$Age = htmlspecialchars($cdf['prof_age']);
$City = htmlspecialchars($cdf['prof_city']);
$Hometown = htmlspecialchars($cdf['prof_hometown']);
$Country = htmlspecialchars($cdf['prof_country']);
$Occupation = htmlspecialchars($cdf['prof_occupation']);
$Interests = htmlspecialchars($cdf['prof_interests']);
$Music = htmlspecialchars($cdf['prof_music']);
$Books = htmlspecialchars($cdf['prof_books']);
$Movies = htmlspecialchars($cdf['prof_movies']);
$Website = htmlspecialchars($cdf['prof_website'] ?? '');

$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j, Y');
?>
<meta name="title" content="<?php echo $Username ?>'s Channel">
<meta name="description" content="<?php echo $AboutMe ?>">
<title><?php echo $Username ?> - DisTube</title>
<div style="padding: 0px 5px 0px 5px;">

    <div style="background-color: #f0f0f0; padding: 10px; margin-bottom: 10px; text-align: center;">
        <span style="font-size: 16px; font-weight: bold; color: #003366;">Hi, I'm <?php echo $Username ?>!</span>
    </div>

    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
        <table width="100%" align="center" cellpadding="5" cellspacing="0" border="0">
            <tr>
                <td width="120" align="right"><span class="label">User Name:</span></td>
                <td><?php echo $Username ?></td>
            </tr>

            <!-- Personal Information: -->
            <tr>
                <td align="right"><span class="label">Name:</span></td>
                <td><?php echo $Name ?></td>
            </tr>

            <tr valign="top">
                <td align="right"><span class="label">Age:</span></td>
                <td><?php echo $Age ?></td>
            </tr>

            <tr valign="top">
                <td align="right"><span class="label">About Me:</span></td>
                <td><?php echo $AboutMe ?></td>
            </tr>

            <tr>
                <td align="right"><span class="label">Date Joined On:</span></td>
                <td><?php echo $RegisteredOn ?></td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <!-- Location Information -->
            <tr valign="top">
                <td align="right"><span class="label">Hometown:</span></td>
                <td><?php echo $Hometown ?></td>
            </tr>

            <tr valign="top">
                <td align="right"><span class="label">Current City:</span></td>
                <td><?php echo $City ?></td>
            </tr>

            <tr valign="top">
                <td align="right"><span class="label">Country:</span></td>
                <td><?php echo $Country ?></td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <!-- Random Information -->
            <tr valign="top">
                <td align="right"><span class="label">Personal Website:</span></td>
                <td><a href="<?php echo $Website ?>"><?php echo $Website ?></a></td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <!-- Contact Me and Add As Friend Buttons -->
            <tr>
                <td colspan="2">
                    <?php if ($loggedInUser): ?>
                        <?php if ($loggedInUser !== $Username): ?>
                            <form method="post" action="outbox.php?user=<?php echo $Username ?>">
                                <input type="submit" value="Contact Me">
                            </form>
                            <form method="post" action="add_friend.php">
                                <input type="hidden" name="friend_id" value="<?php echo htmlspecialchars($user) ?>">
                                <input type="submit" value="Add As Friend">
                            </form>
                        <?php else: ?>
                            <p>You cannot contact or friend yourself.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>You must be logged in to contact or friend users.</p>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

</div>

<?php include("footer.php"); ?>
