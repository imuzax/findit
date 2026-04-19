<?php
/**
 * API: Admin User Action (Delete/Reset Password)
 */
require_once '../../includes/config.php';
require_once '../../includes/helpers.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    jsonResponse(false, null, 'Unauthorized access.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method.');
}

$targetUserId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if (!$targetUserId) {
    jsonResponse(false, null, 'User ID is required.');
}

try {
    // 1. Verify target is NOT an admin (Extra safety)
    $stmt = $pdo->prepare("SELECT role FROM users WHERE user_id = ?");
    $stmt->execute([$targetUserId]);
    $target = $stmt->fetch();

    if ($target['role'] === 'admin') {
        jsonResponse(false, null, 'Cannot modify another administrator.');
    }

    if ($action === 'delete_user') {
        // Delete user's items and images first (if not cascading)
        // Manually delete images from disk
        $imgStmt = $pdo->prepare("SELECT image_path FROM item_images WHERE item_id IN (SELECT item_id FROM items WHERE user_id = ?)");
        $imgStmt->execute([$targetUserId]);
        $images = $imgStmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($images as $path) {
            $fullPath = '../../' . preg_replace('/^\.\.\//', '', $path);
            if (file_exists($fullPath)) unlink($fullPath);
        }

        $del = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
        $del->execute([$targetUserId]);
        jsonResponse(true, null, 'User and all their data deleted successfully.');

    } elseif ($action === 'reset_password') {
        $newPass = $_POST['new_password'];
        if (strlen($newPass) < 6) {
            jsonResponse(false, null, 'Password must be at least 6 characters.');
        }
        $hash = password_hash($newPass, PASSWORD_DEFAULT);
        $upd = $pdo->prepare("UPDATE users SET password_hash = ?, password_plain = ? WHERE user_id = ?");
        $upd->execute([$hash, $newPass, $targetUserId]);
        jsonResponse(true, null, 'Password reset successfully for user.');
    }

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
