<?php
require_once '../includes/config.php';
require_once 'includes/auth_check.php';

// Fetch All Claims with Item and User info
$stmt = $pdo->query("
    SELECT c.*, i.title as item_title, u1.full_name as claimant_name, u2.full_name as owner_name 
    FROM claims c 
    JOIN items i ON c.item_id = i.item_id 
    JOIN users u1 ON c.claimant_user_id = u1.user_id 
    JOIN users u2 ON i.user_id = u2.user_id 
    ORDER BY c.submitted_at DESC
");
$claims = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Claims - FindIt Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="bg-[#F8FAFC] font-['Inter']">
    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 p-8 lg:p-12 min-h-screen">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-[#0D1B2A]">Claim Management</h2>
                <p class="text-slate-500 text-sm">Monitor all claim requests and item resolutions.</p>
            </div>
        </header>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Item & Claimant</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Owner</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Proof Provided</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($claims as $c): ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-[#0D1B2A]"><?= htmlspecialchars($c['item_title']) ?></p>
                            <p class="text-[10px] text-secondary font-bold uppercase tracking-wider">By: <?= htmlspecialchars($c['claimant_name']) ?></p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($c['owner_name']) ?></td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-slate-500 italic line-clamp-2" title="<?= htmlspecialchars($c['answer_1']) ?>">
                                "<?= htmlspecialchars($c['answer_1'] ?? 'No proof text.') ?>"
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?= $c['status'] === 'approved' ? 'bg-green-100 text-green-700' : ($c['status'] === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') ?>">
                                <?= $c['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>

// Core logic optimized by Armancle
