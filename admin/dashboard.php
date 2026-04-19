<?php
require_once '../includes/config.php';
require_once 'includes/auth_check.php';

// Real-time Stats
$totalItems = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
$pendingApprovals = $pdo->query("SELECT COUNT(*) FROM items WHERE admin_approved = 0")->fetchColumn();
$resolvedItems = $pdo->query("SELECT COUNT(*) FROM items WHERE status = 'returned'")->fetchColumn();

// Recent Items for Activity Feed
$stmtRecent = $pdo->query("SELECT i.*, u.full_name FROM items i JOIN users u ON i.user_id = u.user_id ORDER BY i.created_at DESC LIMIT 5");
$recentItems = $stmtRecent->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FindIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="bg-[#F8FAFC] font-['Inter']">
    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 p-8 lg:p-12 min-h-screen">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-[#0D1B2A]">Overview</h2>
                <p class="text-slate-500 text-sm">System performance and activity summary.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-400">ADMIN</p>
                    <p class="text-sm font-bold"><?= $_SESSION['full_name'] ?></p>
                </div>
                <div class="w-10 h-10 rounded-full bg-[#0F7173] text-white flex items-center justify-center font-bold">
                    <?= substr($_SESSION['full_name'], 0, 1) ?>
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined">inventory_2</span>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase">Total Items</p>
                <p class="text-3xl font-black mt-1"><?= $totalItems ?></p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase">Users</p>
                <p class="text-3xl font-black mt-1"><?= $totalUsers ?></p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase">Pending</p>
                <p class="text-3xl font-black mt-1 text-orange-600"><?= $pendingApprovals ?></p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined">task_alt</span>
                </div>
                <p class="text-xs font-bold text-slate-400 uppercase">Resolved</p>
                <p class="text-3xl font-black mt-1 text-purple-600"><?= $resolvedItems ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <h3 class="text-lg font-bold mb-6 text-[#0D1B2A]">Recent Submissions</h3>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Item</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">User</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach($recentItems as $item): ?>
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-[#0D1B2A]"><?= htmlspecialchars($item['title']) ?></p>
                                    <p class="text-[10px] text-slate-400 uppercase"><?= htmlspecialchars($item['type']) ?></p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($item['full_name']) ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?= $item['admin_approved'] ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' ?>">
                                        <?= $item['admin_approved'] ? 'Approved' : 'Pending' ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="p-4 text-center border-t border-slate-100">
                        <a href="items.php" class="text-xs font-bold text-[#0F7173] hover:underline">View All Items</a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-6">
                <h3 class="text-lg font-bold mb-6 text-[#0D1B2A]">Quick Control</h3>
                <div class="bg-[#0D1B2A] p-8 rounded-3xl text-white shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-bl-full"></div>
                    <h4 class="font-bold mb-4">System Maintenance</h4>
                    <p class="text-xs text-slate-400 mb-6 leading-relaxed">Regularly clear rejected claims and inactive reports to keep the system fast.</p>
                    <a href="api/export_db.php" class="w-full py-3 bg-[#0F7173] rounded-xl text-xs font-bold hover:bg-[#0c5d5e] transition-all text-center block">Download DB Backup</a>
                </div>
                
                <div class="bg-white p-6 rounded-2xl border border-slate-100">
                    <h4 class="font-bold mb-4 text-sm text-slate-400 uppercase">Action Needed</h4>
                    <?php if($pendingApprovals > 0): ?>
                        <div class="p-4 bg-orange-50 border-l-4 border-orange-400 rounded-r-xl">
                            <p class="text-sm font-bold text-orange-800"><?= $pendingApprovals ?> items awaiting review.</p>
                            <a href="items.php" class="text-xs font-bold text-orange-600 hover:underline mt-1 inline-block">Review Now →</a>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-slate-400">Everything is up to date.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
