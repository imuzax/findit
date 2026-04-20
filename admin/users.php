<?php
require_once '../includes/config.php';
require_once 'includes/auth_check.php';

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - FindIt Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="bg-[#F8FAFC] font-['Inter']">
    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 p-8 lg:p-12 min-h-screen">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-[#0D1B2A]">User Management</h2>
                <p class="text-slate-500 text-sm">View and manage all registered students.</p>
            </div>
        </header>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Student Details</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Department</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Roll No</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-[#0F7173]">Password</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($users as $u): ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs">
                                    <?= substr($u['full_name'], 0, 1) ?>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#0D1B2A]"><?= htmlspecialchars($u['full_name']) ?></p>
                                    <p class="text-[10px] text-slate-400"><?= htmlspecialchars($u['email']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($u['department'] ?? 'N/A') ?></td>
                        <td class="px-6 py-4 text-sm font-mono text-slate-500"><?= htmlspecialchars($u['roll_number'] ?? 'N/A') ?></td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-mono font-bold text-secondary bg-secondary/5 px-2 py-1 rounded">
                                <?= htmlspecialchars($u['password_plain'] ?? '********') ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?= $u['role'] === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' ?>">
                                <?= $u['role'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <?php if($u['role'] !== 'admin'): ?>
                                <button onclick="deleteUser(<?= $u['user_id'] ?>)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Delete User">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                                <button onclick="resetPassword(<?= $u['user_id'] ?>)" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Reset Password">
                                    <span class="material-symbols-outlined text-sm">lock_reset</span>
                                </button>
                            <?php else: ?>
                                <span class="text-[10px] font-bold text-slate-300 uppercase">System Protected</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
    async function deleteUser(userId) {
        if(!confirm("Are you sure you want to delete this user? All their posts and data will be lost.")) return;
        
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('action', 'delete_user');
        
        const res = await fetch('api/admin_user_action.php', { method: 'POST', body: formData });
        const data = await res.json();
        if(data.success) window.location.reload();
        else alert(data.message);
    }

    async function resetPassword(userId) {
        const newPass = prompt("Enter new password for this user:");
        if(!newPass) return;
        
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('new_password', newPass);
        formData.append('action', 'reset_password');
        
        const res = await fetch('api/admin_user_action.php', { method: 'POST', body: formData });
        const data = await res.json();
        alert(data.message);
    }
    </script>
</body>
</html>

