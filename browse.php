<?php
session_start();
require_once 'includes/config.php';

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';

$queryParams = [];
$sql = "SELECT i.*, 
            (SELECT image_path FROM item_images WHERE item_id = i.item_id ORDER BY is_primary DESC LIMIT 1) as primary_image
        FROM items i WHERE i.status IN ('active', 'matched', 'verified', 'returned') ";

if ($type === 'lost' || $type === 'found') {
    $sql .= " AND i.type = ?";
    $queryParams[] = $type;
}

if (!empty($category)) {
    $sql .= " AND i.category = ?";
    $queryParams[] = $category;
}

if (!empty($location)) {
    $sql .= " AND i.location_text LIKE ?";
    $queryParams[] = "%$location%";
}

if (!empty($search)) {
    $sql .= " AND (i.title LIKE ? OR i.description LIKE ? OR i.location_text LIKE ?)";
    $queryParams[] = "%$search%";
    $queryParams[] = "%$search%";
    $queryParams[] = "%$search%";
}

$sql .= " ORDER BY i.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($queryParams);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch categories for sidebar counts
$catCounts = [];
$stmtCat = $pdo->query("SELECT category, COUNT(*) as cnt FROM items WHERE status IN ('active', 'matched', 'verified') GROUP BY category");
while($row = $stmtCat->fetch()) {
    $catCounts[$row['category']] = $row['cnt'];
}
?>
<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Browse Listings</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
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
    <aside class="w-full md:w-64 flex-shrink-0 space-y-8">
        <form action="browse.php" method="GET" id="filterForm">
            <!-- Hidden query to preserve search text -->
            <input type="hidden" name="q" value="<?= htmlspecialchars($search) ?>" />
            
            <!-- Type Toggle -->
            <div class="mb-8">
                <h3 class="font-headline font-semibold text-lg mb-4">Item Type</h3>
                <div class="flex bg-surface-container-high rounded-lg p-1">
                    <label class="flex-1 text-center">
                        <input type="radio" name="type" value="" class="hidden peer" onchange="document.getElementById('filterForm').submit();" <?= $type === '' ? 'checked' : '' ?>>
                        <div class="py-2 px-4 rounded-md text-sm font-semibold transition-colors cursor-pointer peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-primary text-on-surface-variant">All</div>
                    </label>
                    <label class="flex-1 text-center">
                        <input type="radio" name="type" value="lost" class="hidden peer" onchange="document.getElementById('filterForm').submit();" <?= $type === 'lost' ? 'checked' : '' ?>>
                        <div class="py-2 px-4 rounded-md text-sm font-semibold transition-colors cursor-pointer peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-primary text-on-surface-variant">Lost</div>
                    </label>
                    <label class="flex-1 text-center">
                        <input type="radio" name="type" value="found" class="hidden peer" onchange="document.getElementById('filterForm').submit();" <?= $type === 'found' ? 'checked' : '' ?>>
                        <div class="py-2 px-4 rounded-md text-sm font-semibold transition-colors cursor-pointer peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-primary text-on-surface-variant">Found</div>
                    </label>
                </div>
            </div>
            
            <!-- Category Filters -->
            <div class="mb-8">
                <h3 class="font-headline font-semibold text-lg mb-4">Categories</h3>
                <div class="space-y-3">
                    <?php 
                    $categories = [
                        'Electronics', 'Wallets & IDs', 'Keys', 'Bags', 'Clothing', 'Jewelry', 'Pets', 'Other'
                    ];
                    foreach ($categories as $cat) {
                        $count = isset($catCounts[$cat]) ? $catCounts[$cat] : 0;
                        $isChecked = $category === $cat;
                    ?>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input name="category" value="<?= htmlspecialchars($cat) ?>" class="w-5 h-5 rounded border-outline-variant text-secondary focus:ring-secondary/50 bg-surface-container-lowest" type="radio" onchange="document.getElementById('filterForm').submit();" <?= $isChecked ? 'checked' : '' ?> <?= $count == 0 && !$isChecked ? 'disabled' : '' ?>/>
                        <span class="text-sm <?= $isChecked ? 'text-primary font-semibold' : 'text-on-surface-variant' ?> group-hover:text-primary transition-colors <?= $count == 0 && !$isChecked ? 'opacity-50' : '' ?>"><?= htmlspecialchars($cat) ?> (<?= $count ?>)</span>
                    </label>
                    <?php } ?>
                </div>
            </div>
            
            <a href="browse.php" class="block w-full text-center py-3 bg-surface-container-low text-primary font-semibold rounded-DEFAULT hover:bg-surface-container transition-colors text-sm">Reset Filters</a>
        </form>
    </aside>
    
    <!-- Main Results Area -->
    <section class="flex-grow flex flex-col min-w-0">
        <!-- Search & Header -->
        <div class="mb-8 space-y-6">
            <form action="browse.php" method="GET" class="relative">
                <!-- Preserve existing filters -->
                <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>" />
                <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>" />
                
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input name="q" value="<?= htmlspecialchars($search) ?>" class="w-full pl-12 pr-4 py-4 rounded-xl border-none bg-surface-container-lowest shadow-[0_8px_32px_rgba(13,27,42,0.06)] text-lg placeholder:text-on-surface-variant/50 focus:ring-2 focus:ring-secondary/50 transition-shadow" placeholder="Search for 'MacBook Pro' or 'Golden Retriever'..." type="text"/>
            </form>
            
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-primary">Browse Listings <span class="text-on-surface-variant text-lg font-normal ml-2"><?= count($items) ?> results</span></h1>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-semibold text-on-surface-variant">Sort by:</span>
                    <select class="bg-transparent border-none text-sm font-semibold text-primary focus:ring-0 cursor-pointer pr-8 py-1">
                        <option>Newest First</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Item Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (empty($items)): ?>
            <div class="col-span-full text-center py-16 text-on-surface-variant bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/10">
                <span class="material-symbols-outlined text-4xl opacity-50 mb-4 block">search_off</span>
                <p>No items found matching your criteria.</p>
                <a href="browse.php" class="text-secondary font-semibold hover:underline mt-2 inline-block">Clear Filters</a>
            </div>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
            <?php 
                $isLost = $item['type'] === 'lost';
                $themeColorClass = $isLost ? 'text-[#F4A261]' : 'text-secondary';
                $themeLineClass = $isLost ? 'border-l-[#F4A261]' : 'border-l-[#0F7173]';
                
                $imagePath = !empty($item['primary_image']) ? preg_replace('/^\.\.\//', '', $item['primary_image']) : '';
            ?>
            <article class="bg-surface-container-lowest rounded-xl shadow-[0_4px_24px_rgba(13,27,42,0.04)] overflow-hidden border-l-4 <?= $themeLineClass ?> flex flex-col hover:-translate-y-1 transition-transform duration-300 relative group cursor-pointer" onclick="window.location.href='item-detail.php?id=<?= $item['item_id'] ?>'">
                <div class="h-48 w-full bg-surface-container-low relative overflow-hidden flex items-center justify-center">
                    <?php if (!empty($imagePath)): ?>
                        <img alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?= htmlspecialchars($imagePath) ?>"/>
                    <?php else: ?>
                        <span class="material-symbols-outlined text-[48px] text-outline opacity-50">image</span>
                    <?php endif; ?>
                    <div class="absolute top-4 left-4 flex gap-2">
                        <div class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold <?= $themeColorClass ?> shadow-sm uppercase tracking-wider"><?= htmlspecialchars($item['type']) ?></div>
                        <?php if($item['status'] === 'returned'): ?>
                            <div class="bg-green-500 text-white px-3 py-1 rounded-full text-[10px] font-bold shadow-sm uppercase tracking-wider flex items-center gap-1">
                                <span class="material-symbols-outlined text-[12px]">task_alt</span> Resolved
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h2 class="text-lg font-semibold text-primary mb-2 line-clamp-1" title="<?= htmlspecialchars($item['title']) ?>"><?= htmlspecialchars($item['title']) ?></h2>
                    <div class="flex items-center gap-2 text-on-surface-variant text-sm mb-4">
                        <span class="material-symbols-outlined" style="font-size: 16px;">location_on</span>
                        <span class="truncate"><?= htmlspecialchars($item['location_text']) ?></span>
                    </div>
                    <p class="text-sm text-on-surface-variant mb-6 line-clamp-2 leading-relaxed"><?= htmlspecialchars($item['description']) ?></p>
                    <div class="mt-auto pt-4 flex items-center justify-between border-t border-surface-container">
                        <span class="text-xs font-semibold text-on-surface-variant"><?= date('M j, Y', strtotime($item['created_at'])) ?></span>
                        <a href="item-detail.php?id=<?= $item['item_id'] ?>" class="text-sm font-semibold <?= $themeColorClass ?> hover:underline underline-offset-4 pointer-events-none" style="display:inline-block;text-align:center;">View Details</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </section>
</main>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</body></html>

