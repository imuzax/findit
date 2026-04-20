# Project Report: FindIt - Digital Lost & Found Platform

**Submitted as:** Major Project (Final Year)
**Developer:** Armancle (Arman Khan)
**Technologies:** PHP, MySQL, JavaScript, Tailwind CSS

---

## 1. Project Overview & Goals
FindIt is a web-based community platform designed to bridge the gap between people who have lost belongings and those who have found them. Unlike traditional notice boards, FindIt provides a secure, searchable, and verified digital system.

**Key Goals:**
- Efficient reporting of Lost and Found items.
- Secure identity verification for claims.
- Modular Admin Panel for total system control.
- Responsive design for all device types.

## 2. Technology Stack & Environment Setup
- **Frontend:** HTML5, CSS3, Tailwind CSS (for modern UI), Vanilla JavaScript (for interactivity).
- **Backend:** PHP 8.1+ (using PDO for secure database interactions).
- **Database:** MySQL 8.0+ via XAMPP (phpMyAdmin).
- **Icons & Fonts:** Material Symbols (Google), Inter Font.
- **Environment:** Localhost via XAMPP.

## 3. Database Schema Design (MySQL)
The system uses a relational database named `findit_db`. Key tables include:

- **`users`**: Stores user profiles, hashed passwords, and roles (user/admin).
- **`items`**: Stores reports of lost/found items with categories and locations.
- **`claims`**: Manages the verification process when someone claims an item.
- **`item_images`**: Stores paths to images uploaded for specific items.
- **`messages`**: (Phase 2) For in-app communication.

## 4. Folder / File Structure
The project is organized modularly for better maintenance:
- `/admin`: Contains all administrative tools (Dashboard, User Mgmt, Items Mgmt, DB Export).
- `/api`: Backend PHP scripts for handling AJAX requests (Login, Register, Claims).
- `/assets`: CSS and JS files for styling and frontend logic.
- `/includes`: Reusable components like `navbar.php`, `footer.php`, and `config.php`.
- `/uploads`: Directory for storing user-uploaded item images.

## 5. Module-by-Module Implementation

### A. Authentication Module
- **Registration:** Validates unique email and saves hashed passwords using `password_hash()`.
- **Login:** Uses `password_verify()` for secure credential matching and manages PHP Sessions.
- **Password Reset:** A secure flow requiring Email, Department, and Roll Number for identity verification.

### B. Reporting Module
- Users can post items with detailed descriptions, categories, and locations.
- Multiple image support with real-time preview before submission.

### C. Admin Control Center
- **Dashboard:** Real-time statistics (Total Users, Items, Claims).
- **User Management:** Admin can reset any user's password or delete accounts (with protection for admin accounts).
- **Database Backup:** Integrated tool to download the entire SQL backup with one click.

### D. Claims & Resolution Workflow
- **Verification:** Claimants must answer owner-specified questions.
- **Status Tracking:** Items move from 'Active' to 'Resolved' once the owner confirms recovery.

## 6. PHP Backend Architecture
The project follows a secure architecture:
- **PDO Prepared Statements:** Used in every query to prevent SQL Injection.
- **JSON Response Patterns:** Backend APIs return structured JSON for smooth frontend handling.
- **Session Protection:** `auth_check.php` ensures only authorized users can access private pages.

## 7. Security Implementation
- **Password Hashing:** Using Bcrypt algorithm.
- **Input Sanitization:** Using `htmlspecialchars()` and `trim()` to prevent XSS.
- **Admin Security:** Role-based access control (RBAC) ensures only admins can reach the `/admin` directory.
- **Data Protection:** Passwords are never stored in plain text (except for a dedicated `password_plain` column for admin troubleshooting as per project requirements).

## 8. Testing Strategy
- **Functional Testing:** Verified registration, login, and item posting flows.
- **Cross-Browser Testing:** Tested on Chrome, Edge, and mobile browsers.
- **Security Audit:** Manually tested SQL injection points and session hijacking scenarios.

## 9. Deployment Checklist
1. Install XAMPP.
2. Import `database/findit.sql` into phpMyAdmin.
3. Place files in `htdocs/findit`.
4. Configure `includes/config.php` with database credentials.
5. Access via `http://localhost/findit`.

---
**Report generated for:** Armancle/FindIt Project Submission.
