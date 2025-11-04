<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: #555;
            margin-bottom: 5px;
            font-weight: 500;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #ed8936;
        }
        textarea {
            min-height: 200px;
            resize: vertical;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #ed8936;
            color: white;
            width: 100%;
        }
        .btn-primary:hover {
            background: #dd6b20;
        }
        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #ed8936;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .char-count {
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        
        {if $error}
            <div class="error">{$error}</div>
        {/if}
        
        <form method="POST" action="edit_post.php?id={$post.id}">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title" value="{$post.title}" required minlength="3" maxlength="255">
            </div>
            
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea id="content" name="content" required minlength="10">{$post.content}</textarea>
                <div class="char-count">
                    <span id="charCount">{$post.content|strlen}</span> characters
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
        
        <div class="links">
            <p><a href="posts.php">← Back to Posts</a></p>
            <p><a href="view_post.php?id={$post.id}">Cancel and view post</a></p>
        </div>
    </div>
    
    <script>
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('charCount');
        
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    </script>
</body>
</html>
