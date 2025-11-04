<?php
require_once 'vendor/autoload.php';
require_once 'config.php';

// Initialize Smarty
$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');
$smarty->setCacheDir(__DIR__ . '/cache');

$error = '';
$rememberedUsername = '';

// Check if user has a remember me cookie
if (isset($_COOKIE['remember_user']) && !isset($_SESSION['user_id'])) {
    $rememberedUsername = $_COOKIE['remember_user'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['remember_me']);
    
    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Handle "Remember Me" cookie
                if ($rememberMe) {
                    // Set cookie for 30 days
                    setcookie('remember_user', $username, time() + (30 * 24 * 60 * 60), '/', '', false, true);
                } else {
                    // Clear the cookie if unchecked
                    if (isset($_COOKIE['remember_user'])) {
                        setcookie('remember_user', '', time() - 3600, '/', '', false, true);
                    }
                }
                
                header('Location: index.php');
                exit();
            } else {
                $error = 'Invalid username or password.';
            }
        } catch(PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}

$smarty->assign('error', $error);
$smarty->assign('rememberedUsername', $rememberedUsername);
$smarty->display('login.tpl');
?>
