<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user'])) header("Location: ../auth/login.php");

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post || $post['user_id'] != $_SESSION['user']['id']) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$_POST['title'], $_POST['content'], $id]);
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$_POST['title'], $_POST['content'], $id]);

    header("Location: read.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Post</title>
  <link rel="stylesheet" href="/blog_app/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Edit Post</h1>
    <form method="POST">
      <label>Title:</label>
      <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
      <label>Content:</label><br>
      <textarea name="content" rows="5" cols="40" required><?= htmlspecialchars($post['content']) ?></textarea><br>
      <input type="submit" value="Update Post">
    </form>
  </div>
</body>
</html>