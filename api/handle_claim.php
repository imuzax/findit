<?php
/**
 * API: Handle Claim (Accept/Reject)
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method.');
}

$userId = $_SESSION['user_id'];
$claimId = isset($_POST['claim_id']) ? (int)$_POST['claim_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : ''; // 'approve' or 'reject'

if (!$claimId || !in_array($action, ['approve', 'reject'])) {
    jsonResponse(false, null, 'Invalid parameters.');
}

try {
    // 1. Verify that the current user is the owner of the item for this claim
    $stmt = $pdo->prepare("
        SELECT c.*, i.user_id as item_owner_id, i.item_id 
        FROM claims c 
        JOIN items i ON c.item_id = i.item_id 
        WHERE c.claim_id = ?
    ");
    $stmt->execute([$claimId]);
    $claim = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$claim) {
        jsonResponse(false, null, 'Claim request not found.');
    }

    if ($claim['item_owner_id'] != $userId) {
        jsonResponse(false, null, 'Unauthorized action.');
    }

    if ($claim['status'] !== 'pending') {
        jsonResponse(false, null, 'This claim has already been processed.');
    }

    $newStatus = ($action === 'approve') ? 'approved' : 'rejected';

    // 2. Update claim status
    $updateStmt = $pdo->prepare("UPDATE claims SET status = ? WHERE claim_id = ?");
    $updateStmt->execute([$newStatus, $claimId]);

    // 3. If approved, update item status to 'returned'
    if ($action === 'approve') {
        $itemUpdate = $pdo->prepare("UPDATE items SET status = 'returned' WHERE item_id = ?");
        $itemUpdate->execute([$claim['item_id']]);
        
        // Optionally reject all other pending claims for this item
        $rejectOthers = $pdo->prepare("UPDATE claims SET status = 'rejected' WHERE item_id = ? AND claim_id != ? AND status = 'pending'");
        $rejectOthers->execute([$claim['item_id'], $claimId]);
    }

    jsonResponse(true, null, "Claim request " . ($action === 'approve' ? 'approved' : 'rejected') . " successfully.");

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
