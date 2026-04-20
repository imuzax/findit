<?php 
require_once 'includes/auth_check.php'; 
$pageTitle = 'Report a Lost Item';
$pageSubtitle = 'Provide details about the item you lost. The more descriptive you are, the higher the chances of a successful return.';
$themeColor = 'text-[#F4A261]';
$borderColor = 'border-[#F4A261]';
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - <?= $pageTitle ?></title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-primary": "#ffffff",
                    "surface-container-low": "#f1f4f6",
                    "secondary-container": "#9cedef",
                    "surface-container-lowest": "#ffffff",
                    "primary": "#000000",
                    "secondary": "#F4A261",
                    "on-surface": "#181c1e",
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
<h1 class="text-4xl md:text-5xl font-extrabold tracking-tight <?= $themeColor ?>"><?= $pageTitle ?></h1>
<p class="text-lg text-on-surface-variant max-w-2xl mx-auto"><?= $pageSubtitle ?></p>
<div id="statusMessage" class="hidden max-w-2xl mx-auto p-4 rounded-lg font-medium"></div>
</div>

<form id="reportForm" class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] p-8 md:p-12 space-y-10 border-l-4 <?= $borderColor ?>">
<input type="hidden" name="type" value="lost" />

<div class="space-y-6">
<h2 class="text-2xl font-bold text-primary">Item Details</h2>
<div class="space-y-2">
<label class="block text-sm font-semibold text-primary" for="item-name">Item Name <span class="text-error">*</span></label>
<input name="title" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary placeholder:text-on-primary-container transition-all" id="item-name" placeholder="e.g., Blue Water Bottle, Calculator, Keys" required="" type="text"/>
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

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="color">Color</label>
        <input name="color" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="color" placeholder="e.g., Black" type="text"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="brand">Brand</label>
        <input name="brand" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="brand" placeholder="e.g., Apple" type="text"/>
    </div>
</div>

<div class="space-y-2">
    <label class="block text-sm font-semibold text-primary" for="reward">Reward Offered <span class="text-xs text-on-surface-variant font-normal">(Optional)</span></label>
    <input name="reward_offered" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="reward" placeholder="e.g., Small cash reward or Treat" type="text"/>
</div>
</div>

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Where & When?</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="space-y-2 md:col-span-2">
        <label class="block text-sm font-semibold text-primary" for="location">Location <span class="text-error">*</span></label>
        <input name="location_text" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="location" placeholder="e.g., Near Canteen Area, Ground floor hallway" required="" type="text"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="date">Date Lost <span class="text-error">*</span></label>
        <input name="date_occurred" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary" id="date" required type="date" value="<?= date('Y-m-d') ?>"/>
    </div>
</div>
</div>

<div class="space-y-2 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<label class="block text-sm font-semibold text-primary" for="item-description">General Description <span class="text-error">*</span></label>
<textarea name="description" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-secondary text-primary resize-none" id="item-description" placeholder="Describe the item generally (e.g., Blue bag with some books inside)..." rows="3" required></textarea>
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

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Visual Identification</h2>
<p class="text-sm text-on-surface-variant">Upload photos to help others identify the item faster. (Optional)</p>
<div class="w-full bg-surface-container-low border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center text-center hover:bg-surface-container transition-colors cursor-pointer group">
<div class="w-16 h-16 bg-surface-container-lowest rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl text-secondary">cloud_upload</span>
</div>
<p class="text-base font-semibold text-primary mb-1">Drag and drop images here</p>
<p class="text-sm text-on-surface-variant mb-4">or click to browse from your device</p>
<input name="images[]" id="file_upload" accept="image/*" class="hidden" multiple="" type="file"/>
</div>
</div>

<div class="flex justify-end pt-8 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<button id="submitBtn" class="bg-secondary text-white font-bold tracking-tight px-8 py-4 rounded-DEFAULT shadow-lg hover:opacity-90 transition-all flex items-center gap-2" type="submit">
    Post Lost Item
    <span class="material-symbols-outlined text-sm">send</span>
</button>
</div>
</form>
</main>
<?php include 'includes/footer.php'; ?>

<script>
    // Trigger file input
    document.querySelector('.group.cursor-pointer').addEventListener('click', () => {
        document.getElementById('file_upload').click();
    });

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
                btn.innerHTML = `Post Lost Item <span class="material-symbols-outlined text-sm">send</span>`;
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

