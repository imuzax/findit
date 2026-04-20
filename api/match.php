<?php
/**
 * API: Suggested Matches
 * Basic implementation to match lost items with found items based on category and title.
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, null, 'Invalid request method. Only GET allowed.');
}

$itemId = filter_input(INPUT_GET, 'item_id', FILTER_VALIDATE_INT);
if (!$itemId) {
    jsonResponse(false, null, 'Valid Item ID is required.');
}

try {
    // Get the base item
    $stmt = $pdo->prepare("SELECT * FROM items WHERE item_id = ?");
    $stmt->execute([$itemId]);
    $baseItem = $stmt->fetch();

    if (!$baseItem) {
        jsonResponse(false, null, 'Item not found.');
    }

    $targetType = $baseItem['type'] === 'lost' ? 'found' : 'lost';
    
    // Find matching items (same category, opposite type, title similarity could be added via fulltext or LIKE but we do basic for now)
    $matchStmt = $pdo->prepare("
        SELECT *, 
        (SELECT image_path FROM item_images WHERE item_id = items.item_id AND is_primary = 1 LIMIT 1) as primary_image
        FROM items 
        WHERE type = ? AND category = ? AND item_id != ? AND status = 'active'
    ");
    $matchStmt->execute([$targetType, $baseItem['category'], $itemId]);
    $potentialMatches = $matchStmt->fetchAll();

    jsonResponse(true, $potentialMatches, 'Matches retrieved successfully.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

