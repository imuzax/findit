<?php
/**
 * Global Helper Functions
 */

// Output standard JSON response
function jsonResponse($success, $data = null, $message = null) {
    header('Content-Type: application/json');
    $response = ['success' => $success];
    if ($data !== null) $response['data'] = $data;
    if ($message !== null) $response['message'] = $message;
    echo json_encode($response);
    exit;
}

// Sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return $data;
}

// Handle file upload
function handleFileUpload($file, $destinationDir) {
    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'error' => 'Invalid file parameters.'];
    }

    switch ($file['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            return ['success' => false, 'error' => 'No file sent.'];
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return ['success' => false, 'error' => 'Exceeded filesize limit.'];
        default:
            return ['success' => false, 'error' => 'Unknown errors.'];
    }

    if ($file['size'] > 5000000) { // 5MB limit
        return ['success' => false, 'error' => 'File too large. Max 5MB allowed.'];
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeMode = $finfo->file($file['tmp_name']);
    $allowedTypes = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'webp' => 'image/webp'
    ];

    $ext = array_search($mimeMode, $allowedTypes, true);
    if ($ext === false) {
        return ['success' => false, 'error' => 'Invalid file format.'];
    }

    $fileName = uniqid('item_', true) . '.' . $ext;
    // ensure dir exists
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0755, true);
    }
    
    $fullPath = rtrim($destinationDir, '/') . '/' . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
        return ['success' => false, 'error' => 'Failed to move uploaded file.'];
    }

    return ['success' => true, 'filename' => $fileName];
}

// CSRF Token Generation
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// CSRF Token Verification
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>
