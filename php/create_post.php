<?php
session_start();
include('db.php');

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . basename($image_name);

        // Move image to the uploads folder
        if (move_uploaded_file($image_tmp, $image_path)) {
            $image = $image_name;
        } else {
            echo "Failed to upload image.";
        }
    }

    // Insert post into the database
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content, image, created_at) 
                           VALUES (:user_id, :title, :content, :image, NOW())");
    $stmt->execute([
        'user_id' => $user_id,
        'title' => $title,
        'content' => $content,
        'image' => $image,
    ]);

    // Redirect back to the forum page
    header("Location: forum.php");
    exit();
}
?>
