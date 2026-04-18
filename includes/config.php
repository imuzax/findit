<?php
/**
 * Global Configuration & Database Connection
 */

// Database Credentials
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'findit_db');

// Connect to Database using PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";port=3307;dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER, 
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    // In production, log the error rather than displaying it
    die(json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]));
}

// Start Session globally if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
