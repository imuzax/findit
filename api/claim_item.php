<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to claim items.']);
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
    // Check if the item exists and the user is NOT the owner
    $stmt = $pdo->prepare("SELECT user_id, status FROM items WHERE item_id = ?");
    $stmt->execute([$item_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo json_encode(['success' => false, 'message' => 'Item not found.']);
        exit;
    }

    if ($item['user_id'] == $user_id) {
        echo json_encode(['success' => false, 'message' => 'You cannot claim your own item.']);
        exit;
    }

    if (in_array($item['status'], ['returned', 'recovered', 'resolved'])) {
        echo json_encode(['success' => false, 'message' => 'This item is already resolved.']);
        exit;
    }

    // Check if user already claimed
    $stmt = $pdo->prepare("SELECT claim_id FROM claims WHERE item_id = ? AND claimant_id = ?");
    $stmt->execute([$item_id, $user_id]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'You have already submitted a claim/contact request for this item.']);
        exit;
    }

    // Insert claim
    $stmt = $pdo->prepare("INSERT INTO claims (item_id, claimant_id, status) VALUES (?, ?, 'pending')");
    $stmt->execute([$item_id, $user_id]);

    // Optional: We can also update item status to 'matched' just to show activity.
    // $stmt = $pdo->prepare("UPDATE items SET status = 'matched' WHERE item_id = ? AND status = 'active'");
    // $stmt->execute([$item_id]);

    echo json_encode(['success' => true, 'message' => 'Your request has been sent! The owner will be notified on their dashboard.']);
} catch (PDOException $e) {
    error_log("Claim Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'A background error occurred while processing your request.']);
}
