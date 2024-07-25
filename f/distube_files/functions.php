<?php
// Function to get favorite videos for a user from the database
function get_favorite_videos($user_id) {
    // Your database connection code
    // Assuming $conn is your database connection object
    
    // Prepare SQL query to fetch favorite videos for the user
    $sql = "SELECT * FROM favorites WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $favorite_videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $favorite_videos;
}
?>
