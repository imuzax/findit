<?php
session_start();
require_once 'includes/config.php';

// Build basic query to fetch all active items
$query = "
    SELECT i.*, 
           (SELECT image_path FROM item_images WHERE item_id = i.item_id ORDER BY is_primary DESC LIMIT 1) as primary_image
    FROM items i
    WHERE i.status IN ('active', 'matched', 'verified')
    ORDER BY i.created_at DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total_count = count($items);
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Browse Listings</title>
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
                    "fontFamily": {
                        "headline": ["Inter"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    }
                }
            }
        }
    </script>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background font-body min-h-screen flex flex-col">
<?php include 'includes/navbar.php'; ?>
<!-- Main Content -->
<main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-8 py-12 flex flex-col md:flex-row gap-12">
<!-- Left Filter Sidebar -->
<aside class="w-full md:w-64 flex-shrink-0 space-y-12">
<!-- Type Toggle -->
<div>
<h3 class="font-headline font-semibold text-lg mb-4">Item Type</h3>
<div class="flex bg-surface-container-high rounded-lg p-1">
<button class="flex-1 py-2 px-4 rounded-md text-sm font-semibold bg-white shadow-sm text-primary">All</button>
<button class="flex-1 py-2 px-4 rounded-md text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors">Lost</button>
<button class="flex-1 py-2 px-4 rounded-md text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors">Found</button>
</div>
</div>
<!-- Category Filters -->
<div>
<h3 class="font-headline font-semibold text-lg mb-4">Categories</h3>
<div class="space-y-3">
<label class="flex items-center gap-3 cursor-pointer group">
<input checked="" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="checkbox"/>
<span class="text-sm text-on-surface group-hover:text-primary transition-colors">Electronics (24)</span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="checkbox"/>
<span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Keys (18)</span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="checkbox"/>
<span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Wallets &amp; Bags (31)</span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="checkbox"/>
<span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Books & Docs (7)</span>
</label>
<label class="flex items-center gap-3 cursor-pointer group">
<input class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="checkbox"/>
<span class="text-sm text-on-surface-variant group-hover:text-primary transition-colors">Other (12)</span>
</label>
</div>
</div>
<!-- Date Range -->
<div>
<h3 class="font-headline font-semibold text-lg mb-4">Date Added</h3>
<div class="space-y-4">
<div>
<label class="block text-xs font-semibold text-on-surface-variant mb-1 uppercase tracking-wider">From</label>
<input class="w-full rounded-DEFAULT border-none bg-surface-container-low text-sm px-4 py-2 focus:ring-2 focus:ring-secondary/50" type="date"/>
</div>
<div>
<label class="block text-xs font-semibold text-on-surface-variant mb-1 uppercase tracking-wider">To</label>
<input class="w-full rounded-DEFAULT border-none bg-surface-container-low text-sm px-4 py-2 focus:ring-2 focus:ring-secondary/50" type="date"/>
</div>
</div>
</div>
<!-- Location -->
<div>
<h3 class="font-headline font-semibold text-lg mb-4">Location</h3>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant" style="font-size: 20px;">location_on</span>
<input class="w-full pl-10 pr-4 py-2 rounded-DEFAULT border-none bg-surface-container-low text-sm focus:ring-2 focus:ring-secondary/50" placeholder="e.g., Abeda Inamdar College..." type="text"/>
</div>
</div>
<button class="w-full py-3 bg-surface-container-low text-primary font-semibold rounded-DEFAULT hover:bg-surface-container transition-colors text-sm">Reset Filters</button>
</aside>
<!-- Main Results Area -->
<section class="flex-grow flex flex-col min-w-0">
<!-- Search & Header -->
<div class="mb-8 space-y-6">
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full pl-12 pr-4 py-4 rounded-xl border-none bg-surface-container-lowest shadow-[0_8px_32px_rgba(13,27,42,0.06)] text-lg placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary/50 transition-shadow" placeholder="Search for 'ID Card', 'Calculator' or 'Lab Manual'..." type="text"/>
</div>
<div class="flex justify-between items-center">
<h1 class="text-2xl font-bold text-primary">Browse Listings <span class="text-on-surface-variant text-lg font-normal ml-2"><?= $total_count ?> results</span></h1>
<div class="flex items-center gap-2">
<span class="text-sm font-semibold text-on-surface-variant">Sort by:</span>
<select class="bg-transparent border-none text-sm font-semibold text-primary focus:ring-0 cursor-pointer pr-8 py-1">
<option>Newest First</option>
<option>Oldest First</option>
<option>Closest to me</option>
</select>
</div>
</div>
</div>
<!-- Item Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<?php foreach ($items as $item): ?>
    <?php 
        $isLost = $item['type'] === 'lost';
        $themeColor = $isLost ? '#F4A261' : '#0F7173';
        $imagePath = !empty($item['primary_image']) ? ltrim($item['primary_image'], '/') : '/assets/img/placeholder.jpg';
    ?>
    <article onclick="window.location.href='item-detail.php?id=<?= $item['item_id'] ?>'" class="bg-surface-container-lowest rounded-xl shadow-[0_4px_24px_rgba(13,27,42,0.04)] overflow-hidden border-l-4 border-l-[<?= $themeColor ?>] flex flex-col hover:-translate-y-1 transition-transform duration-300 relative group cursor-pointer">
        <div class="h-48 w-full bg-surface-container-low relative overflow-hidden flex items-center justify-center">
            <?php if (!empty($item['primary_image'])): ?>
                <img alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?= htmlspecialchars($imagePath) ?>"/>
            <?php else: ?>
                <span class="material-symbols-outlined text-[48px] text-outline-variant opacity-50">
                    <?= $isLost ? 'help_center' : 'visibility' ?>
                </span>
            <?php endif; ?>
            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[<?= $themeColor ?>] shadow-sm uppercase tracking-wider"><?= htmlspecialchars($item['type']) ?></div>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <h2 class="text-lg font-semibold text-primary mb-2 line-clamp-1"><?= htmlspecialchars($item['title']) ?></h2>
            <div class="flex items-center gap-2 text-on-surface-variant text-sm mb-4">
                <span class="material-symbols-outlined" style="font-size: 16px;">location_on</span>
                <span class="truncate"><?= htmlspecialchars($item['location_text']) ?></span>
            </div>
            <p class="text-sm text-on-surface-variant mb-6 line-clamp-2 leading-relaxed"><?= htmlspecialchars($item['description']) ?></p>
            <div class="mt-auto pt-4 flex items-center justify-between">
                <span class="text-xs font-semibold text-on-surface-variant"><?= date('M j, Y', strtotime($item['created_at'])) ?></span>
                <a href="item-detail.php?id=<?= $item['item_id'] ?>" class="text-sm font-semibold text-[<?= $themeColor ?>] hover:underline underline-offset-4" style="display:inline-block;text-align:center;">View Details</a>
            </div>
        </div>
    </article>
<?php endforeach; ?>
</div>
<!-- Pagination -->
<div class="mt-16 flex items-center justify-center gap-2">
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors" disabled="">
<span class="material-symbols-outlined" style="font-size: 20px;">chevron_left</span>
</button>
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center bg-primary text-white font-semibold text-sm shadow-sm">1</button>
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors font-semibold text-sm">2</button>
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors font-semibold text-sm">3</button>
<span class="text-on-surface-variant px-2">...</span>
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors font-semibold text-sm">8</button>
<button class="w-10 h-10 rounded-DEFAULT flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined" style="font-size: 20px;">chevron_right</span>
</button>
</div>
</section>
</main>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</body></html>