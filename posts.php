<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Initialize Smarty
$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

$pdo = getDBConnection();

// Get all posts with user information, ordered by newest first
$stmt = $pdo->prepare("
    SELECT p.*, u.username 
    FROM posts p 
    JOIN users u ON p.user_id = u.id 
    ORDER BY p.created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll();

// Get current user info
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$currentUser = $stmt->fetch();

$smarty->assign('posts', $posts);
$smarty->assign('currentUser', $currentUser);
$smarty->assign('currentUserId', $_SESSION['user_id']);
$smarty->display('posts.tpl');
?>
