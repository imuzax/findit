<?php require_once 'includes/auth_check.php'; ?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Post Lost Item</title>
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
<h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-primary">Report a Lost Item</h1>
<p class="text-lg text-on-surface-variant max-w-2xl mx-auto">Provide details about the item you lost. The more descriptive you are, the higher the chances of a successful return.</p>
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
<form class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] p-8 md:p-12 space-y-10 border-l-4 border-[#F4A261]">
<div class="space-y-6">
<h2 class="text-2xl font-bold text-primary">What did you lose?</h2>
<div class="space-y-2">
<label class="block text-sm font-semibold text-primary" for="item-name">Item Name <span class="text-error">*</span></label>
<input class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary placeholder:text-on-primary-container transition-all" id="item-name" placeholder="e.g., Black Leather Wallet, Silver iPhone 13" required="" type="text"/>
</div>
<div class="space-y-3">
<label class="block text-sm font-semibold text-primary">Category</label>
<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Electronics</div>
</label>
<label class="cursor-pointer">
<input checked="" class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Wallets &amp; IDs</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Keys</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Bags</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Clothing</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Jewelry</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Pets</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="category" type="radio"/>
<div class="rounded-full px-4 py-2 text-center text-sm font-medium bg-surface-container-high text-on-surface hover:bg-surface-dim transition-colors peer-checked:bg-primary peer-checked:text-white">Other</div>
</label>
</div>
</div>
<div class="space-y-2">
<label class="block text-sm font-semibold text-primary" for="item-description">Detailed Description</label>
<textarea class="w-full px-4 py-3 rounded-DEFAULT bg-surface border-none focus:ring-2 focus:ring-[#0F7173] text-primary placeholder:text-on-primary-container transition-all resize-none" id="item-description" placeholder="Mention specific identifying marks, colors, brands, or contents..." rows="4"></textarea>
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
<input accept="image/*" class="hidden" multiple="" type="file"/>
</div>
</div>
<div class="flex justify-end pt-8 relative before:absolute before:inset-x-0 before:top-0 before:h-px before:bg-surface-container-high before:content-['']">
<button class="bg-primary text-white font-bold tracking-tight px-8 py-3 rounded-DEFAULT shadow-[0_4px_14px_0_rgba(13,27,42,0.39)] hover:shadow-[0_6px_20px_rgba(13,27,42,0.23)] hover:bg-primary-container transition duration-200 bg-gradient-to-br from-[#0D1B2A] to-[#0f1c2c] flex items-center gap-2" type="button">
                    Next Step
                    <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
</form>
</main>
<?php include 'includes/footer.php'; ?>
</body></html>