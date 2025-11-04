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

$error = '';
$success = '';

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
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$_SESSION['user_id'], $title, $content])) {
                $success = 'Post created successfully!';
                header('Location: posts.php');
                exit();
            } else {
                $error = 'Failed to create post. Please try again.';
            }
        } catch(PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}

$smarty->assign('error', $error);
$smarty->assign('success', $success);
$smarty->display('create_post.tpl');
?>
