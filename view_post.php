<?php
require_once 'vendor/autoload.php';
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

// Get post details with user information
$stmt = $pdo->prepare("
    SELECT p.*, u.username 
    FROM posts p 
    JOIN users u ON p.user_id = u.id 
    WHERE p.id = ?
");
$stmt->execute([$postId]);
$post = $stmt->fetch();

if (!$post) {
    header('Location: posts.php');
    exit();
}

// Initialize Smarty
$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

$smarty->assign('post', $post);
$smarty->assign('currentUserId', $_SESSION['user_id']);
$smarty->display('view_post.tpl');
?>
