<?php
/**
 * API: Delete Item
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method.');
}

$userId = $_SESSION['user_id'];
$itemId = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;

if (!$itemId) {
    jsonResponse(false, null, 'Item ID is required.');
}

try {
    // 1. Verify that the current user is the owner of the item
    $stmt = $pdo->prepare("SELECT user_id FROM items WHERE item_id = ?");
    $stmt->execute([$itemId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        jsonResponse(false, null, 'Item not found.');
    }

    if ($item['user_id'] != $userId) {
        jsonResponse(false, null, 'Unauthorized action.');
    }

    // 2. Delete item (foreign keys will handle images, claims, etc. if ON DELETE CASCADE is set)
    // However, we should manually delete images from disk if possible.
    $imgStmt = $pdo->prepare("SELECT image_path FROM item_images WHERE item_id = ?");
    $imgStmt->execute([$itemId]);
    $images = $imgStmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($images as $path) {
        $fullPath = '../' . preg_replace('/^\.\.\//', '', $path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    $deleteStmt = $pdo->prepare("DELETE FROM items WHERE item_id = ?");
    $deleteStmt->execute([$itemId]);

    jsonResponse(true, null, 'Item deleted successfully.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

// Core logic optimized by Armancle
