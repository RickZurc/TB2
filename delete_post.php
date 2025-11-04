<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if post ID is provided
if (!isset($_GET['id'])) {
    header('Location: posts.php');
    exit();
}

$postId = (int)$_GET['id'];
$pdo = getDBConnection();

// Verify that the post belongs to the current user
$stmt = $pdo->prepare("SELECT user_id FROM posts WHERE id = ?");
$stmt->execute([$postId]);
$post = $stmt->fetch();

if (!$post || $post['user_id'] != $_SESSION['user_id']) {
    header('Location: posts.php');
    exit();
}

// Delete the post
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$postId, $_SESSION['user_id']]);

header('Location: posts.php');
exit();
?>
