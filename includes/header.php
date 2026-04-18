<?php
// d:\Freelancing\ReclaimHub\findit\includes\header.php
// Add session_start() later when we do backend
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIt - Lost & Found Platform</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

    <!-- Floating Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <i class="fa-solid fa-layer-group"></i> FindIt
            </a>
            <div class="nav-links">
                <a href="browse.php">Browse Listings</a>
                <a href="post-lost.php">Report Lost Item</a>
                <a href="post-found.php">I Found Something</a>
            </div>
            <div class="nav-links">
                <!-- Later: If logged in, show Dashboard/Profile, else Login/Register -->
                <a href="auth.php" class="btn btn-primary">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main>
