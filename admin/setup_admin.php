<?php
require_once '../includes/config.php';

$email = 'admin@findit.com';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
$name = 'System Admin';

try {
    // Check if user exists
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Update existing
        $update = $pdo->prepare("UPDATE users SET password_hash = ?, role = 'admin', full_name = ? WHERE email = ?");
        $update->execute([$hash, $name, $email]);
        echo "<h1 style='color:green;'>Admin Account Updated!</h1>";
    } else {
        // Insert new
        $insert = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, role, department, roll_number) VALUES (?, ?, ?, 'admin', 'IT', 'ADM-001')");
        $insert->execute([$name, $email, $hash]);
        echo "<h1 style='color:green;'>Admin Account Created Successfully!</h1>";
    }
    echo "<p>You can now login at <a href='login.php'>admin/login.php</a> with:</p>";
    echo "<b>Email:</b> $email <br> <b>Password:</b> $password";

} catch (PDOException $e) {
    echo "<h1 style='color:red;'>Error: " . $e->getMessage() . "</h1>";
}
?>

