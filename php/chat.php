<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (user_id, message) VALUES (:user_id, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'message' => $message]);
}

$sql = "SELECT messages.*, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.timestamp ASC";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content
