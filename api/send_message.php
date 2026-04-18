<?php
/**
 * API: Send Message
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

$senderId = $_SESSION['user_id'];
$receiverId = filter_input(INPUT_POST, 'receiver_id', FILTER_VALIDATE_INT);
$itemId = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$messageText = sanitizeInput($_POST['message'] ?? '');

if (!$receiverId || !$itemId || empty($messageText)) {
    jsonResponse(false, null, 'Missing required fields.');
}

try {
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, item_id, message_text) VALUES (?, ?, ?, ?)");
    $stmt->execute([$senderId, $receiverId, $itemId, $messageText]);
    
    jsonResponse(true, ['message_id' => $pdo->lastInsertId()], 'Message sent successfully.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
