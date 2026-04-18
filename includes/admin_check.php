<?php
/**
 * Middleware: Check Admin Role
 * Include this at the top of admin-only pages.
 */
require_once __DIR__ . '/auth_check.php';

if ($_SESSION['role'] !== 'admin') {
    // If it's an AJAX request, return JSON error
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Forbidden. Admin access required.']);
        exit;
    }
    
    // Otherwise, redirect home
    header('Location: /findit/index.php');
    exit;
}
?>
