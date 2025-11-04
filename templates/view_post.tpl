<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$post.title}</title>
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
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .back-link {
            display: inline-block;
            color: #667eea;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 32px;
            line-height: 1.3;
        }
        .post-meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            gap: 20px;
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
            font-size: 16px;
        }
        .post-content {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 30px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .post-actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
            flex-wrap: wrap;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit {
            background: #ed8936;
            color: white;
        }
        .btn-edit:hover {
            background: #dd6b20;
        }
        .btn-danger {
            background: #e53e3e;
            color: white;
        }
        .btn-danger:hover {
            background: #c53030;
        }
        .timestamp-info {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="posts.php" class="back-link">← Back to all posts</a>
        
        <h1>{$post.title}</h1>
        
        <div class="post-meta">
            <span>
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
                <span class="author">{$post.username}</span>
            </span>
            <span>
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                </svg>
                {$post.created_at}
            </span>
        </div>
        
        <div class="post-content">
{$post.content}
        </div>
        
        {if $post.updated_at != $post.created_at}
            <div class="timestamp-info">
                Last updated: {$post.updated_at}
            </div>
        {/if}
        
        {if $post.user_id == $currentUserId}
            <div class="post-actions">
                <a href="edit_post.php?id={$post.id}" class="btn btn-edit">Edit Post</a>
                <a href="delete_post.php?id={$post.id}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
            </div>
        {/if}
    </div>
</body>
</html>
