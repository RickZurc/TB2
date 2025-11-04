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

// Verify that the post belongs to the current user
$stmt = $pdo->prepare("SELECT user_id FROM posts WHERE id = ?");
$stmt->execute([$postId]);
$post = $stmt->fetch();

if (!$post || $post['user_id'] != $_SESSION['user_id']) {
    header('Location: posts.php');
    exit();
}

// Initialize Smarty
$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

$error = '';

// Get current post data
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$postId]);
$currentPost = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    
    // Validation
    if (empty($title) || empty($content)) {
        $error = 'Title and content are required.';
    } elseif (strlen($title) < 3) {
        $error = 'Title must be at least 3 characters long.';
    } elseif (strlen($content) < 10) {
        $error = 'Content must be at least 10 characters long.';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
            
            if ($stmt->execute([$title, $content, $postId, $_SESSION['user_id']])) {
                header('Location: posts.php');
                exit();
            } else {
                $error = 'Failed to update post. Please try again.';
            }
        } catch(PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}

$smarty->assign('post', $currentPost);
$smarty->assign('error', $error);
$smarty->display('edit_post.tpl');
?>
