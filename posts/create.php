<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user'])) header("Location: ../auth/login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['content'], $_SESSION['user']['id']]);
    header("Location: read.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Post</title>
  <link rel="stylesheet" href="/blog_app/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Create a New Post</h1>
    <form method="POST">
      <label>Title:</label>
      <input type="text" name="title" required><br>
      <label>Content:</label><br>
      <textarea name="content" rows="5" cols="40" required></textarea><br>
      <input type="submit" value="Add Post">
    </form>
  </div>
</body>
</html>