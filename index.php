<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="/blog_app/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to the Blog App</h1>
    <?php if (!isset($_SESSION['user'])): ?>
      <a href="auth/register.php">Register</a> |
      <a href="auth/login.php">Login</a>
    <?php else: ?>
      <a href="dashboard.php">Dashboard</a> |
      <a href="auth/logout.php">Logout</a>
    <?php endif; ?>
  </div>
</body>
</html>
