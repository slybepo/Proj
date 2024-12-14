<?php
session_start();
include('db.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reply_content = $_POST['reply'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    // Handle image upload (optional)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . basename($image_name);
        move_uploaded_file($image_tmp, $image_path);
    } else {
        $image_path = null;
    }

    // Insert reply into the database
    $stmt = $pdo->prepare("INSERT INTO replies (post_id, user_id, content, created_at) VALUES (:post_id, :user_id, :content, NOW())");
    $stmt->execute([
        'post_id' => $post_id,
        'user_id' => $user_id,
        'content' => $reply_content,
    ]);

    // Redirect back to the forum page
    header("Location: forum.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Similar design as in forum.php -->
</body>
</html>
