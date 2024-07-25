<?php
include("header.php"); // Include header
include("auth.php"); // Include authentication

// Check if the video ID is provided in the URL
if(isset($_GET["v"])) {
    $video_id = $_GET["v"];
    
    // Fetch video details from the database using $video_id
    // Assuming you have a database connection named $connect
    // Example query to fetch video details
    $stmt = $connect->prepare("SELECT VideoName, VideoDesc FROM videodb WHERE VideoID = ?");
    $stmt->bind_param("s", $video_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $video = $result->fetch_assoc();

    // Check if the description is empty and set it to "No description.." if it is
    $video_desc = !empty($video['VideoDesc']) ? $video['VideoDesc'] : "No description..";

    // Display success message and video details
    echo "<div id='uploadSuccess'>";
    echo "<h2>Your video has been uploaded successfully!</h2>";
    echo "<h3>Video Details:</h3>";
    echo "<p><strong>Title:</strong> " . htmlspecialchars($video['VideoName']) . "</p>";
    echo "<p><strong>Description:</strong> " . htmlspecialchars($video_desc) . "</p>";
    echo "<p><strong>Video ID:</strong> " . htmlspecialchars($video_id) . "</p>";
    echo "<p><a href='watch.php?v=" . htmlspecialchars($video_id) . "'>Watch Your Video</a></p>";

    // Share the video link section
    $share_link = "https://distube.ct8.pl/watch.php?v=" . htmlspecialchars($video_id);
    echo "<p><strong>Share The Video, Link:</strong> <a href='" . $share_link . "'>" . $share_link . "</a></p>";

    echo "</div>";
} else {
    // If video ID is not provided, display an error message
    echo "<div id='uploadError'>";
    echo "<h2>Error: Video ID not provided!</h2>";
    echo "<p>Please make sure you have uploaded a video.</p>";
    echo "</div>";
}

include("footer.php"); // Include footer
?>
