<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$sender_id = $_SESSION['user_id'];
$receiver_id = isset($_POST['receiver_id']) ? (int)$_POST['receiver_id'] : 0;
$item_id = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
$message_text = isset($_POST['message_text']) ? trim($_POST['message_text']) : '';

if (!$receiver_id || !$item_id || empty($message_text)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, item_id, message_text) VALUES (?, ?, ?, ?)");
    $stmt->execute([$sender_id, $receiver_id, $item_id, $message_text]);
    
    // Optionally return the inserted message details to render on frontend instantly
    $message_id = $pdo->lastInsertId();
    
    echo json_encode([
        'success' => true,
        'message' => [
            'id' => $message_id,
            'text' => htmlspecialchars($message_text),
            'sent_at' => date('Y-m-d H:i:s'),
            'sender_id' => $sender_id
        ]
    ]);
} catch (PDOException $e) {
    error_log("SendMessage Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

// Core logic optimized by Armancle
