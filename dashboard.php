<?php
require_once 'includes/config.php';
require_once 'includes/auth_check.php';

$user_id = $_SESSION['user_id'];

// Get counts
$stmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE user_id = ? AND type = 'lost'");
$stmt->execute([$user_id]);
$lost_count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE user_id = ? AND type = 'found'");
$stmt->execute([$user_id]);
$found_count = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE user_id = ? AND status = 'returned'");
$stmt->execute([$user_id]);
$items_recovered = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM claims WHERE item_id IN (SELECT item_id FROM items WHERE user_id = ?) AND status = 'pending'");
$stmt->execute([$user_id]);
$pending_claims = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM claims WHERE item_id IN (SELECT item_id FROM items WHERE user_id = ?) AND status = 'pending'");
$stmt->execute([$user_id]);
$pending_claims_count = $stmt->fetchColumn();

// Get active reports
$stmt = $pdo->prepare("
    SELECT i.*, 
           (SELECT image_path FROM item_images WHERE item_id = i.item_id ORDER BY is_primary DESC LIMIT 1) as primary_image
    FROM items i
    WHERE i.user_id = ? AND i.status IN ('active', 'matched', 'verified')
    ORDER BY i.created_at DESC
    LIMIT 5
");
$stmt->execute([$user_id]);
$my_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get pending claims on my items
$stmt = $pdo->prepare("
    SELECT c.*, i.title as item_title, u.full_name as claimant_name 
    FROM claims c 
    JOIN items i ON c.item_id = i.item_id 
    JOIN users u ON c.claimant_user_id = u.user_id 
    WHERE i.user_id = ? AND c.status = 'pending'
    ORDER BY c.submitted_at DESC
");
$stmt->execute([$user_id]);
$pending_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>User Dashboard - FindIt</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
                  "on-secondary-fixed-variant": "#004f51",
                  "on-primary": "#ffffff",
                  "on-primary-fixed": "#0f1c2c",
                  "tertiary-container": "#2f1400",
                  "surface-container-low": "#f1f4f6",
                  "secondary-container": "#9cedef",
                  "inverse-surface": "#2d3133",
                  "surface-container-lowest": "#ffffff",
                  "surface-bright": "#f7fafc",
                  "surface-variant": "#e0e3e5",
                  "surface-container": "#ebeef0",
                  "primary": "#000000",
                  "primary-fixed-dim": "#bac8dc",
                  "surface-container-highest": "#e0e3e5",
                  "secondary": "#00696b",
                  "tertiary-fixed": "#ffdcc4",
                  "surface-dim": "#d7dadc",
                  "secondary-fixed": "#9ff0f2",
                  "on-error-container": "#93000a",
                  "surface": "#f7fafc",
                  "on-tertiary-fixed": "#2f1400",
                  "on-tertiary": "#ffffff",
                  "inverse-primary": "#bac8dc",
                  "on-tertiary-container": "#bb7336",
                  "on-error": "#ffffff",
                  "primary-fixed": "#d6e4f9",
                  "on-tertiary-fixed-variant": "#6f3800",
                  "surface-container-high": "#e5e9eb",
                  "on-surface": "#181c1e",
                  "on-secondary": "#ffffff",
                  "inverse-on-surface": "#eef1f3",
                  "outline-variant": "#c4c6cc",
                  "tertiary": "#000000",
                  "outline": "#74777d",
                  "error": "#ba1a1a",
                  "on-background": "#181c1e",
                  "on-primary-container": "#778598",
                  "primary-container": "#0f1c2c",
                  "secondary-fixed-dim": "#83d4d6",
                  "on-primary-fixed-variant": "#3a4859",
                  "on-surface-variant": "#44474c",
                  "tertiary-fixed-dim": "#ffb780",
                  "on-secondary-container": "#066e70",
                  "error-container": "#ffdad6",
                  "surface-tint": "#525f71",
                  "on-secondary-fixed": "#002020",
                  "background": "#f7fafc"
          },
          "borderRadius": {
                  "DEFAULT": "0.25rem",
                  "lg": "0.5rem",
                  "xl": "0.75rem",
                  "full": "9999px"
          },
          "spacing": {},
          "fontFamily": {
                  "headline": [
                          "Inter"
                  ],
                  "body": [
                          "Inter"
                  ],
                  "label": [
                          "Inter"
                  ]
          }
        },
      },
    }
  </script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
  </style>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-surface text-on-surface flex min-h-screen">
<!-- SideNavBar -->
<nav class="hidden md:flex flex-col gap-4 p-6 bg-[#f7fafc] dark:bg-slate-950 w-[220px] h-screen fixed left-0 border-r-0 tonal-layering bg-[#f1f4f6] dark:bg-slate-900 flat no-line z-40">
<div class="mb-8">
<h1 class="text-xl font-bold text-[#0D1B2A] dark:text-white font-['Inter'] tracking-tight">FindIt</h1>
<p class="text-sm text-on-surface-variant font-['Inter']">Digital Concierge</p>
</div>
<div class="flex flex-col gap-2 font-['Inter'] text-sm font-medium">
<a class="flex items-center gap-3 p-3 text-[#0F7173] bg-white dark:bg-slate-800 rounded-lg shadow-sm font-semibold hover:translate-x-1 transition-transform cursor-pointer transition-all" href="dashboard.php">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
        Dashboard
      </a>
<a class="flex items-center gap-3 p-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all rounded-lg" href="dashboard.php">
<span class="material-symbols-outlined" data-icon="description">description</span>
        My Reports
      </a>
<a class="flex items-center gap-3 p-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all rounded-lg" href="#claims-section">
<span class="material-symbols-outlined" data-icon="notification_important">notification_important</span>
        Claim Requests
      </a>
<a class="flex items-center gap-3 p-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all rounded-lg opacity-50 pointer-events-none" href="#" title="Coming soon">
<span class="material-symbols-outlined" data-icon="bookmark">bookmark</span>
        Saved Items
      </a>
<a class="flex items-center gap-3 p-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all rounded-lg" href="profile.php">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
        Settings
      </a>
<a class="flex items-center gap-3 p-3 text-error hover:bg-red-50 dark:hover:bg-red-900/20 hover:translate-x-1 transition-transform cursor-pointer transition-all rounded-lg" href="logout.php">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
        Logout
      </a>
</div>
<div class="mt-auto pt-6 flex flex-col gap-2">
<a href="post-lost.php" class="w-full bg-[#F4A261] hover:opacity-90 text-white py-3 px-4 rounded-DEFAULT font-bold text-sm transition-all shadow-sm flex items-center justify-center gap-2">
<span class="material-symbols-outlined" data-icon="search">search</span>
        Lost Item
      </a>
<a href="post-found.php" class="w-full bg-[#0F7173] hover:opacity-90 text-white py-3 px-4 rounded-DEFAULT font-bold text-sm transition-all shadow-sm flex items-center justify-center gap-2">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
        Found Item
      </a>
</div>
</nav>
<!-- Main Content -->
<main class="flex-1 ml-0 md:ml-[220px] p-6 md:p-12 max-w-7xl">
<!-- Header -->
<?php include 'includes/navbar.php'; ?>

<!-- Welcome Section -->
<div class="mb-8 mt-4">
    <h2 class="text-2xl font-bold text-[#0D1B2A] mb-1">Welcome back, <?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?>! 👋</h2>
    <p class="text-sm text-on-surface-variant">Here's an overview of your activity and reports.</p>
</div>

<!-- Stats Row -->
<section class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
<div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0_8px_32px_rgba(13,27,42,0.06)] border-l-4 border-[#F4A261]">
<div class="flex items-center gap-3 mb-4 text-on-surface-variant">
<span class="material-symbols-outlined text-[#F4A261]" data-icon="search">search</span>
<span class="text-xs font-semibold uppercase tracking-wider">My Lost Posts</span>
</div>
<p class="text-3xl font-bold text-[#0D1B2A]"><?= $lost_count ?></p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0_8px_32px_rgba(13,27,42,0.06)] border-l-4 border-[#0F7173]">
<div class="flex items-center gap-3 mb-4 text-on-surface-variant">
<span class="material-symbols-outlined text-[#0F7173]" data-icon="volunteer_activism">volunteer_activism</span>
<span class="text-xs font-semibold uppercase tracking-wider">My Found Posts</span>
</div>
<p class="text-3xl font-bold text-[#0D1B2A]"><?= $found_count ?></p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0_8px_32px_rgba(13,27,42,0.06)]">
<div class="flex items-center gap-3 mb-4 text-on-surface-variant">
<span class="material-symbols-outlined text-[#0D1B2A]" data-icon="check_circle">check_circle</span>
<span class="text-xs font-semibold uppercase tracking-wider">Recovered</span>
</div>
<p class="text-3xl font-bold text-[#0D1B2A]"><?= $items_recovered ?></p>
</div>
<div class="bg-surface-container-lowest p-6 rounded-lg shadow-[0_8px_32px_rgba(13,27,42,0.06)] relative overflow-hidden">
<div class="absolute top-0 right-0 w-16 h-16 bg-[#0D1B2A]/5 rounded-bl-full"></div>
<div class="flex items-center gap-3 mb-4 text-on-surface-variant">
<span class="material-symbols-outlined text-[#0D1B2A]" data-icon="notification_important">notification_important</span>
<span class="text-xs font-semibold uppercase tracking-wider">Claim Requests</span>
</div>
<p class="text-3xl font-bold text-[#0D1B2A]"><?= $pending_claims_count ?></p>
</div>
</section>
<!-- Quick Actions -->
<section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
<a href="post-lost.php" class="group relative overflow-hidden rounded-xl p-8 text-left transition-transform hover:-translate-y-1 bg-gradient-to-br from-[#F4A261] to-[#d9823f] shadow-[0_8px_32px_rgba(244,162,97,0.2)] block">
<div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative z-10 text-white">
<span class="material-symbols-outlined text-4xl mb-4 block" data-icon="search_hands_free">search_hands_free</span>
<h3 class="text-xl font-bold mb-2">Report a Lost Item</h3>
<p class="text-white/90 text-sm">Alert the community to help you find what you have lost.</p>
</div>
</a>
<a href="post-found.php" class="group relative overflow-hidden rounded-xl p-8 text-left transition-transform hover:-translate-y-1 bg-gradient-to-br from-[#0F7173] to-[#0a4e50] shadow-[0_8px_32px_rgba(15,113,115,0.2)] block">
<div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative z-10 text-white">
<span class="material-symbols-outlined text-4xl mb-4 block" data-icon="volunteer_activism">volunteer_activism</span>
<h3 class="text-xl font-bold mb-2">Report a Found Item</h3>
<p class="text-white/90 text-sm">Help reunite an item with its rightful owner.</p>
</div>
</a>
</section>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
<!-- Recent Activity Feed -->
<section class="lg:col-span-2" id="claims-section">
<h3 class="text-lg font-bold text-[#0D1B2A] mb-8">Pending Claim Requests</h3>

<?php if (empty($pending_requests)): ?>
    <div class="bg-surface-container-lowest p-8 rounded-xl text-center text-on-surface-variant shadow-sm">
        <span class="material-symbols-outlined text-4xl opacity-30 mb-2">notifications_off</span>
        <p>No pending requests at the moment.</p>
    </div>
<?php else: ?>
    <div class="space-y-4">
    <?php foreach ($pending_requests as $req): ?>
        <div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.04)] border-l-4 border-primary flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h4 class="font-bold text-[#0D1B2A]"><?= htmlspecialchars($req['claimant_name']) ?> <span class="font-normal text-on-surface-variant">is claiming</span> <?= htmlspecialchars($req['item_title']) ?></h4>
                <p class="text-sm text-on-surface-variant mt-1 italic">"<?= htmlspecialchars($req['proof'] ?? $req['answer_1'] ?? 'No details provided.') ?>"</p>
                <p class="text-[10px] text-on-surface-variant mt-2 uppercase tracking-widest"><?= date('M j, Y h:i A', strtotime($req['submitted_at'])) ?></p>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button onclick="handleClaim(<?= $req['claim_id'] ?>, 'reject')" class="flex-1 md:flex-none px-4 py-2 text-xs font-bold text-error bg-error/10 rounded hover:bg-error/20 transition-colors">Reject</button>
                <button onclick="handleClaim(<?= $req['claim_id'] ?>, 'approve')" class="flex-1 md:flex-none px-4 py-2 text-xs font-bold text-white bg-secondary rounded hover:opacity-90 transition-all shadow-sm">Accept</button>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
async function handleClaim(claimId, action) {
    if(!confirm(`Are you sure you want to ${action} this claim?`)) return;
    
    const formData = new FormData();
    formData.append('claim_id', claimId);
    formData.append('action', action);
    
    try {
        const response = await fetch('api/handle_claim.php', {
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
        alert("Error processing request.");
    }
}

async function deleteItem(itemId) {
    if(!confirm("Are you sure you want to delete this report? This action cannot be undone.")) return;
    
    try {
        const formData = new FormData();
        formData.append('item_id', itemId);
        
        const response = await fetch('api/delete_item.php', {
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
        alert("Error deleting item.");
    }
}
</script>

<h3 class="text-lg font-bold text-[#0D1B2A] mt-16 mb-8">Recent Activity</h3>
<div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-outline-variant/30 before:to-transparent">
<!-- Timeline Item 1 -->
<div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
<div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-surface bg-[#0F7173] text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
<span class="material-symbols-outlined text-sm" data-icon="check">check</span>
</div>
<div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-surface-container-lowest p-6 rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.04)] border-l-4 border-[#0F7173]">
<div class="flex justify-between items-start mb-2">
<span class="text-xs font-semibold text-[#0F7173] uppercase tracking-wider">Item Recovered</span>
<span class="text-xs text-on-surface-variant">2 hours ago</span>
</div>
<h4 class="text-base font-bold text-[#0D1B2A] mb-1">Vintage Leather Satchel</h4>
<p class="text-sm text-on-surface-variant">Owner confirmed receipt. Report closed successfully.</p>
</div>
</div>
</div>
</section>
<!-- Horizontal Scroll 'My Posts' Strip (Modified to Vertical for Sidebar layout harmony, as a side column widget) -->
<section class="lg:col-span-1">
<div class="flex justify-between items-center mb-6">
<h3 class="text-lg font-bold text-[#0D1B2A]">Active Reports</h3>
<a class="text-sm text-[#0F7173] font-medium hover:underline" href="browse.php">View All</a>
</div>
<div class="flex flex-col gap-4">
<?php if (empty($my_items)): ?>
    <div class="p-6 text-center text-on-surface-variant bg-surface-container-lowest rounded-xl">
        <span class="material-symbols-outlined text-4xl opacity-50 mb-2">inbox</span>
        <p>No active reports found.</p>
    </div>
<?php else: ?>
    <?php foreach ($my_items as $item): ?>
    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_8px_32px_rgba(13,27,42,0.04)] border-l-4 <?= $item['type'] === 'lost' ? 'border-[#F4A261]' : 'border-[#0F7173]' ?>">
    <div class="flex h-24">
    <?php if (!empty($item['primary_image'])): ?>
        <img alt="Item Image" class="w-24 h-full object-cover" src="<?= htmlspecialchars(preg_replace('/^\.\.\//', '', $item['primary_image'])) ?>"/>
    <?php else: ?>
        <div class="w-24 h-full bg-surface-container flex items-center justify-center">
            <span class="material-symbols-outlined text-outline">image</span>
        </div>
    <?php endif; ?>
    <div class="p-4 flex flex-col justify-center flex-1">
        <div class="flex justify-between items-start">
            <span class="text-[10px] font-bold uppercase <?= $item['type'] === 'lost' ? 'text-[#F4A261]' : 'text-[#0F7173]' ?> tracking-wider mb-1"><?= htmlspecialchars($item['type']) ?></span>
            <button onclick="deleteItem(<?= $item['item_id'] ?>)" class="text-error hover:bg-error/10 p-1 rounded-full transition-colors" title="Delete Report">
                <span class="material-symbols-outlined text-[16px]">delete</span>
            </button>
        </div>
        <h4 class="text-sm font-bold text-[#0D1B2A] leading-tight line-clamp-1"><a href="item-detail.php?id=<?= $item['item_id'] ?>" class="hover:underline"><?= htmlspecialchars($item['title']) ?></a></h4>
        <p class="text-xs text-on-surface-variant mt-1 line-clamp-1"><?= htmlspecialchars($item['location_text']) ?></p>
    </div>
    </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
</section>
</div>
</main>
</body></html>

