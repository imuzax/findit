<?php
/**
 * API: Admin Action (Approve/Delete)
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

// Check if current user is admin
if ($_SESSION['role'] !== 'admin') {
    jsonResponse(false, null, 'Unauthorized access. Admins only.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method.');
}

$itemId = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : ''; // 'approve' or 'delete'

if (!$itemId || !in_array($action, ['approve', 'delete'])) {
    jsonResponse(false, null, 'Invalid parameters.');
}

try {
    if ($action === 'approve') {
        $stmt = $pdo->prepare("UPDATE items SET admin_approved = 1 WHERE item_id = ?");
        $stmt->execute([$itemId]);
        jsonResponse(true, null, 'Item approved successfully.');
    } else {
        // Delete Item Logic
        // 1. Delete images from disk
        $imgStmt = $pdo->prepare("SELECT image_path FROM item_images WHERE item_id = ?");
        $imgStmt->execute([$itemId]);
        $images = $imgStmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($images as $path) {
            $fullPath = '../' . preg_replace('/^\.\.\//', '', $path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        // 2. Delete from DB (FKs handle the rest)
        $deleteStmt = $pdo->prepare("DELETE FROM items WHERE item_id = ?");
        $deleteStmt->execute([$itemId]);
        
        jsonResponse(true, null, 'Item deleted successfully.');
    }
} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

// Core logic optimized by Armancle
