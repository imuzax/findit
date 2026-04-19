<?php
session_start();
require_once 'includes/config.php';

$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$item_id) {
    header("Location: index.php");
    exit;
}

// Fetch item details along with owner contact info from users table as fallback
$stmt = $pdo->prepare("
    SELECT i.*, u.phone as owner_backup_phone, u.full_name as owner_backup_name 
    FROM items i 
    JOIN users u ON i.user_id = u.user_id 
    WHERE i.item_id = ?
");
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT image_path FROM item_images WHERE item_id = ? ORDER BY is_primary DESC");
$stmt->execute([$item_id]);
$images = $stmt->fetchAll(PDO::FETCH_COLUMN);

if (empty($images)) {
    $images[] = '/assets/img/placeholder.jpg';
} else {
    foreach ($images as &$path) {
        $path = preg_replace('/^\.\.\//', '', $path);
    }
}

$isOwner = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $item['user_id'];
$isLoggedIn = isset($_SESSION['user_id']);
$isResolved = in_array($item['status'], ['returned', 'recovered']);
$isLost = $item['type'] === 'lost';

$themeColorClass = $isLost ? 'text-[#F4A261]' : 'text-secondary';
$themeBgClass = $isLost ? 'bg-[#F4A261]/10' : 'bg-secondary/10';
$themeLineClass = $isLost ? 'border-[#F4A261]' : 'border-secondary';

// Use specific contact info if provided in the post, else use user profile info
$displayPhone = !empty($item['contact_phone']) ? $item['contact_phone'] : $item['owner_backup_phone'];
$displayName = !empty($item['contact_name']) ? $item['contact_name'] : $item['owner_backup_name'];
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Item Detail</title>
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
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
        .modal-overlay { background: rgba(13, 27, 42, 0.4); backdrop-filter: blur(4px); }
    </style>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background antialiased">
<?php include 'includes/navbar.php'; ?>
<!-- Main Content -->
<main class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 lg:grid-cols-12 gap-16">
<!-- Left: Image Gallery -->
<div class="lg:col-span-7 flex flex-col gap-6">
<div class="w-full aspect-[4/3] rounded-xl overflow-hidden bg-surface-container-low shadow-[0_8px_32px_rgba(13,27,42,0.06)]">
<img id="main-image" alt="Main item image" class="w-full h-full object-cover" src="<?= htmlspecialchars($images[0]) ?>"/>
</div>
<!-- Thumbnails -->
<?php if (count($images) > 1): ?>
<div class="grid grid-cols-4 gap-4">
    <?php foreach ($images as $index => $img): ?>
        <div onclick="document.getElementById('main-image').src='<?= htmlspecialchars($img) ?>'" class="aspect-square rounded-lg overflow-hidden bg-surface-container-low <?= $index === 0 ? 'ring-2 ring-primary' : 'hover:opacity-80' ?> cursor-pointer transition-opacity">
            <img alt="Thumbnail" class="w-full h-full object-cover" src="<?= htmlspecialchars($img) ?>"/>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
</div>
<!-- Right: Sticky Panel -->
<div class="lg:col-span-5 relative">
<div class="sticky top-28 flex flex-col gap-8 bg-surface-container-lowest p-8 rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] border-l-4 <?= $themeLineClass ?>">
<!-- Status Badge & Meta -->
<div class="flex items-center justify-between">
<span class="<?= $themeBgClass ?> <?= $themeColorClass ?> px-4 py-1.5 rounded-full text-[0.75rem] font-bold uppercase tracking-wider font-['Inter']">
                        <?= strtoupper(htmlspecialchars($item['type'])) ?> ITEM
                    </span>
<span class="text-on-surface-variant text-[0.875rem] font-['Inter']">Reported <?= date('M j, Y', strtotime($item['created_at'])) ?></span>
</div>
<!-- Title & Description -->
<div>
<h1 class="text-[2rem] font-bold font-['Inter'] text-primary tracking-tight leading-tight mb-4"><?= htmlspecialchars($item['title']) ?></h1>
<p class="text-[0.875rem] text-on-surface-variant font-['Inter'] leading-relaxed">
                        <?= nl2br(htmlspecialchars($item['description'])) ?>
                    </p>
<div class="mt-4 flex flex-col gap-2">
    <?php if(!empty($item['category'])): ?>
    <div class="text-sm"><span class="font-bold">Category:</span> <?= htmlspecialchars($item['category']) ?></div>
    <?php endif; ?>
    <?php if(!empty($item['color'])): ?>
    <div class="text-sm"><span class="font-bold">Color:</span> <?= htmlspecialchars($item['color']) ?></div>
    <?php endif; ?>
    <?php if(!empty($item['brand'])): ?>
    <div class="text-sm"><span class="font-bold">Brand:</span> <?= htmlspecialchars($item['brand']) ?></div>
    <?php endif; ?>
    <?php if(!empty($item['date_occurred'])): ?>
    <div class="text-sm"><span class="font-bold">Date <?= $isLost ? 'Lost' : 'Found' ?>:</span> <?= date('M j, Y', strtotime($item['date_occurred'])) ?></div>
    <?php endif; ?>
</div>
</div>
<!-- Lifecycle -->
<?php if ($isResolved): ?>
<div class="bg-[#c6f6d5] p-6 rounded-lg text-center">
    <span class="material-symbols-outlined text-4xl text-[#22543d] mb-2">task_alt</span>
    <h3 class="text-lg font-bold text-[#22543d] uppercase tracking-wider mb-1">Successfully <?= $isLost ? 'Recovered' : 'Returned' ?></h3>
    <p class="text-sm text-[#276749]">This item has been successfully resolved.</p>
</div>
<?php else: ?>
<!-- Location Map Snippet -->
<div class="rounded-lg overflow-hidden h-32 relative bg-surface-container-low shadow-sm">
<div class="w-full h-full bg-surface-container-high flex flex-col items-center justify-center opacity-60">
    <span class="material-symbols-outlined text-4xl text-outline mb-1">map</span>
</div>
<div class="absolute inset-0 flex items-center justify-center">
<div class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-full shadow-sm flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-sm">location_on</span>
<span class="text-[0.875rem] font-semibold font-['Inter'] text-primary"><?= htmlspecialchars($item['location_text']) ?></span>
</div>
</div>
</div>
<?php endif; ?>

<!-- Primary CTA -->
<div id="action-area">
    <?php if ($isResolved): ?>
        <button disabled class="w-full bg-surface-variant text-on-surface-variant font-bold py-4 px-6 rounded-DEFAULT shadow-none flex justify-center items-center gap-2 cursor-not-allowed">
            <span class="material-symbols-outlined">check_circle</span>
            Already Resolved
        </button>
    <?php elseif ($isOwner): ?>
        <button onclick="resolveItem(<?= $item_id ?>)" id="resolveBtn" class="w-full bg-secondary hover:bg-[#005a5c] text-on-secondary font-bold py-4 px-6 rounded-DEFAULT shadow-md flex justify-center items-center gap-2 transition-colors">
            <span class="material-symbols-outlined">verified</span>
            Mark as Resolved
        </button>
    <?php elseif (!$isLoggedIn): ?>
        <a href="auth.php?redirect=item-detail.php?id=<?= $item_id ?>" class="w-full bg-surface-container-high hover:bg-surface-dim text-on-surface font-bold py-4 px-6 rounded-DEFAULT shadow-md flex justify-center items-center gap-2 text-center transition-colors">
            <span class="material-symbols-outlined">login</span>
            Login to Claim & Contact
        </a>
    <?php else: ?>
        <button onclick="openClaimModal()" id="claimBtn" class="w-full <?= $isLost ? 'bg-secondary' : 'bg-[#F4A261]' ?> text-white font-bold py-4 px-6 rounded-DEFAULT shadow-md flex justify-center items-center gap-2 transition-transform hover:scale-[1.02]">
            <span class="material-symbols-outlined"><?= $isLost ? 'contact_phone' : 'front_hand' ?></span>
            <?= $isLost ? 'I Found This Item' : 'This Is Mine — Claim Item' ?>
        </button>
    <?php endif; ?>
</div>

<div id="statusMessage" class="hidden mt-4 p-4 rounded-lg font-medium text-center"></div>

</div>
</div>
</main>

<!-- Claim Modal -->
<div id="claimModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-6">
    <div class="absolute inset-0 modal-overlay" onclick="closeClaimModal()"></div>
    <div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl shadow-2xl relative z-10 overflow-hidden transform transition-all scale-95 opacity-0 duration-300" id="modalContent">
        <!-- Modal Header -->
        <div class="bg-primary text-white p-6 flex justify-between items-center">
            <h3 class="text-xl font-bold font-headline">Contact & Claim Request</h3>
            <button onclick="closeClaimModal()" class="material-symbols-outlined hover:rotate-90 transition-transform">close</button>
        </div>
        <!-- Modal Body -->
        <div class="p-8 space-y-6">
            <div class="bg-secondary/5 p-4 rounded-lg flex items-center gap-4 border border-secondary/10">
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined">call</span>
                </div>
                <div>
                    <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Poster's Contact Number</p>
                    <p class="text-xl font-bold text-primary"><?= htmlspecialchars($displayPhone) ?></p>
                </div>
            </div>

            <form id="claimForm" class="space-y-4">
                <input type="hidden" name="item_id" value="<?= $item_id ?>">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-primary">Provide Verification Details</label>
                    <p class="text-xs text-on-surface-variant mb-2">
                        <?= !empty($item['owner_question']) ? "<strong>Question:</strong> " . htmlspecialchars($item['owner_question']) : "Describe unique identifying marks or proof that this item belongs to you." ?>
                    </p>
                    <textarea name="proof" class="w-full p-4 rounded-lg bg-surface border-none focus:ring-2 focus:ring-secondary text-sm resize-none" rows="4" placeholder="Your answer or proof here..." required></textarea>
                </div>
                <button type="submit" id="submitClaimBtn" class="w-full bg-primary text-white font-bold py-4 rounded-lg hover:bg-primary/90 transition-colors flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined text-sm">send</span>
                    Send Claim Request
                </button>
            </form>
            <div id="modalStatus" class="hidden p-3 rounded-md text-sm text-center"></div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    function openClaimModal() {
        const modal = document.getElementById('claimModal');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeClaimModal() {
        const modal = document.getElementById('claimModal');
        const content = document.getElementById('modalContent');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.getElementById('claimForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitClaimBtn');
        const status = document.getElementById('modalStatus');
        const formData = new FormData(this);

        btn.disabled = true;
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Sending...`;

        try {
            const response = await fetch('api/claim_item.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            status.classList.remove('hidden', 'bg-red-100', 'text-red-700', 'bg-green-100', 'text-green-700');
            if(data.success) {
                status.classList.add('bg-green-100', 'text-green-700');
                status.innerText = "Claim request sent successfully! The owner will review it.";
                setTimeout(() => {
                    closeClaimModal();
                    window.location.reload();
                }, 2000);
            } else {
                status.classList.add('bg-red-100', 'text-red-700');
                status.innerText = data.message;
                btn.disabled = false;
                btn.innerText = "Try Again";
            }
        } catch (err) {
            status.classList.remove('hidden');
            status.classList.add('bg-red-100', 'text-red-700');
            status.innerText = "Error sending request.";
            btn.disabled = false;
        }
    });

    async function resolveItem(itemId) {
        if(!confirm("Are you sure? This will close the report.")) return;
        const btn = document.getElementById('resolveBtn');
        btn.disabled = true;
        try {
            const formData = new FormData();
            formData.append('item_id', itemId);
            const response = await fetch('api/resolve_item.php', { method: 'POST', body: formData });
            const data = await response.json();
            if(data.success) window.location.reload();
            else alert(data.message);
        } catch (error) { alert("Error."); btn.disabled = false; }
    }
</script>
</body></html>
// Project finalized and optimized by Armancle
