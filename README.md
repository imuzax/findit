# 🔍 FindIt Digital — Lost & Found Platform

> **A modern, full-stack Lost & Found web application** built with PHP, MySQL, and a sleek glassmorphism UI design.

---

## 🌟 Features

| Feature | Description |
|---|---|
| 🔐 **Authentication** | Secure user registration & login system |
| 📝 **Post Items** | Report lost or found items with image uploads |
| 🔎 **Browse & Search** | Filter items by category, location, and date |
| 💬 **Messaging** | Real-time chat between users to coordinate returns |
| 📊 **Dashboard** | Personal dashboard to manage your posted items |
| 👤 **Profile** | User profile management |
| 🛡️ **Admin Panel** | Full admin control for platform management |

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.x
- **Database:** MySQL (via phpMyAdmin / XAMPP)
- **Frontend:** HTML5, CSS3 (Glassmorphism Design), JavaScript
- **Server:** Apache (XAMPP)
- **API:** Custom RESTful PHP endpoints

---

## 📁 Project Structure

```
findit/
├── index.php           # Home / Landing page
├── auth.php            # Login & Registration
├── browse.php          # Browse all lost/found items
├── post-lost.php       # Post a lost item
├── post-found.php      # Post a found item
├── item-detail.php     # Item detail view
├── dashboard.php       # User dashboard
├── messages.php        # Messaging system
├── profile.php         # User profile
├── admin.php           # Admin panel
├── includes/
│   ├── header.php      # Common header
│   ├── navbar.php      # Navigation bar
│   └── footer.php      # Common footer
├── assets/
│   ├── css/            # Stylesheets
│   └── js/             # JavaScript files
├── api/                # REST API endpoints
├── uploads/            # User uploaded images
└── docs/               # Project documentation
```

---

## 🚀 Getting Started

### Prerequisites
- XAMPP (Apache + MySQL)
- PHP 8.0+
- Browser (Chrome / Firefox recommended)

### Installation

1. **Clone the repo:**
   ```bash
   git clone https://github.com/imuzax/findit.git
   ```

2. **Move to XAMPP htdocs:**
   ```bash
   # Place the folder in: C:/xampp/htdocs/findit
   ```

3. **Import the database:**
   - Open `phpMyAdmin` → `http://localhost/phpmyadmin`
   - Create a new database named `findit`
   - Import `docs/findit.sql` (if available)

4. **Configure database connection:**
   - Create `includes/config.php`:
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'findit');
   ?>
   ```

5. **Run the app:**
   - Start **Apache** and **MySQL** in XAMPP Control Panel
   - Visit: `http://localhost/findit`

---

## 📸 Screenshots

> *Coming soon — UI screenshots will be added.*

---

## 👨‍💻 Developer

**Muzaffar Hussain** — [@imuzax](https://github.com/imuzax)  
Founder @ [iInfynite](https://www.linkedin.com/company/iinfynite)

---

## 📄 License

This project is for educational and portfolio purposes.

---

> ⭐ If you found this helpful, give it a star!
