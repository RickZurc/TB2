-- Add posts table
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
);

-- Insert some sample posts
INSERT INTO posts (user_id, title, content) VALUES
(1, 'Welcome to the Community!', 'This is my first post. Happy to be here and looking forward to connecting with everyone!'),
(1, 'Tips for Getting Started', 'Here are some helpful tips for new users: 1) Complete your profile, 2) Be respectful, 3) Share your thoughts!'),
(1, 'What are you working on?', 'I''m curious to know what projects everyone is working on. Share in the comments!')
ON DUPLICATE KEY UPDATE id=id;
