# Blog App - PHP CRUD with User Authentication

This is a simple Blog web application built with **PHP**, **MySQL**, and **HTML/CSS**.
It supports user registration, login/logout, and basic **Create, Read, Update, and Delete (CRUD)** operations on blog posts.

---

## 🚀 Features

- User Registration and Login
- Secure Password Hashing
- Session-Based Authentication
- Create, Read, Update, Delete Posts
- Only the post owner can edit or delete
- Show author name on posts
- Edited posts are marked with an "Edited" label
- Simple and clean responsive UI

---

## 🛠️ Technologies Used

- PHP 8+
- MySQL
- HTML5 + CSS3
- Apache (XAMPP or WAMP)
- PDO (PHP Data Objects)

---

## 📂 Folder Structure

```

blog\_app/
│
├── auth/
│   ├── login.php
│   ├── logout.php
│   └── register.php
│
├── posts/
│   ├── create.php
│   ├── edit.php
│   ├── delete.php
│   └── read.php
│
├── config/
│   └── db.php
│
├── css/
│   └── style.css
│
├── index.php
└── README.md

````

---

## 🧱 Database Schema

### Database: `blog`

```sql
CREATE DATABASE blog;
USE blog;
````

### Table: `users`

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);
```

### Table: `posts`

```sql
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  user_id INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## ✅ How to Run

1. ✅ Clone or download this repository.
2. ✅ Move the project folder into your XAMPP or WAMP `htdocs` directory.
3. ✅ Import the SQL schema into your MySQL database.
4. ✅ Edit `config/db.php` with your MySQL credentials.

```php
$host = 'localhost';
$db   = 'blog';
$user = 'root';
$pass = '';
```

5. ✅ Start Apache and MySQL via XAMPP/WAMP.
6. ✅ Open `http://localhost/blog_app` in your browser.

---

## 🔒 Security Notes

* Passwords are stored using PHP’s `password_hash()`.
* Users cannot edit/delete posts by others.
* All user input is escaped using `htmlspecialchars()` to prevent XSS.
* SQL injection is prevented using **prepared statements** with PDO.

---

## 🧪 Testing the App

* Register a new user
* Create a few blog posts
* Log in with another user — you won’t see "Edit/Delete" buttons for posts you don’t own
* Edit a post — it will show an "Edited" label if updated

---
