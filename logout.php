<?php
session_start();
session_destroy();

// Optional: Clear remember me cookie on logout if user wants to
// If you want to keep the remembered username even after logout, comment out these lines
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, '/', '', false, true);
}

header('Location: index.php');
exit();
?>
