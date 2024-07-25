<?php
// Include header
include 'header.php';

// Check if 'users' parameter is provided in the URL
if (isset($_GET['users'])) {
    // Retrieve the user ID from the query string
    $users = $_GET['users']; // Assuming users is passed through GET parameter, make sure to validate and sanitize this input

    // Database connection parameters
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

    // Fetch videos for the specified user from the database
    $sql = "SELECT title, url FROM videos WHERE user_id IN ($users)";
    $result = $conn->query($sql);

    // Check if videos are found
    if ($result->num_rows > 0) {
        // Fetch and display videos
        ?>

        <h1>Videos for Users <?php echo $users; ?></h1>
        <div class="video-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="video">
                    <h2><?php echo $row['title']; ?></h2>
                    <video controls>
                        <source src="<?php echo $row['url']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            <?php endwhile; ?>
        </div>

        <?php
    } else {
        // No videos found
        ?>
        <h1>No videos found for Users <?php echo $users; ?></h1>
        <?php
    }

    // Close database connection
    $conn->close();
} else {
    // 'users' parameter is missing
    ?>
    <h1>Error: This Feature will be added soon</h1>
    <?php
}

// Include footer
include 'footer.php';
?>
