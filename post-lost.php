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
<title>FindIt - Report Lost Item (Azam Campus)</title>
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
    </style>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background antialiased min-h-screen flex flex-col">
<?php include 'includes/navbar.php'; ?>
<main class="flex-grow max-w-4xl mx-auto w-full px-6 py-12 md:py-20 flex flex-col gap-12">
<div class="text-center space-y-4">
<h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-primary"><?= $pageTitle ?></h1>
<p class="text-lg text-on-surface-variant max-w-2xl mx-auto"><?= $pageSubtitle ?></p>
<div id="statusMessage" class="hidden max-w-2xl mx-auto p-4 rounded-lg font-medium"></div>
</div>
<div class="flex items-center justify-between relative max-w-2xl mx-auto w-full mb-8">
<div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-surface-container-high rounded-full -z-10"></div>
<div class="absolute left-0 top-1/2 -translate-y-1/2 w-1/4 h-1 bg-primary rounded-full -z-10"></div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold shadow-md">1</div>
<span class="text-sm font-semibold text-primary">Item Info</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest border border-outline-variant text-on-surface-variant flex items-center justify-center font-bold">2</div>
<span class="text-sm font-semibold text-on-surface-variant">Location</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest border border-outline-variant text-on-surface-variant flex items-center justify-center font-bold">3</div>
<span class="text-sm font-semibold text-on-surface-variant">Details</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-surface-container-lowest border border-outline-variant text-on-surface-variant flex items-center justify-center font-bold">4</div>
<span class="text-sm font-semibold text-on-surface-variant">Review</span>
</div>
</div>
<form id="reportForm" class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] p-8 md:p-12 space-y-10 border-l-4 <?= $borderColor ?>">
<input type="hidden" name="type" value="lost" />
<div class="space-y-6">
<h2 class="text-2xl font-bold text-primary">Item Details</h2>
<div class="space-y-2">
<label class="block text-sm font-semibold text-primary" for="item-name">Item Name <span class="text-error">*</span></label>
<input name="title" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary placeholder:text-on-primary-container transition-all" id="item-name" placeholder="e.g., Blue College ID Card, Scientific Calculator, Backpack" required="" type="text"/>
</div>
<div class="space-y-3">
<label class="block text-sm font-semibold text-primary">Category</label>
<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Electronics" required/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Electronics</div>
</label>
<label class="cursor-pointer">
<input checked="" class="peer sr-only" name="category" type="radio" value="Wallets &amp; IDs"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Wallets &amp; IDs</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Keys"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Keys</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Bags"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Bags</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Clothing"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Clothing</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Jewelry"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Jewelry</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Books & Documents"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Books & Docs</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio" value="Other"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Other</div>
</label>
</div>
</div>
<div class="space-y-2 mt-6">
<label class="block text-sm font-semibold text-primary" for="location">Location <span class="text-error">*</span></label>
<input name="location_text" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary placeholder:text-on-primary-container transition-all" id="location" placeholder="e.g., Abeda Inamdar College Library, Ground, Masjid Area" required="" type="text"/>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="color">Color</label>
        <input name="color" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="color" placeholder="e.g., Black" type="text"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="brand">Brand</label>
        <input name="brand" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="brand" placeholder="e.g., Apple" type="text"/>
    </div>
    <div class="space-y-2 md:col-span-2">
        <label class="block text-sm font-semibold text-primary" for="reward">Reward Offered <span class="text-xs text-on-surface-variant font-normal">(Optional)</span></label>
        <input name="reward_offered" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="reward" placeholder="e.g., Small cash reward or Treat" type="text"/>
    </div>
    <div class="space-y-2 md:col-span-2">
        <label class="block text-sm font-semibold text-primary" for="date">Date Occurred <span class="text-error">*</span></label>
        <input name="date_occurred" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="date" required type="date" value="<?= date('Y-m-d') ?>"/>
    </div>
</div>

<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Your Contact Information</h2>
<p class="text-sm text-on-surface-variant">This information will be shown to others so they can contact you directly.</p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="contact_name">Display Name <span class="text-error">*</span></label>
        <input name="contact_name" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="contact_name" required type="text" value="<?= htmlspecialchars($_SESSION['full_name'] ?? '') ?>"/>
    </div>
    <div class="space-y-2">
        <label class="block text-sm font-semibold text-primary" for="contact_phone">Contact Number <span class="text-error">*</span></label>
        <input name="contact_phone" class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary" id="contact_phone" required type="text" value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>" placeholder="e.g., 9876543210"/>
    </div>
</div>
</div>
<div class="space-y-6 pt-6 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<h2 class="text-2xl font-bold text-primary">Visual Identification</h2>
<p class="text-sm text-on-surface-variant">Upload photos to help others identify your item faster. (Optional)</p>
<div class="w-full bg-surface-container-low border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center text-center hover:bg-surface-container transition-colors cursor-pointer group">
<div class="w-16 h-16 bg-surface-container-lowest rounded-full flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-3xl text-[#0F7173]" data-icon="cloud_upload">cloud_upload</span>
</div>
<p class="text-base font-semibold text-primary mb-1">Drag and drop images here</p>
<p class="text-sm text-on-surface-variant mb-4">or click to browse from your device</p>
<span class="text-xs text-outline font-medium">Supports JPG, PNG (Max 5MB)</span>
<input name="images[]" id="file_upload" accept="image/*" class="hidden" multiple="" type="file"/>
</div>
</div>
<div class="flex justify-end pt-8 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<button id="submitBtn" class="bg-primary text-white font-bold tracking-tight px-8 py-3 rounded-DEFAULT shadow-[0_4px_14px_0_rgba(13,27,42,0.39)] hover:shadow-[0_6px_20px_rgba(13,27,42,0.23)] hover:bg-primary-container transition duration-200 bg-gradient-to-br from-[#0D1B2A] to-[#0f1c2c] flex items-center gap-2" type="submit">
                    Submit Report
                    <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</form>
</main>
<?php include 'includes/footer.php'; ?>

<script>
    // Make the entire drop zone trigger the file input
    document.querySelector('.group.cursor-pointer').addEventListener('click', function(e) {
        if(e.target !== document.getElementById('file_upload')) {
            document.getElementById('file_upload').click();
        }
    });

    document.getElementById('file_upload').addEventListener('change', function() {
        const fileCount = this.files.length;
        if(fileCount > 0) {
            document.querySelector('.group.cursor-pointer p.mb-1').innerText = fileCount + ' file(s) selected';
        } else {
            document.querySelector('.group.cursor-pointer p.mb-1').innerText = 'Drag and drop images here';
        }
    });

    // Form Submission Logic via Fetch
    document.getElementById('reportForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = e.target;
        const btn = document.getElementById('submitBtn');
        const statusBox = document.getElementById('statusMessage');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm" data-icon="progress_activity">progress_activity</span> Processing...`;
        
        try {
            const response = await fetch('api/post_item.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            statusBox.classList.remove('hidden', 'bg-error-container', 'text-on-error-container', 'bg-[#c6f6d5]', 'text-[#22543d]');
            
            if(data.success) {
                statusBox.classList.add('bg-[#c6f6d5]', 'text-[#22543d]');
                statusBox.innerText = data.message + " Redirecting...";
                setTimeout(() => {
                    window.location.href = `item-detail.php?id=${data.data.item_id}`;
                }, 1500);
            } else {
                statusBox.classList.add('bg-error-container', 'text-on-error-container');
                statusBox.innerText = data.message;
                btn.disabled = false;
                btn.innerHTML = `Submit Report <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>`;
            }
        } catch (error) {
            statusBox.classList.remove('hidden');
            statusBox.classList.add('bg-error-container', 'text-on-error-container');
            statusBox.innerText = "Network Error. Please try again.";
            btn.disabled = false;
            btn.innerHTML = `Submit Report <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>`;
        }
    });
</script>
</body></html>