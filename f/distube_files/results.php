<?php
// Include header
include('header.php');

// Database connection
$servername = "phpmyadmin";
$username = "riot";
$password = "password";
$dbname = "distube";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search query
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch videos from the videodb table based on search query
$sql = "SELECT VideoID, VideoName, VideoDesc, Uploader, UploadDate, ViewCount, VideoCategory, VideoFile, CustomThumbnail 
        FROM videodb 
        WHERE VideoName LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%$search_query%";
$stmt->bind_param('s', $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Search form -->
<form method="GET" action="results.php">
    <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search for videos...">
    <input type="submit" value="Search">
</form>

<?php
if ($result->num_rows > 0) {
    echo "<table width='100%' cellpadding='4' cellspacing='0' border='0'>";
    
    $count = 0;
    while ($fetch = $result->fetch_assoc()) {
        $idvideolist = $fetch['VideoID'];
        $namevideolist = htmlspecialchars($fetch['VideoName']);
        $uploadervideolist = htmlspecialchars($fetch['Uploader']);
        $uploadvideolist = htmlspecialchars($fetch['UploadDate']);
        $viewsvideolist = htmlspecialchars($fetch['ViewCount']);

        if ($count == 0) {
            echo "<tr valign='top'>";
        }
        echo "<td width='20%' align='center'>
                <a href='watch.php?v=".$idvideolist."'><img src='./content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" width='120' height='90' class='moduleFeaturedThumb'></a>
                <div class='moduleFeaturedTitle'><a href='watch.php?v=".$idvideolist."'>".$namevideolist."</a></div>
                <div class='moduleFeaturedDetails'>
                  Added: ".$uploadvideolist."<br>
                  by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
                </div>
                <div class='moduleFeaturedDetails'>
                  Views: ".$viewsvideolist."
                </div>
              </td>";
        $count++;
        if ($count == 4) {
            echo "</tr>";
            $count = 0;
        }
    }
    if ($count > 0) {
        echo "</tr>"; // Close the last row if it wasn't closed already
    }
    echo "</table>";
} else {
    echo "<p>No videos found matching your search criteria.</p>";
}

// Close connection
$stmt->close();
$conn->close();

// Include footer
include('footer.php');
?>
