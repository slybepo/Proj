<?php
include '../includes/config.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $unique_id = generateUniqueId();

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, unique_id) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $email, $password, $unique_id]);
        header('Location: login.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!-- Registration Form -->
<form method="post" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
