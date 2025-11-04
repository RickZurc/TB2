<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

// Initialize Smarty
$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

// Create directories if they don't exist
if (!file_exists(__DIR__ . '/templates_c')) {
    mkdir(__DIR__ . '/templates_c', 0777, true);
}
if (!file_exists(__DIR__ . '/cache')) {
    mkdir(__DIR__ . '/cache', 0777, true);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

if ($isLoggedIn) {
    // User is logged in, show dashboard
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    $smarty->assign('user', $user);
    $smarty->display('dashboard.tpl');
} else {
    // User is not logged in, show login/register options
    $smarty->display('home.tpl');
}