# User Registration and Login System with Smarty

This is a complete user authentication system built with PHP, Smarty template engine, and MySQL.

## Features

### User Authentication
- **User Registration** with validation
- **User Login** with secure password hashing
- **User Dashboard** showing profile information
- **Session Management**

### Posts System (Registered Users Only)
- **View All Posts** from all community members
- **Create Posts** with title and content
- **Edit Your Posts** with real-time character counter
- **Delete Your Posts** with confirmation
- **View Single Post** with full details and author information
- **Privacy Protected** - Only logged-in users can see posts

### Design
- **Responsive Design** - Works on all devices
- **Modern UI** with gradient backgrounds
- **Color-coded Actions** (Create, Edit, Delete buttons)
- **Real-time Validation** and character counters

## Prerequisites

Before you begin, you need to install Docker and Docker Compose on your system.

### Installing Docker Desktop (Windows)

1. **Download Docker Desktop:**
   - Go to [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
   - Click "Download for Windows"

2. **Install Docker Desktop:**
   - Run the installer (Docker Desktop Installer.exe)
   - Follow the installation wizard
   - Enable WSL 2 if prompted (recommended)
   - Restart your computer if required

3. **Verify Installation:**
   ```powershell
   docker --version
   docker-compose --version
   ```
   You should see version numbers for both commands.

4. **Start Docker Desktop:**
   - Launch Docker Desktop from the Start menu
   - Wait for it to start (the Docker icon in the system tray will stop animating)

### Installing Docker (Linux)

```bash
# Update package index
sudo apt-get update

# Install Docker
sudo apt-get install -y docker.io

# Install Docker Compose
sudo apt-get install -y docker-compose

# Add your user to docker group (to run without sudo)
sudo usermod -aG docker $USER

# Log out and log back in for group changes to take effect

# Verify installation
docker --version
docker-compose --version
```

### Installing Docker (macOS)

1. **Download Docker Desktop:**
   - Go to [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
   - Click "Download for Mac"

2. **Install Docker Desktop:**
   - Open the .dmg file
   - Drag Docker to Applications folder
   - Launch Docker from Applications

3. **Verify Installation:**
   ```bash
   docker --version
   docker-compose --version
   ```

## Database Structure

### Users Table
The application uses a `users` table with the following columns:
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `username` (VARCHAR(255), UNIQUE)
- `password` (VARCHAR(255), hashed)
- `email` (VARCHAR(255), UNIQUE)
- `created_at` (TIMESTAMP)

### Posts Table
The `posts` table stores all user posts:
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `user_id` (INT, FOREIGN KEY to users.id)
- `title` (VARCHAR(255))
- `content` (TEXT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)
- **Relationships:** Each post belongs to a user; posts are deleted if user is deleted

## Files Structure

```
├── config.php              # Database configuration
├── index.php               # Home page (redirects based on login status)
├── login.php               # Login handler
├── register.php            # Registration handler
├── logout.php              # Logout handler
├── posts.php               # View all posts (registered users only)
├── create_post.php         # Create new post
├── view_post.php           # View single post details
├── edit_post.php           # Edit post (owner only)
├── delete_post.php         # Delete post (owner only)
├── db/
│   ├── init.sql           # Database initialization script (users + posts)
│   └── posts.sql          # Posts table schema (backup)
├── templates/
│   ├── home.tpl           # Home page template
│   ├── login.tpl          # Login form template
│   ├── register.tpl       # Registration form template
│   ├── dashboard.tpl      # User dashboard template
│   ├── posts.tpl          # All posts listing template
│   ├── create_post.tpl    # Create post form template
│   ├── view_post.tpl      # Single post view template
│   └── edit_post.tpl      # Edit post form template
├── templates_c/           # Smarty compiled templates (auto-generated)
├── vendor/                # Composer dependencies (Smarty)
├── README.md              # This file
└── POSTS_GUIDE.md         # Detailed posts feature documentation
```

## Project Setup Instructions

### Step 1: Clone or Download the Project

If you have the project in a ZIP file, extract it. If it's in a Git repository:

```bash
git clone <repository-url>
cd TB2
```

### Step 2: Verify Project Structure

Make sure you have these files in your project directory:
```
TB2/
├── docker-compose.yml
├── Dockerfile
├── config.php
├── index.php
├── login.php
├── register.php
├── logout.php
├── composer.json
├── db/
│   └── init.sql
└── templates/
    ├── home.tpl
    ├── login.tpl
    ├── register.tpl
    └── dashboard.tpl
```

### Step 3: Start Docker Desktop

**Windows/Mac:** Launch Docker Desktop and wait until it's fully running (the Docker icon in the system tray will be steady).

**Linux:** Docker daemon should start automatically. Verify with:
```bash
sudo systemctl status docker
```

### Step 4: Build and Start the Containers

Open a terminal/PowerShell in the project directory and run:

**Windows (PowerShell):**
```powershell
docker-compose up --build -d
```

**Linux/Mac:**
```bash
docker-compose up --build -d
```

This command will:
- Build the custom PHP container with Apache, Composer, and PDO MySQL
- Pull MySQL and phpMyAdmin images
- Start all three containers in detached mode

**Expected output:**
```
[+] Building ...
[+] Running 4/4
 ✔ Network tb2_default         Created
 ✔ Container tb2-db-1          Started
 ✔ Container tb2-www-1         Started
 ✔ Container tb2-phpmyadmin-1  Started
```

### Step 5: Install Composer Dependencies

Once the containers are running, install Smarty via Composer:

**Windows (PowerShell):**
```powershell
docker-compose exec www composer install
```

**Linux/Mac:**
```bash
docker-compose exec www composer install
```

If you haven't installed Smarty yet:
```powershell
docker-compose exec www composer require smarty/smarty
```

### Step 6: Wait for MySQL Initialization

**Important:** Wait about 30-60 seconds for MySQL to fully initialize and create the database from `init.sql`.

You can check if MySQL is ready:
```powershell
docker-compose logs db
```

Look for a line like: `ready for connections` or `port: 3306`

### Step 7: Access the Application

Open your web browser and navigate to:
- **Main Application:** [http://localhost](http://localhost)
- **phpMyAdmin:** [http://localhost:8001](http://localhost:8001)

### Step 8: Verify Installation

1. You should see the welcome page with "Login" and "Register" buttons
2. Try logging in with the test account:
   - **Username:** `testuser`
   - **Password:** `password123`

## Managing the Application

### View Running Containers
```powershell
docker-compose ps
```

### View Container Logs
```powershell
# All containers
docker-compose logs

# Specific container
docker-compose logs www
docker-compose logs db
docker-compose logs phpmyadmin

# Follow logs in real-time
docker-compose logs -f www
```

### Stop the Application
```powershell
docker-compose stop
```

### Start the Application (after stopping)
```powershell
docker-compose start
```

### Stop and Remove Containers
```powershell
docker-compose down
```

### Rebuild Containers (after changing Dockerfile)
```powershell
docker-compose down
docker-compose up --build -d
```

### Access Container Shell
```powershell
# Access PHP container
docker-compose exec www bash

# Access MySQL container
docker-compose exec db bash

# Run MySQL commands
docker-compose exec db mysql -u php_docker -ppassword php_docker
```

### Reset Database
If you need to reset the database:
```powershell
docker-compose down -v
docker-compose up -d
```
The `-v` flag removes volumes, which will delete the database data.

## Usage

### Registration
1. Click "Register" on the home page
2. Fill in:
   - Username (must be unique)
   - Email (must be unique and valid)
   - Password (minimum 6 characters)
   - Confirm Password
3. Click "Register" button
4. You'll be automatically logged in and redirected to the dashboard

### Login
1. Click "Login" on the home page
2. Enter your username and password
3. Click "Login" button
4. You'll be redirected to your dashboard

### Dashboard
- View your profile information (ID, username, email)
- Click "View Posts" to access the community posts
- Click "Logout" to end your session

### Working with Posts (Registered Users Only)

#### Viewing Posts
1. From the dashboard, click "View Posts" or "Go to Community Posts"
2. Browse all posts from the community
3. Posts are sorted by newest first
4. Click "Read More" to view full post details

#### Creating a Post
1. Click "Create New Post" button
2. Enter a title (minimum 3 characters)
3. Write your content (minimum 10 characters)
4. Click "Publish Post"
5. Your post will appear in the community feed

#### Editing Your Posts
1. On any post you created, click "Edit" button
2. Modify the title or content
3. Click "Update Post"
4. The post's "updated_at" timestamp will be updated

#### Deleting Your Posts
1. On any post you created, click "Delete" button
2. Confirm the deletion in the popup dialog
3. The post will be permanently removed

**Note:** You can only edit or delete posts that you created. Other users' posts are view-only.

## Test Account

A test user is already created in the database with sample posts:
- **Username:** `testuser`
- **Password:** `password123`
- **Email:** `test@example.com`

**Sample Posts Included:**
1. "Welcome to the Community!" - Introduction post
2. "Tips for Getting Started" - Helpful tips post
3. "What are you working on?" - Discussion post

You can login with this account to see existing posts and create your own!

## Security Features

### Authentication & Authorization
- Passwords are hashed using `password_hash()` with bcrypt
- Password verification using `password_verify()`
- Session-based authentication
- **Protected Routes:** Posts pages require login
- **Ownership Validation:** Users can only edit/delete their own posts

### Data Protection
- SQL injection prevention using prepared statements (PDO)
- Input validation and sanitization (both client and server-side)
- XSS protection (Smarty auto-escapes output)
- CSRF protection (form-based)

### Database Security
- Foreign key constraints (posts linked to users)
- Cascade deletion (posts deleted when user is deleted)
- Unique constraints on username and email

## Validation Rules

### Registration:
- All fields are required
- Password must be at least 6 characters
- Passwords must match
- Email must be valid format
- Username and email must be unique

### Login:
- Username and password are required
- Credentials must match database records

### Creating/Editing Posts:
- Title is required (3-255 characters)
- Content is required (minimum 10 characters)
- Only logged-in users can create posts
- Only post owners can edit/delete their posts

## Troubleshooting

### Common Issues and Solutions

#### 1. Docker Desktop Not Running
**Error:** `Cannot connect to the Docker daemon`

**Solution:**
- Make sure Docker Desktop is running (Windows/Mac)
- On Linux, start Docker: `sudo systemctl start docker`

#### 2. Port Already in Use
**Error:** `Bind for 0.0.0.0:80 failed: port is already allocated`

**Solution:**
- Another service is using port 80 (like IIS, Apache, or Skype)
- Option A: Stop the conflicting service
- Option B: Change the port in `docker-compose.yml`:
  ```yaml
  ports:
    - 8080:80  # Use port 8080 instead
  ```
  Then access via `http://localhost:8080`

#### 3. Database Connection Errors
**Error:** `Connection failed` or `SQLSTATE[HY000] [2002]`

**Solution:**
- Wait 30-60 seconds for MySQL to fully initialize
- Check if MySQL container is running: `docker-compose ps`
- Check MySQL logs: `docker-compose logs db`
- Verify database credentials in `config.php` match `docker-compose.yml`

#### 4. Smarty Template Not Found
**Error:** `Unable to load template file`

**Solution:**
- Verify `templates/` directory exists
- Check file permissions
- Make sure `templates_c/` directory is created and writable:
  ```powershell
  docker-compose exec www mkdir -p /var/www/html/templates_c
  docker-compose exec www chmod 777 /var/www/html/templates_c
  ```

#### 5. Composer Dependencies Missing
**Error:** `Class 'Smarty\Smarty' not found`

**Solution:**
- Install Composer dependencies:
  ```powershell
  docker-compose exec www composer install
  ```

#### 6. Page Shows PHP Code Instead of Running It
**Problem:** Browser displays PHP code as text

**Solution:**
- Make sure you're accessing via `http://localhost` not `file://`
- Check if Apache is running: `docker-compose ps`
- Restart containers: `docker-compose restart www`

#### 7. "Access Denied" When Connecting to Database
**Solution:**
- Check credentials in `config.php`:
  ```php
  define('DB_HOST', 'db');  // Must be 'db' (container name)
  define('DB_NAME', 'php_docker');
  define('DB_USER', 'php_docker');
  define('DB_PASS', 'password');
  ```

#### 8. Session Issues
**Problem:** Can't login or session not persisting

**Solution:**
- Clear browser cookies and cache
- Check if session directory is writable:
  ```powershell
  docker-compose exec www php -r "echo session_save_path();"
  ```

#### 9. MySQL Table Doesn't Exist
**Error:** `Table 'php_docker.users' doesn't exist`

**Solution:**
- Check if `init.sql` was executed:
  ```powershell
  docker-compose exec db mysql -u php_docker -ppassword php_docker -e "SHOW TABLES;"
  ```
- If no tables, manually import:
  ```powershell
  docker-compose exec -T db mysql -u php_docker -ppassword php_docker < db/init.sql
  ```

#### 10. Changes Not Reflecting
**Problem:** Code changes don't appear in browser

**Solution:**
- Hard refresh: `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac)
- Clear Smarty cache:
  ```powershell
  docker-compose exec www rm -rf /var/www/html/templates_c/*
  docker-compose exec www rm -rf /var/www/html/cache/*
  ```

### Getting More Help

Check logs for detailed error messages:
```powershell
# PHP/Apache errors
docker-compose logs www

# MySQL errors
docker-compose logs db

# All errors
docker-compose logs
```

## Technologies Used

- **PHP 8.x** with Apache web server
- **MySQL 8.x** database
- **Smarty 4.x** Template Engine
- **PDO** for secure database connections
- **Composer** for dependency management
- **Docker & Docker Compose** for containerization
- **phpMyAdmin** for database management

## Development Notes

- Sessions are started in `config.php`
- Database connection uses PDO with exception mode and prepared statements
- Templates use `.tpl` extension
- Compiled templates are stored in `templates_c/` directory (auto-generated)
- All post routes are protected with authentication checks
- Foreign key relationships ensure data integrity
- Timestamps are automatically managed by MySQL

## Application URLs

Once the containers are running, access:
- **Main Application:** [http://localhost](http://localhost)
- **Posts Page:** [http://localhost/posts.php](http://localhost/posts.php) (requires login)
- **phpMyAdmin:** [http://localhost:8001](http://localhost:8001)
  - Server: `db`
  - Username: `php_docker`
  - Password: `password`

## Additional Documentation

For detailed information about the posts feature, see [POSTS_GUIDE.md](POSTS_GUIDE.md)

## Quick Start Guide

1. **Install Docker Desktop** (see Prerequisites section)
2. **Clone or download** this repository
3. **Open terminal** in project directory
4. **Run:** `docker-compose up --build -d`
5. **Wait 30-60 seconds** for MySQL to initialize
6. **Open browser:** [http://localhost](http://localhost)
7. **Login** with test account (username: `testuser`, password: `password123`)
8. **Explore** the dashboard and posts feature!

## Project Structure Overview

This is a full-stack web application with:
- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Template Engine:** Smarty for clean MVC separation
- **Backend:** PHP with object-oriented practices
- **Database:** MySQL with relational design
- **Infrastructure:** Docker for easy deployment and consistency
