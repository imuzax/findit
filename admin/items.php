<?php
require_once '../includes/config.php';
require_once 'includes/auth_check.php';

$stmt = $pdo->query("SELECT i.*, u.full_name FROM items i JOIN users u ON i.user_id = u.user_id ORDER BY i.admin_approved ASC, i.created_at DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items - FindIt Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="bg-[#F8FAFC] font-['Inter']">
    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 p-8 lg:p-12 min-h-screen">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-[#0D1B2A]">Item Management</h2>
                <p class="text-slate-500 text-sm">Review and moderate all lost/found reports.</p>
            </div>
        </header>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Item Description</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Reporter</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($items as $item): ?>
                    <tr class="hover:bg-slate-50/50 transition-colors <?= !$item['admin_approved'] ? 'bg-orange-50/30' : '' ?>">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-[#0D1B2A]"><?= htmlspecialchars($item['title']) ?></p>
                            <p class="text-[10px] text-slate-500 uppercase"><?= htmlspecialchars($item['category']) ?> • <?= htmlspecialchars($item['type']) ?></p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($item['full_name']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?= $item['admin_approved'] ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' ?>">
                                <?= $item['admin_approved'] ? 'Approved' : 'Pending' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <button onclick="adminAction(<?= $item['item_id'] ?>, 'delete')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                            <?php if(!$item['admin_approved']): ?>
                                <button onclick="adminAction(<?= $item['item_id'] ?>, 'approve')" class="px-4 py-2 bg-secondary text-white text-xs font-bold rounded-lg hover:opacity-90 shadow-sm">Approve</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
    async function adminAction(itemId, action) {
        if(!confirm(`Are you sure you want to ${action} this item?`)) return;
        
        const formData = new FormData();
        formData.append('item_id', itemId);
        formData.append('action', action);
        
        try {
            // We can reuse the same API I created earlier, just update the path
            const response = await fetch('../api/admin_action.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            if(data.success) {
                window.location.reload();
            } else {
                alert(data.message);
            }
        } catch (err) {
            alert("Error processing action.");
        }
    }
    </script>
</body>
</html>
