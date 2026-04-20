<?php
/**
 * API: Search Items
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, null, 'Invalid request method. Only GET allowed.');
}

$query = sanitizeInput($_GET['q'] ?? '');
$category = sanitizeInput($_GET['category'] ?? '');
$type = sanitizeInput($_GET['type'] ?? ''); // 'lost' or 'found'

$sql = "SELECT i.*, 
        (SELECT image_path FROM item_images WHERE item_id = i.item_id AND is_primary = 1 LIMIT 1) as primary_image 
        FROM items i WHERE 1=1";
$params = [];

if (!empty($query)) {
    $sql .= " AND (i.title LIKE ? OR i.description LIKE ?)";
    $params[] = "%$query%";
    $params[] = "%$query%";
}

if (!empty($category)) {
    $sql .= " AND i.category = ?";
    $params[] = $category;
}

if (!empty($type)) {
    $sql .= " AND i.type = ?";
    $params[] = $type;
}

$sql .= " ORDER BY i.created_at DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll();

    jsonResponse(true, $results);

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>

