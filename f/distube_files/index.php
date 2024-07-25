<?php
include("header.php");
session_start();
?>
<html>
<head>
    <title>DisTube</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="description" content="Share your videos with friends and family">
    <meta name="keywords" content="video,sharing,camera phone,video phone">
    <script language="javascript" type="text/javascript">
        onLoadFunctionList = new Array();
        function performOnLoadFunctions() {
            for (var i in onLoadFunctionList) {
                onLoadFunctionList[i]();
            }
        }
    </script>
</head>
<body onload="performOnLoadFunctions();">
<table width="790" align="center" cellpadding="0" cellspacing="0" border="0">
    <tr valign="top">
        <td style="padding-right: 15px;">
            <table class="roundedTable" width="595" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#e5ecf9">
                <tr>
                    <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
                    <td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
                </tr>
                <tr>
                    <td><img src="img/pixel.gif" width="5" height="1"></td>
                    <td width="585">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr valign="top">
                                <td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
                                    <div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="my_videos_upload.php">Upload</a></div>
                                    Quickly upload and tag videos in almost any video format.
                                </td>
                                <td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
                                    <div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="browse.php">Watch</a></div>
                                    Instantly find and watch 1000's of fast streaming videos.
                                </td>
                                <td width="33%" style="padding: 0px 10px 10px 10px; color: #444;">
                                    <div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><a href="share.php">Share</a></div>
                                    Easily share your videos with family, friends, or co-workers.
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
            <!-- begin recently featured -->
            <table class="roundedTable" width="595" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
                <tr>
                    <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
                    <td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
                </tr>
              <br>
                <tr>
                    <td><img src="img/pixel.gif" width="5" height="1"></td>
                    <td width="585">
                        <div class="sunkenTitleBar">
                            <div class="sunkenTitle">
                                <div style="float: right; padding: 1px 5px 0px 0px; font-size: 12px;"><a href="browse.php">See More Videos</a></div>
                                <span style="color:#444;">Today's Featured Videos</span>
                            </div>
                        </div>
                    </td>
                    <td><img src="img/pixel.gif" width="5" height="1"></td>
                </tr>
                <tr>
                    <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
                    <td><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_br.gif" width="5" height="5"></td>
                </tr>
            </table>
            <!-- end recently featured -->
        </td>
        <td width="180">
            <table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffeebb">
                <tr>
                    <td><img src="img/box_login_tl.gif" width="5" height="5"></td>
                    <td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_tr.gif" width="5" height="5"></td>
                </tr>
                <tr>
                    <td><img src="img/pixel.gif" width="5" height="1"></td>
                    <td width="170">
                        <div style="font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo '<a href="error.php">Invite Your Friends To Join This Site</a>';
                            } else {
                                echo '<a href="signup.php">Sign up for your free account!</a>';
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><img src="img/pixel.gif" width="5" height="1"></td>
                </tr>
                <tr>
                    <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
                    <td><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_br.gif" width="5" height="5"></td>
                </tr>
            </table>
<br>

            <!-- Last Users Online Section -->
            <table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#FFFBA1">
                <tr>
                    <td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
                    <td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
                    <td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
                </tr>
                <tr>
                    <td><img src="/img/pixel.gif" width="5" height="1"></td>
                    <td width="170">
                        <?php
                        // Database connection details
                        $servername = "mysql2.serv00.com";
                        $username = "m4447_notspot";
                        $password = "Ad150169@@";
                        $dbname = "m4447_tvsscenes";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // SQL query to retrieve last users online
                        $sql = "SELECT * FROM users ORDER BY last_online DESC LIMIT 10"; // Change the limit as per your requirement

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            echo "<div style='font-size: 16px; font-weight: bold; text-align: center; padding: 5px 5px 10px 5px;'>Last 10 users online...</div>";
                            echo "<ul>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<li>" . $row["username"] . " - Last Online: " . $row["last_online"] . "</li><br>";
                            }
                            echo "</ul>";
                        } else {
                            echo "No users online currently.";
                        }
                        $conn->close();
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><img src="/img/pixel.gif" width="5" height="1"></td>
                </tr>
                <tr>
                    <td><img src="img/box_login_bl.gif" width="5" height="5"></td>
                    <td><img src="img/pixel.gif" width="1" height="5"></td>
                    <td><img src="img/box_login_br.gif" width="5" height="5"></td>
                </tr>
            </table>
            <!-- End of Last Users Online Section -->

        </td>
    </tr>
</table>

<div id="sheet" style="position:fixed; top:0px; visibility:hidden; width:100%; text-align:center;">
    <table width="100%">
        <tr>
            <td align="center">
                <div id="sheetContent" style="filter:alpha(opacity=50); -moz-opacity:0.5; opacity:0.5; border: 1px solid black; background-color:#cccccc; width:40%; text-align:left;"></div>
            </td>
        </tr>
    </table>
</div>

<?php include("footer.php"); ?>
</body>
</html>
