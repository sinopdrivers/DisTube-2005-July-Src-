<?php
include("header.php");

// Assuming you have some way to check if the user is logged in.
// For example, you might have a session variable set upon login.
// Replace '$_SESSION['loggedin']' with your actual check for logged in user.
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>

<title>Upload - DisTube</title>
<div id="uploadVid">
    <div class="tableSubTitle">Video Upload (Step 1 of 2)</div>  
    <form name="uploadForm" id="uploadForm" method="post" action="my_videos_upload_2.php" enctype="multipart/form-data" onsubmit="return validateForm()">
        <center>
            <table class="dataEntryTableSmall">
                <tbody>
                    <tr>
                      
                      Enter Your Title, And Description. that's all!
                        <td width="125px" align="right"><span style="font-size: 12px;font-weight:bold;">Title:</span></td>
                        <td><input type="text" name="title" id="title" maxlength="100" style="width:295px"></td>
                    </tr>
                    <tr>
                        <td valign="top" align="right"><span style="font-size: 12px;font-weight:bold;">Description:</span></td>
                        <td><textarea name="desc" maxlength="500" form="uploadForm" style="width:295px;overflow:hidden;resize:none" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td width="" align="right" style="white-space: nowrap;"></td>
                        <td>
                            <br>
                            <input type="submit" id="continue" name="continue" value="Continue ->">
                        </td>
                    </tr>   
                </tbody>
            </table>
        </center>
    </form>
</div>

<script>
function validateForm() {
    var title = document.getElementById("title").value;
    if (title.trim() == "") {
        alert("Please enter a title.");
        return false;
    }
    return true;
}
</script>

<?php
} else {
    // Redirect to login page or display a message indicating that the user needs to log in.
    echo "Please log in to upload video.";
}

include("footer.php");
?>
