<?php
/**
 * Middleware: Check Authentication
 * Include this at the top of protected pages.
 */
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user_id'])) {
    // If it's an AJAX request, return JSON error
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized. Please login.']);
        exit;
    }
    
    // Otherwise, redirect to login page
    header('Location: /findit/auth.php');
    exit;
}
?>
