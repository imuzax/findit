<?php
/**
 * API: Approve Claim (Admin only)
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/admin_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

$claimId = filter_input(INPUT_POST, 'claim_id', FILTER_VALIDATE_INT);
$status = sanitizeInput($_POST['status'] ?? ''); // 'approved' or 'rejected'

if (!$claimId || !in_array($status, ['approved', 'rejected'])) {
    jsonResponse(false, null, 'Invalid claim ID or status.');
}

try {
    $pdo->beginTransaction();

    // Update claim status
    $stmt = $pdo->prepare("UPDATE claims SET status = ? WHERE claim_id = ?");
    $stmt->execute([$status, $claimId]);

    if ($status === 'approved') {
        // Fetch item ID from claim
        $claimStmt = $pdo->prepare("SELECT item_id FROM claims WHERE claim_id = ?");
        $claimStmt->execute([$claimId]);
        $claim = $claimStmt->fetch();

        if ($claim) {
            // Mark item as returned
            $itemStmt = $pdo->prepare("UPDATE items SET status = 'returned' WHERE item_id = ?");
            $itemStmt->execute([$claim['item_id']]);
        }
    }

    $pdo->commit();
    jsonResponse(true, null, "Claim has been $status.");

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

