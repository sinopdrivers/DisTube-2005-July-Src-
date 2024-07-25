<?php
$dsn = 'mysql:host=mysql.ct8.pl;dbname=;charset=utf8';
$db_username = 'distube'; // Replace with your database username
$db_password = 'password'; // Replace with your database password

try {
    $pdo = new PDO($dsn, $db_username, $db_password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

$stmt = $pdo->query("SELECT username, message, timestamp FROM messages ORDER BY id DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $message) {
    echo '<p><strong>' . htmlspecialchars($message['username']) . ':</strong> ' . htmlspecialchars($message['message']) . ' <small>(' . $message['timestamp'] . ')</small></p>';
}
?>
