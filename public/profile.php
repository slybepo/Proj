<?php
include '../includes/config.php';

$unique_id = $_GET['id'] ?? null;
if (!$unique_id) {
    die('Invalid user ID');
}

$stmt = $pdo->prepare("SELECT username, role, avatar FROM users WHERE unique_id = ?");
$stmt->execute([$unique_id]);
$user = $stmt->fetch();

if (!$user) {
    die('User not found');
}

echo "<h1>{$user['username']}'s Profile</h1>";
echo "<img src='/assets/images/{$user['avatar']}' alt='Avatar'>";
echo "<p>Role: {$user['role']}</p>";
?>
