<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user'])) header("Location: ../auth/login.php");

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post || $post['user_id'] != $_SESSION['user']['id']) {
    die("Unauthorized action");
}

$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);
header("Location: read.php");