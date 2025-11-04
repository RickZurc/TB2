<?php
/* Smarty version 5.6.0, created on 2025-11-04 20:00:14
  from 'file:dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_690a5b4e2d19e9_72636230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cea2e825916ca0acae37a014340b590ecfcb4b99' => 
    array (
      0 => 'dashboard.tpl',
      1 => 1762286102,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5b4e2d19e9_72636230 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .navbar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h2 {
            color: #333;
        }
        .logout-btn {
            padding: 10px 20px;
            background: #e53e3e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background: #c53030;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
        }
        .user-info {
            background: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .user-info p {
            margin: 10px 0;
            color: #555;
            font-size: 16px;
        }
        .user-info strong {
            color: #333;
        }
        .welcome-message {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
        }
        .welcome-message h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>User Dashboard</h2>
        <div style="display: flex; gap: 10px;">
            <a href="posts.php" style="padding: 10px 20px; background: #48bb78; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">View Posts</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="welcome-message">
            <h2>Welcome back, <?php echo $_smarty_tpl->getValue('user')['username'];?>
!</h2>
            <p>You are successfully logged in</p>
        </div>
        
        <h1>Your Profile</h1>
        <div class="user-info">
            <p><strong>User ID:</strong> <?php echo $_smarty_tpl->getValue('user')['id'];?>
</p>
            <p><strong>Username:</strong> <?php echo $_smarty_tpl->getValue('user')['username'];?>
</p>
            <p><strong>Email:</strong> <?php echo $_smarty_tpl->getValue('user')['email'];?>
</p>
        </div>
        
        <div style="margin-top: 30px; text-align: center;">
            <a href="posts.php" style="padding: 15px 40px; background: #48bb78; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 18px; display: inline-block;">Go to Community Posts</a>
        </div>
    </div>
</body>
</html>
<?php }
}
