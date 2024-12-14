<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div id="user-info">
        <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
        <div id="dropdown">
            <a href="chat.php">Go to Chat</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</header>

<div class="container">
    <h2>User Home Page</h2>
    <p>Welcome to the chat application, <?php echo htmlspecialchars($username); ?>!</p>
</div>

</body>
</html>
