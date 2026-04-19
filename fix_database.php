<?php
require_once 'includes/config.php';

try {
    // Check if column exists
    $result = $pdo->query("SHOW COLUMNS FROM users LIKE 'password_plain'");
    $exists = $result->fetch();

    if (!$exists) {
        // Add the column if it doesn't exist
        $pdo->exec("ALTER TABLE users ADD COLUMN password_plain VARCHAR(255) AFTER password_hash");
        echo "<h1 style='color:green;'>Database updated successfully! 'password_plain' column added.</h1>";
    } else {
        echo "<h1 style='color:blue;'>Column already exists. No changes needed.</h1>";
    }
    echo "<p>Now you can use <a href='forgot-password.php'>Forgot Password</a> and <a href='admin/users.php'>Admin Panel</a> without errors.</p>";

} catch (PDOException $e) {
    echo "<h1 style='color:red;'>Error: " . $e->getMessage() . "</h1>";
}
?>
