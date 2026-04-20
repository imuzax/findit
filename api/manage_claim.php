<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$user_id = $_SESSION['user_id'];
$claim_id = $_POST['claim_id'] ?? '';
$action = $_POST['action'] ?? ''; // 'approve' or 'reject'

if (empty($claim_id) || empty($action) || !in_array($action, ['approve', 'reject'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Verify ownership of the item associated with this claim
    $stmt = $pdo->prepare("
        SELECT c.item_id, i.user_id as owner_id, c.status as claim_status
        FROM claims c
        JOIN items i ON c.item_id = i.item_id
        WHERE c.claim_id = ?
    ");
    $stmt->execute([$claim_id]);
    $claim = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$claim) {
        throw new Exception("Claim not found");
    }

    if ($claim['owner_id'] !== $user_id) {
        throw new Exception("Unauthorized to manage this claim");
    }

    if ($claim['claim_status'] !== 'pending') {
        throw new Exception("Claim is already " . $claim['claim_status']);
    }

    $item_id = $claim['item_id'];

    if ($action === 'approve') {
        // 1. Mark this claim as approved
        $stmt = $pdo->prepare("UPDATE claims SET status = 'approved' WHERE claim_id = ?");
        $stmt->execute([$claim_id]);

        // 2. Mark item as returned
        $stmt = $pdo->prepare("UPDATE items SET status = 'returned' WHERE item_id = ?");
        $stmt->execute([$item_id]);

        // 3. Mark other pending claims for this item as rejected
        $stmt = $pdo->prepare("UPDATE claims SET status = 'rejected' WHERE item_id = ? AND claim_id != ? AND status = 'pending'");
        $stmt->execute([$item_id, $claim_id]);
        
    } else if ($action === 'reject') {
        // Just Mark this claim as rejected
        $stmt = $pdo->prepare("UPDATE claims SET status = 'rejected' WHERE claim_id = ?");
        $stmt->execute([$claim_id]);
    }

    $pdo->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>

