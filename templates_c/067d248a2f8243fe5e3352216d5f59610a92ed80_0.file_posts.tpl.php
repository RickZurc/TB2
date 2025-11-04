<?php
/* Smarty version 5.6.0, created on 2025-11-04 20:00:01
  from 'file:posts.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.6.0',
  'unifunc' => 'content_690a5b4156fbe1_48157381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '067d248a2f8243fe5e3352216d5f59610a92ed80' => 
    array (
      0 => 'posts.tpl',
      1 => 1762286103,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_690a5b4156fbe1_48157381 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Posts</title>
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
            flex-wrap: wrap;
            gap: 15px;
        }
        .navbar h2 {
            color: #333;
        }
        .nav-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .nav-links a {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background: #5568d3;
        }
        .btn-secondary {
            background: #48bb78;
            color: white;
        }
        .btn-secondary:hover {
            background: #38a169;
        }
        .btn-danger {
            background: #e53e3e;
            color: white;
        }
        .btn-danger:hover {
            background: #c53030;
        }
        .btn-edit {
            background: #ed8936;
            color: white;
        }
        .btn-edit:hover {
            background: #dd6b20;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .header-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-section h1 {
            color: #333;
        }
        .post-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
            gap: 15px;
        }
        .post-info {
            flex: 1;
        }
        .post-title {
            color: #333;
            font-size: 22px;
            margin-bottom: 8px;
            cursor: pointer;
        }
        .post-title:hover {
            color: #667eea;
        }
        .post-meta {
            color: #666;
            font-size: 14px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        .post-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .author {
            color: #667eea;
            font-weight: bold;
        }
        .post-content {
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .post-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .post-actions a {
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .no-posts {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            color: #666;
        }
        .no-posts h3 {
            margin-bottom: 15px;
            color: #333;
        }
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
            }
            .header-section {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Welcome, <?php echo $_smarty_tpl->getValue('currentUser')['username'];?>
!</h2>
        <div class="nav-links">
            <a href="index.php" class="btn-primary">Dashboard</a>
            <a href="posts.php" class="btn-primary">Posts</a>
            <a href="logout.php" class="btn-danger">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="header-section">
            <h1>Community Posts</h1>
            <a href="create_post.php" class="btn-secondary">Create New Post</a>
        </div>
        
        <?php if ($_smarty_tpl->getValue('posts')) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('posts'), 'post');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('post')->value) {
$foreach0DoElse = false;
?>
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-info">
                            <h2 class="post-title" onclick="window.location.href='view_post.php?id=<?php echo $_smarty_tpl->getValue('post')['id'];?>
'"><?php echo $_smarty_tpl->getValue('post')['title'];?>
</h2>
                            <div class="post-meta">
                                <span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    </svg>
                                    <span class="author"><?php echo $_smarty_tpl->getValue('post')['username'];?>
</span>
                                </span>
                                <span>
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                    </svg>
                                    <?php echo $_smarty_tpl->getValue('post')['created_at'];?>

                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="post-content">
                        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('post')['content'],200,"...");?>

                    </div>
                    
                    <div class="post-actions">
                        <a href="view_post.php?id=<?php echo $_smarty_tpl->getValue('post')['id'];?>
" class="btn-primary">Read More</a>
                        <?php if ($_smarty_tpl->getValue('post')['user_id'] == $_smarty_tpl->getValue('currentUserId')) {?>
                            <a href="edit_post.php?id=<?php echo $_smarty_tpl->getValue('post')['id'];?>
" class="btn-edit">Edit</a>
                            <a href="delete_post.php?id=<?php echo $_smarty_tpl->getValue('post')['id'];?>
" class="btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                        <?php }?>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
            <div class="no-posts">
                <h3>No posts yet!</h3>
                <p>Be the first to share something with the community.</p>
                <br>
                <a href="create_post.php" class="btn-secondary">Create Your First Post</a>
            </div>
        <?php }?>
    </div>
</body>
</html>
<?php }
}
