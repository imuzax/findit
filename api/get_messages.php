<?php
/**
 * API: Get Messages
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, null, 'Invalid request method. Only GET allowed.');
}

$userId = $_SESSION['user_id'];
$otherUserId = filter_input(INPUT_GET, 'other_user_id', FILTER_VALIDATE_INT);
$itemId = filter_input(INPUT_GET, 'item_id', FILTER_VALIDATE_INT);

// Basic validation
if (!$otherUserId) {
    jsonResponse(false, null, 'Other user ID is required.');
}

$sql = "SELECT m.*, u.full_name as sender_name 
        FROM messages m 
        JOIN users u ON m.sender_id = u.user_id 
        WHERE ((m.sender_id = ? AND m.receiver_id = ?) 
           OR (m.sender_id = ? AND m.receiver_id = ?))";
$params = [$userId, $otherUserId, $otherUserId, $userId];

// Optionally filter by item if item context is provided
if ($itemId) {
    $sql .= " AND m.item_id = ?";
    $params[] = $itemId;
}

$sql .= " ORDER BY m.sent_at ASC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $messages = $stmt->fetchAll();

    // Mark as read
    $markReadStmt = $pdo->prepare("UPDATE messages SET is_read = 1 WHERE receiver_id = ? AND sender_id = ? AND is_read = 0");
    $markReadStmt->execute([$userId, $otherUserId]);

    jsonResponse(true, $messages);

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
