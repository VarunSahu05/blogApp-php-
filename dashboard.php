<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="/blog_app/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Dashboard</h1>
    <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <a href="posts/create.php">Create Post</a> |
    <a href="posts/read.php">View Posts</a> |
    <a href="auth/logout.php">Logout</a>
  </div>
</body>
</html>
