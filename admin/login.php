<?php
session_start();
require_once '../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FindIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#0D1B2A] min-h-screen flex items-center justify-center font-['Inter'] p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-[#0F7173] to-[#0D1B2A] p-8 text-center text-white">
            <h1 class="text-2xl font-extrabold tracking-tight">FindIt Admin</h1>
            <p class="text-sm opacity-80 mt-1">Authorized Access Only</p>
        </div>
        
        <form method="POST" class="p-8 space-y-6">
            <?php if($error): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm font-bold border border-red-100">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase">Admin Email</label>
                <input type="email" name="email" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0F7173] outline-none">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 uppercase">Password</label>
                <input type="password" name="password" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-[#0F7173] outline-none">
            </div>

            <button type="submit" class="w-full py-4 bg-[#0D1B2A] text-white font-bold rounded-lg hover:opacity-95 transition-all shadow-lg">
                Access Dashboard
            </button>
            
            <div class="text-center mt-4">
                <a href="../index.php" class="text-xs text-slate-400 hover:text-[#0F7173]">Back to Main Site</a>
            </div>
        </form>
    </div>
</body>
</html>

// Core logic optimized by Armancle
