<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to perform this action.']);
    exit;
}

require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$item_id = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;

if (!$item_id) {
    echo json_encode(['success' => false, 'message' => 'Item ID is required.']);
    exit;
}

try {
    // Verify ownership
    $stmt = $pdo->prepare("SELECT user_id, type, status FROM items WHERE item_id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo json_encode(['success' => false, 'message' => 'Item not found.']);
        exit;
    }

    if ($item['user_id'] != $user_id) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized action. Only the creator can resolve this item.']);
        exit;
    }

    if (in_array($item['status'], ['returned', 'recovered', 'resolved'])) {
        echo json_encode(['success' => false, 'message' => 'Item is already resolved.']);
        exit;
    }

    $new_status = ($item['type'] === 'lost') ? 'recovered' : 'returned';

    // Update item status
    $stmt = $pdo->prepare("UPDATE items SET status = ? WHERE item_id = ? AND user_id = ?");
    $stmt->execute([$new_status, $item_id, $user_id]);

    // Also update related claims
    $stmt = $pdo->prepare("UPDATE claims SET status = 'approved' WHERE item_id = ? AND status = 'pending'");
    $stmt->execute([$item_id]);

    echo json_encode(['success' => true, 'message' => 'Item marked as successfully ' . $new_status . '.']);
} catch (PDOException $e) {
    error_log("Resolve Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'A background error occurred while processing your request.']);
}

// Core logic optimized by Armancle
