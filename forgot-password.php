<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/helpers.php';

$message = '';
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $dept = sanitizeInput($_POST['department']);
    $roll = sanitizeInput($_POST['roll_number']);
    $new_password = $_POST['new_password'];

    // Verify if email, department, and roll number match
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ? AND department = ? AND roll_number = ?");
    $stmt->execute([$email, $dept, $roll]);
    $user = $stmt->fetch();

    if ($user) {
        if (strlen($new_password) < 6) {
            $message = "Password must be at least 6 characters.";
            $status = "error";
        } else {
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            // Update both hash (for login) and plain (for admin view)
            $update = $pdo->prepare("UPDATE users SET password_hash = ?, password_plain = ? WHERE user_id = ?");
            $update->execute([$hash, $new_password, $user['user_id']]);
            $message = "Password reset successfully! You can now login.";
            $status = "success";
        }
    } else {
        $message = "Incorrect details. Please check your Email, Department, and Roll Number.";
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FindIt - Secure Password Reset</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#0D1B2A",
                        secondary: "#0F7173",
                        background: "#f7fafc",
                        surface: "#ffffff"
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background min-h-screen flex items-center justify-center p-6 font-['Inter']">
    <div class="w-full max-w-md bg-surface p-10 rounded-2xl shadow-xl border border-slate-100">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-primary mb-2">Reset Password</h1>
            <p class="text-sm text-slate-500">Verify your identity to set a new password.</p>
        </div>

        <?php if($message): ?>
            <div class="mb-6 p-4 rounded-lg text-sm font-bold text-center <?= $status === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email Address</label>
                <input name="email" type="email" class="w-full p-3 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-secondary mt-1" required placeholder="yourname@example.com">
            </div>
            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Department</label>
                <input name="department" type="text" class="w-full p-3 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-secondary mt-1" required placeholder="e.g., BCA">
            </div>
            <div>
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Roll Number</label>
                <input name="roll_number" type="text" class="w-full p-3 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-secondary mt-1" required placeholder="e.g., 1234">
            </div>
            <div class="pt-4 border-t border-slate-100">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">New Password</label>
                <input name="new_password" type="password" class="w-full p-3 rounded-lg bg-slate-50 border-none focus:ring-2 focus:ring-secondary mt-1" required placeholder="Min 6 characters">
            </div>
            
            <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-lg hover:opacity-95 transition-all shadow-lg mt-4">
                Set New Password
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="auth.php" class="text-sm font-bold text-secondary hover:underline">Back to Login</a>
        </div>
    </div>
</body>
</html>

// Project finalized and optimized by Armancle
