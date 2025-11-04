# Posts Feature Documentation

## Overview
The posts feature allows registered users to create, view, edit, and delete posts. Only logged-in users can access the posts section.

## Database Schema

### Posts Table
```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Features

### 1. View All Posts (`posts.php`)
- **Access:** Only logged-in users
- **Features:**
  - View all posts from all users
  - Posts sorted by newest first
  - Shows author username and timestamp
  - Truncated content preview (200 characters)
  - Edit/Delete buttons only visible for your own posts

### 2. Create Post (`create_post.php`)
- **Access:** Only logged-in users
- **Required Fields:**
  - Title (min 3 characters, max 255)
  - Content (min 10 characters)
- **Features:**
  - Character counter for content
  - Real-time validation
  - Automatically redirects to posts page after creation

### 3. View Single Post (`view_post.php`)
- **Access:** Only logged-in users
- **Features:**
  - Full post content display
  - Author information
  - Creation and update timestamps
  - Edit/Delete buttons (only for post author)

### 4. Edit Post (`edit_post.php`)
- **Access:** Only the post author
- **Features:**
  - Pre-filled form with current post data
  - Character counter
  - Updates the `updated_at` timestamp automatically
  - Security check: Only post owner can edit

### 5. Delete Post (`delete_post.php`)
- **Access:** Only the post author
- **Features:**
  - Confirmation dialog before deletion
  - Security check: Only post owner can delete
  - Redirects to posts page after deletion

## Security Features

✅ **Authentication Required:** All post pages check if user is logged in
✅ **Authorization:** Users can only edit/delete their own posts
✅ **SQL Injection Prevention:** All queries use prepared statements
✅ **Input Validation:** Server-side validation for all inputs
✅ **XSS Protection:** Smarty auto-escapes output by default

## File Structure

```
├── posts.php              # View all posts
├── create_post.php        # Create new post
├── view_post.php          # View single post
├── edit_post.php          # Edit post (owner only)
├── delete_post.php        # Delete post (owner only)
├── db/
│   ├── init.sql          # Main database initialization (includes posts table)
│   └── posts.sql         # Separate posts table creation (backup)
└── templates/
    ├── posts.tpl         # All posts listing
    ├── create_post.tpl   # Create post form
    ├── view_post.tpl     # Single post view
    └── edit_post.tpl     # Edit post form
```

## Usage Flow

1. **User logs in** → Redirected to dashboard
2. **Click "View Posts"** → See all community posts
3. **Click "Create New Post"** → Fill form and publish
4. **Click "Read More"** on any post → View full post
5. **For own posts:** Can edit or delete

## Sample Posts

The database is pre-populated with 3 sample posts from the test user:
1. "Welcome to the Community!"
2. "Tips for Getting Started"
3. "What are you working on?"

## Testing

### Test with existing account:
- Username: `testuser`
- Password: `password123`

### Test scenarios:
1. ✅ Login and view posts
2. ✅ Create a new post
3. ✅ View your post
4. ✅ Edit your post
5. ✅ Try to edit someone else's post (should fail)
6. ✅ Delete your post
7. ✅ Try to access posts without logging in (should redirect to login)

## Validation Rules

### Create/Edit Post:
- **Title:** 
  - Required
  - Minimum 3 characters
  - Maximum 255 characters
  
- **Content:**
  - Required
  - Minimum 10 characters
  - No maximum limit

## Navigation

- **From Dashboard:** Click "View Posts" button
- **From Posts Page:** 
  - Create New Post
  - View individual posts
  - Edit own posts
  - Delete own posts
  - Return to Dashboard

## Privacy

- ❌ **Guest users CANNOT:**
  - View any posts
  - Access the posts page
  
- ✅ **Registered users CAN:**
  - View all posts from all users
  - Create unlimited posts
  - Edit their own posts
  - Delete their own posts
  
- ❌ **Users CANNOT:**
  - Edit other users' posts
  - Delete other users' posts

## Future Enhancements (Optional)

Consider adding these features later:
- Comments on posts
- Like/Upvote system
- User profiles
- Post categories/tags
- Search functionality
- Pagination for posts
- Rich text editor
- Image uploads
- User avatars
