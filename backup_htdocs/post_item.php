<?php
/**
 * API: Post a new item (Lost or Found)
 */
require_once '../includes/config.php';
require_once '../includes/helpers.php';
require_once '../includes/auth_check.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, null, 'Invalid request method. Only POST allowed.');
}

// 1. Gather inputs
$userId = $_SESSION['user_id'];
$type = sanitizeInput($_POST['type'] ?? 'lost');
$title = sanitizeInput($_POST['title'] ?? '');
$description = sanitizeInput($_POST['description'] ?? '');
$category = sanitizeInput($_POST['category'] ?? 'Other');
$color = sanitizeInput($_POST['color'] ?? '');
$brand = sanitizeInput($_POST['brand'] ?? '');
$dateOccurred = sanitizeInput($_POST['date_occurred'] ?? date('Y-m-d'));
$locationText = sanitizeInput($_POST['location_text'] ?? '');

if (empty($title) || empty($description) || empty($category) || empty($locationText)) {
    jsonResponse(false, null, 'Please fill all required fields.');
}

try {
    // 2. Insert into items table
    $stmt = $pdo->prepare("INSERT INTO items (user_id, type, title, description, category, color, brand, date_occurred, location_text) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $type, $title, $description, $category, $color, $brand, $dateOccurred, $locationText]);
    
    $itemId = $pdo->lastInsertId();

    // 3. Handle File Uploads (if any)
    $uploadPath = '';
    if (isset($_FILES['images']) && $_FILES['images']['error'][0] != UPLOAD_ERR_NO_FILE) {
        $files = $_FILES['images'];
        $uploadedAny = false;
        
        // Loop through multiple files
        for ($i = 0; $i < count($files['name']); $i++) {
            $fileArray = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            ];
            
            $uploadResult = handleFileUpload($fileArray, '../uploads/items');
            
            if ($uploadResult['success']) {
                $status = $i === 0 ? 1 : 0; // First uploaded image is primary
                $imgPath = '/uploads/items/' . $uploadResult['filename'];
                
                $imgStmt = $pdo->prepare("INSERT INTO item_images (item_id, image_path, is_primary) VALUES (?, ?, ?)");
                $imgStmt->execute([$itemId, $imgPath, $status]);
                $uploadedAny = true;
            }
        }
        
        // If no image successfully uploaded, add a placeholder
        if (!$uploadedAny) {
            $pdo->prepare("INSERT INTO item_images (item_id, image_path, is_primary) VALUES (?, '/assets/img/placeholder.jpg', 1)")->execute([$itemId]);
        }
    } else {
        // Default placeholder
        $pdo->prepare("INSERT INTO item_images (item_id, image_path, is_primary) VALUES (?, '/assets/img/placeholder.jpg', 1)")->execute([$itemId]);
    }

    jsonResponse(true, ['item_id' => $itemId], 'Item posted successfully.');

} catch (PDOException $e) {
    jsonResponse(false, null, 'Database error: ' . $e->getMessage());
}
?>
