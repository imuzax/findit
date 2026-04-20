<?php
/**
 * API: Update Profile (Details & Password)
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method.');
}

$userId = $_SESSION['user_id'];

try {
    // 1. Password Change Logic
    if (isset($_POST['change_password'])) {
        $current = $_POST['current_password'];
        $new = $_POST['new_password'];
        
        // Fetch current hash
        $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        
        if (!password_verify($current, $user['password_hash'])) {
            jsonResponse(false, null, 'Current password is incorrect.');
        }
        
        if (strlen($new) < 6) {
            jsonResponse(false, null, 'New password must be at least 6 characters.');
        }
        
        $newHash = password_hash($new, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
        $update->execute([$newHash, $userId]);
        
        jsonResponse(true, null, 'Password updated successfully.');
    }

    // 2. Personal Info Update Logic
    $fullName = sanitizeInput($_POST['full_name']);
    $phone = sanitizeInput($_POST['phone']);
    $department = sanitizeInput($_POST['department']);
    $rollNumber = sanitizeInput($_POST['roll_number']);

    if (empty($fullName)) {
        jsonResponse(false, null, 'Full name is required.');
    }

    $stmt = $pdo->prepare("
        UPDATE users 
        SET full_name = ?, phone = ?, department = ?, roll_number = ? 
        WHERE user_id = ?
    ");
    $stmt->execute([$fullName, $phone, $department, $rollNumber, $userId]);

    // Update session info if name changed
    $_SESSION['full_name'] = $fullName;
    $_SESSION['phone'] = $phone;

    jsonResponse(true, null, 'Profile updated successfully.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

