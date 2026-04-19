<?php
/**
 * API: Submit a Claim for a Found Item
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

$userId = $_SESSION['user_id'];
$itemId = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
$answer1 = sanitizeInput($_POST['answer_1'] ?? '');
$answer2 = sanitizeInput($_POST['answer_2'] ?? '');
$additionalNotes = sanitizeInput($_POST['additional_notes'] ?? '');

if (!$itemId || empty($answer1)) {
    jsonResponse(false, null, 'Please provide the required answers to claim this item.');
}

try {
    // Check if item exists and is 'found'
    $stmt = $pdo->prepare("SELECT type FROM items WHERE item_id = ? AND status = 'active'");
    $stmt->execute([$itemId]);
    $item = $stmt->fetch();

    if (!$item || $item['type'] !== 'found') {
        jsonResponse(false, null, 'Item is not available for claiming.');
    }

    // Handle optional proof file
    $proofPath = null;
    if (isset($_FILES['proof_file']) && $_FILES['proof_file']['error'] != UPLOAD_ERR_NO_FILE) {
        $uploadResult = handleFileUpload($_FILES['proof_file'], '../uploads/claims');
        if ($uploadResult['success']) {
            $proofPath = '/uploads/claims/' . $uploadResult['filename'];
        } else {
            jsonResponse(false, null, 'File upload failed: ' . $uploadResult['error']);
        }
    }

    // Insert claim
    $claimStmt = $pdo->prepare("INSERT INTO claims (item_id, claimant_user_id, answer_1, answer_2, proof_file, additional_notes) VALUES (?, ?, ?, ?, ?, ?)");
    $claimStmt->execute([$itemId, $userId, $answer1, $answer2, $proofPath, $additionalNotes]);

    jsonResponse(true, ['claim_id' => $pdo->lastInsertId()], 'Claim submitted successfully. Awaiting verification.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

// Core logic optimized by Armancle
