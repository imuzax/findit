<?php 
require_once 'includes/auth_check.php'; 
$pageTitle = 'Report a Found Item';
$pageSubtitle = 'Help reunite an item with its rightful owner. Please be descriptive but don\'t give away all details.';
$themeColor = 'text-[#0F7173]';
$borderColor = 'border-[#0F7173]';
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Report Found Item (Azam Campus)</title>
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
                    "surface-container-low": "#f1f4f6",
                    "secondary-container": "#9cedef",
                    "inverse-surface": "#2d3133",
                    "surface-container-lowest": "#ffffff",
                    "surface-bright": "#f7fafc",
                    "surface-variant": "#e0e3e5",
                    "surface-container": "#ebeef0",
                    "primary": "#000000",
                    "secondary": "#0F7173",
                    "on-surface": "#181c1e",
                    "on-secondary": "#ffffff",
                    "outline-variant": "#c4c6cc",
                    "on-background": "#181c1e",
                    "on-surface-variant": "#44474c",
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
                    "body": ["Inter"]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
    </style>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background antialiased min-h-screen flex flex-col">
<?php include 'includes/navbar.php'; ?>
<main class="flex-grow max-w-4xl mx-auto w-full px-6 py-12 md:py-20 flex flex-col gap-12">
<div class="text-center space-y-4">
<h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-secondary leading-tight"><?= $pageTitle ?></h1>
<p class="text-lg text-on-surface-variant max-w-2xl mx-auto"><?= $pageSubtitle ?></p>
<div id="statusMessage" class="hidden max-w-2xl mx-auto p-4 rounded-lg font-medium"></div>
</div>

<form id="reportForm" class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] p-8 md:p-12 space-y-10 border-l-4 <?= $borderColor ?>">
<input type="hidden" name="type" value="found" />
<div class="space-y-6">
<h2 class="text-2xl font-bold text-primary">Item Details</h2>
<div class="space-y-2">
<label class="block text-sm font-semibold text-primary" for="item-name">What did you find? <span class="text-error">*</span></label>
<input name="title" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary placeholder:text-on-primary-container transition-all" id="item-name" placeholder="e.g., Red Water Bottle, Calculator, Keys" required="" type="text"/>
</div>
<div class="space-y-3">
<label class="block text-sm font-semibold text-primary">Category</label>
<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
    <label class="cursor-pointer"><input class="peer sr-only" name="category" type="radio" value="Electronics" required/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Electronics</div></label>
    <label class="cursor-pointer"><input checked="" class="peer sr-only" name="category" type="radio" value="Wallets & IDs"/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Wallets & IDs</div></label>
    <label class="cursor-pointer"><input class="peer sr-only" name="category" type="radio" value="Keys"/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Keys</div></label>
    <label class="cursor-pointer"><input class="peer sr-only" name="category" type="radio" value="Bags"/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Bags</div></label>
    <label class="cursor-pointer"><input class="peer sr-only" name="category" type="radio" value="Books & Documents"/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Books & Docs</div></label>
    <label class="cursor-pointer"><input class="peer sr-only" name="category" type="radio" value="Other"/><div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-secondary peer-checked:text-white">Other</div></label>
</div>
</div>

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Where & When?</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="space-y-2 md:col-span-2">
        <label class="block text-sm font-semibold text-primary" for="location">Found At (Location) <span class="text-error">*</span></label>
        <input name="location_text" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="location" placeholder="e.g., Near Canteen Area, Ground floor hallway" required="" type="text"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="date">Date Found <span class="text-error">*</span></label>
        <input name="date_occurred" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="date" required type="date" value="<?= date('Y-m-d') ?>"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="currently_at">Where is the item now?</label>
        <input name="item_currently_at" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="currently_at" placeholder="e.g., Security Cabin, My Department (BCA)" type="text"/>
    </div>
</div>
</div>

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Verification Details</h2>
<p class="text-sm text-on-surface-variant">Help the owner verify it's theirs without giving away everything.</p>
<div class="space-y-4">
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="owner_question">Question for the Owner</label>
        <textarea name="owner_question" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary resize-none" id="owner_question" placeholder="e.g., What color is the keychain? / What name is written on page 5?" rows="2"></textarea>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="item-description">General Description</label>
        <textarea name="description" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary resize-none" id="item-description" placeholder="Describe the item generally (e.g., Blue bag with some books inside)..." rows="3" required></textarea>
    </div>
</div>
</div>

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Your Contact Info</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="contact_name">Display Name</label>
        <input name="contact_name" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="contact_name" required type="text" value="<?= htmlspecialchars($_SESSION['full_name'] ?? '') ?>"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="contact_phone">Phone Number</label>
        <input name="contact_phone" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="contact_phone" required type="text" value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>"/>
    </div>
</div>
</div>

<div class="flex justify-end pt-8 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<button id="submitBtn" class="bg-secondary text-white font-bold tracking-tight px-8 py-4 rounded-DEFAULT shadow-lg hover:opacity-90 transition-all flex items-center gap-2" type="submit">
    Post Found Item
    <span class="material-symbols-outlined text-sm">send</span>
</button>
</div>
</form>
</main>
<?php include 'includes/footer.php'; ?>

<script>
    document.getElementById('reportForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitBtn');
        const statusBox = document.getElementById('statusMessage');
        const formData = new FormData(e.target);

        btn.disabled = true;
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Posting...`;
        
        try {
            const response = await fetch('api/post_item.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            statusBox.classList.remove('hidden', 'bg-red-100', 'text-red-700', 'bg-green-100', 'text-green-700');
            
            if(data.success) {
                statusBox.classList.add('bg-green-100', 'text-green-700');
                statusBox.innerText = data.message + " Redirecting...";
                setTimeout(() => window.location.href = `item-detail.php?id=${data.data.item_id}`, 1500);
            } else {
                statusBox.classList.add('bg-red-100', 'text-red-700');
                statusBox.innerText = data.message;
                btn.disabled = false;
                btn.innerHTML = `Post Found Item <span class="material-symbols-outlined text-sm">send</span>`;
            }
        } catch (error) {
            statusBox.classList.remove('hidden');
            statusBox.classList.add('bg-red-100', 'text-red-700');
            statusBox.innerText = "Error. Please try again.";
            btn.disabled = false;
        }
    });
</script>
</body></html>
