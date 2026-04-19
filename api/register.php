<?php
/**
 * API: Register User
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

// Ensure the request is JSON or Form data and extract fields
$fullName = sanitizeInput($_POST['full_name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';
$phone = sanitizeInput($_POST['phone'] ?? '');
$department = sanitizeInput($_POST['department'] ?? '');
$rollNumber = sanitizeInput($_POST['roll_number'] ?? '');

// Validation
if (empty($fullName) || empty($email) || empty($password)) {
    jsonResponse(false, null, 'Please fill all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(false, null, 'Invalid email format.');
}

if (strlen($password) < 6) {
    jsonResponse(false, null, 'Password must be at least 6 characters long.');
}

try {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        jsonResponse(false, null, 'Email already registered.');
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insert user (Saving plain password for admin visibility as requested by owner)
    $insertStmt = $pdo->prepare("INSERT INTO users (full_name, email, phone, password_hash, password_plain, department, roll_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertStmt->execute([$fullName, $email, $phone, $passwordHash, $password, $department, $rollNumber]);
    $userId = $pdo->lastInsertId();

    // Auto-login after registration
    $_SESSION['user_id'] = $userId;
    $_SESSION['full_name'] = $fullName;
    $_SESSION['role'] = 'user';
    $_SESSION['phone'] = $phone;

    jsonResponse(true, ['user_id' => $userId, 'role' => 'user'], 'Registration successful.');

} catch (PDOException $e) {
    // In production log the error, don't expose it
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
