<?php
session_start();
require '../config/db.php';

// Fetch all posts with username of author
$stmt = $conn->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Posts</title>
  <link rel="stylesheet" href="/blog_app/css/style.css">
  <style>
    .post-container {
      border: 1px solid #ccc;
      padding: 15px;
      margin: 10px 0;
      border-radius: 8px;
      background-color: #f9f9f9;
    }
    .post-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .post-actions a {
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>All Blog Posts</h1>
    <a href="create.php">Create New Post</a> |
    <a href="../auth/logout.php">Logout</a>

    <?php foreach ($posts as $post): ?>
      <div class="post-container">
        <div class="post-header">
          <h3><?php echo htmlspecialchars($post['title']); ?></h3>
          <span><em>By <?php echo htmlspecialchars($post['username']); ?></em></span>
        </div>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <small>Posted on: <?php echo $post['created_at']; ?></small><br>
        <?php if (!empty($post['updated_at'])): ?>
          <small><em>Edited</em> <?php echo $post['updated_at']; ?><br></small><br>
        <?php endif; ?>


        <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $post['user_id']): ?>
          <div class="post-actions"><br>
            <a href="update.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
