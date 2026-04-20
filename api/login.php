<?php
/**
 * API: Login User
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    jsonResponse(false, null, 'Please provide both email and password.');
}

try {
    $stmt = $pdo->prepare("SELECT user_id, full_name, password_hash, role, status FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        
        if ($user['status'] === 'suspended') {
            jsonResponse(false, null, 'Your account has been suspended. Please contact support.');
        }

        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        jsonResponse(true, ['user_id' => $user['user_id'], 'role' => $user['role']], 'Login successful.');
    } else {
        jsonResponse(false, null, 'Invalid email or password.');
    }
} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

