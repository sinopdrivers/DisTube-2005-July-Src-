<?php
// Start session to access session variables
session_start();

// Include header
include('header.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit(); // Stop script execution
}

// Check if the video ID is provided
if (isset($_GET['id'])) {
    // Retrieve the video ID from the GET parameter
    $video_id = $_GET['id'];

    // Connect to the database
    $host = 'phpmyadmin'; // Change this to your database host
    $username = 'riot'; // Change this to your database username
    $password = 'password'; // Change this to your database password
    $database = 'distube'; // Change this to your database name

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a select statement to check if the video belongs to the logged-in user
    $sql = "SELECT * FROM videodb WHERE VideoID = ? AND Uploader = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error: " . $conn->error;
    } else {
        // Bind parameters
        $stmt->bind_param("ss", $video_id, $_SESSION['username']);

        // Execute the statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if the video belongs to the logged-in user
        if ($result->num_rows === 1) {
            // If the video belongs to the user, proceed with deletion
            // Prepare a delete statement
            $delete_sql = "DELETE FROM videodb WHERE VideoID = ?";
            $delete_stmt = $conn->prepare($delete_sql);

            if ($delete_stmt === false) {
                echo "Error: " . $conn->error;
            } else {
                // Bind parameters
                $delete_stmt->bind_param("s", $video_id);

                // Execute the delete statement
                if ($delete_stmt->execute()) {
                    echo "Video deleted successfully!";
                } else {
                    echo "Error deleting video: " . $delete_stmt->error;
                }

                // Close delete statement
                $delete_stmt->close();
            }
        } else {
            // If the video does not belong to the user, display an error message
            echo "You are not authorized to delete this video.";
        }

        // Close select statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    // If no video ID is provided, display an error message
    echo "No video ID provided.";
}

// Include footer
include('footer.php');
?>
