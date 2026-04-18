<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Item Detail</title>
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
<body class="bg-background text-on-background antialiased">
<?php include 'includes/navbar.php'; ?>
<!-- Main Content -->
<main class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 lg:grid-cols-12 gap-16">
<!-- Left: Image Gallery -->
<div class="lg:col-span-7 flex flex-col gap-6">
<div class="w-full aspect-[4/3] rounded-xl overflow-hidden bg-surface-container-low shadow-[0_8px_32px_rgba(13,27,42,0.06)]">
<img alt="Main item image" class="w-full h-full object-cover" data-alt="Close up photography of a vintage leather satchel bag sitting on a wooden bench in soft natural light, detailed texture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWr0p-Da8X1cqaE6f4lyC1qsK4DLDNkR9o7v_uIktH8uB0uoBN2cbSHQZtJwcw3d8vF0Fvmy4fzz1erwd1vKR_cmltA-XpuEDlbnfPM6RZEH7YX-TEsA2cL-_aX-F8syDm5f5zfMTfr8IecdbMKc4DcqNK1GgzPbJgoCX2ozQLEdS7EuYWZSM-iMxwIcxDPZrDes4KavvrYg31b1KTehdMwc_joERdab3dtVCnIrSF3C0dqr9-IdAEyOM5cUENXaQF3vRO734hVWIM"/>
</div>
<!-- Thumbnails -->
<div class="grid grid-cols-4 gap-4">
<div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low ring-2 ring-primary cursor-pointer">
<img alt="Thumbnail 1" class="w-full h-full object-cover opacity-100" data-alt="Close up photography of a vintage leather satchel bag sitting on a wooden bench in soft natural light, detailed texture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEJwLxAj_NjKZfe_avIIMM9ZeZoZdFdp8L7lvVikzDMCyji2WxJblUWwRjdgELrEmco74pE3jzAIeM6cy847xgk3RLjhMJRKbDBQmfWuHlQ5blACfRkXyPG-uGH484-tWK934a_7QUyWTTf86r7Hc61naYR_5Fm8E2EkZ_fIDK6BfwDQ1XWQkRBakYOkYcFMZLiYT8LZEtBqYl3C236W-Ak6V7MV0s6kAD4dKmPkSGtnSIMj2A7xj5TWpylfJsxdVQ83ivnXmeWpZg"/>
</div>
<div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low hover:opacity-80 transition-opacity cursor-pointer">
<img alt="Thumbnail 2" class="w-full h-full object-cover" data-alt="Detail shot showing the brass buckle hardware on a well-worn brown leather satchel bag" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqm2Un-lSn2r0r3L9l6rvE1VVgkPv3VxVj9kYWDvE79_N5A3nLCFhgLUj8O1JKUddSekrztRuT7lqvx-akHxYeso1BeetEzA9FPKIeNtLdpkjIaZR07uyiCzKKMyOXLwddjclQgyRPZfn33jZV_gzEiqKhaMWESPD24USMKm8HLy3p3WK5i70UHF9o06XfSSLI8anuKHm9VlVMgJdQu3YEWP2Jjt5iJrTLEpNUKVPuNHVKXyqDXFC5vaYPMfUf4w3k3as4cmlipacp"/>
</div>
<div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low hover:opacity-80 transition-opacity cursor-pointer">
<img alt="Thumbnail 3" class="w-full h-full object-cover" data-alt="Inside view of an empty brown leather satchel showing the canvas lining and an interior zip pocket" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCw_tE9BkeEMKyxt3jWJ5SEEosQxws_UXR7qF54naqzKrAH0SbM7gEsj01Xo7eyKIYUIV1jd2lcuXXd4z1ID0jElzbT_BiFKd_62-L-nCropkVgD37MG9IlUNv3SdCCnssFxO54gPPwZxkytpT2OuBDczNaIDbtw29CfHe8-fIROOi2MEsz5afufzwDZ_gR3qEZi8ZnUZFDwWzw4Ha6J8BJvZRoegCCTbH7fAUqwf0B9nAKsxf8OQOyU7HWtIZVaCTyu0Sh7hYiXyYH"/>
</div>
<div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low hover:opacity-80 transition-opacity flex items-center justify-center cursor-pointer">
<span class="material-symbols-outlined text-outline" style="font-size: 2rem;">add_photo_alternate</span>
</div>
</div>
</div>
<!-- Right: Sticky Panel -->
<div class="lg:col-span-5 relative">
<div class="sticky top-28 flex flex-col gap-8 bg-surface-container-lowest p-8 rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] border-l-4 border-l-[#F4A261]">
<!-- Status Badge & Meta -->
<div class="flex items-center justify-between">
<span class="bg-[#F4A261]/10 text-[#F4A261] px-4 py-1.5 rounded-full text-[0.75rem] font-bold uppercase tracking-wider font-['Inter']">
                        Lost Item
                    </span>
<span class="text-on-surface-variant text-[0.875rem] font-['Inter']">Reported 2 days ago</span>
</div>
<!-- Title & Description -->
<div>
<h1 class="text-[2rem] font-bold font-['Inter'] text-primary tracking-tight leading-tight mb-4">Vintage Leather Satchel</h1>
<p class="text-[0.875rem] text-on-surface-variant font-['Inter'] leading-relaxed">
                        Lost my brown leather satchel near Central Park, possibly around the Bethesda Terrace area. It has distinct brass buckles and a slight scuff mark on the bottom right corner. Contains a notebook and some personal items. Great sentimental value.
                    </p>
</div>
<!-- Lifecycle Stepper -->
<div class="bg-surface-container-low p-6 rounded-lg">
<h3 class="text-[0.75rem] font-bold uppercase tracking-wider font-['Inter'] text-on-surface-variant mb-6">Status Tracker</h3>
<div class="relative flex justify-between items-center">
<div class="absolute left-0 top-1/2 w-full h-[2px] bg-surface-variant -z-10 -translate-y-1/2"></div>
<div class="absolute left-0 top-1/2 w-1/2 h-[2px] bg-primary -z-10 -translate-y-1/2"></div>
<div class="flex flex-col items-center gap-2">
<div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<span class="text-[0.75rem] font-semibold font-['Inter'] text-primary">Reported</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-8 h-8 rounded-full bg-surface-container-lowest border-2 border-primary text-primary flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-sm">hourglass_empty</span>
</div>
<span class="text-[0.75rem] font-semibold font-['Inter'] text-primary">Matched</span>
</div>
<div class="flex flex-col items-center gap-2">
<div class="w-8 h-8 rounded-full bg-surface-container-highest text-outline flex items-center justify-center">
<span class="material-symbols-outlined text-sm">handshake</span>
</div>
<span class="text-[0.75rem] font-semibold font-['Inter'] text-outline">Claimed</span>
</div>
</div>
</div>
<!-- Location Map Snippet -->
<div class="rounded-lg overflow-hidden h-32 relative bg-surface-container-low shadow-sm">
<img alt="Map location" class="w-full h-full object-cover opacity-60" data-alt="Abstract minimal map view showing Central Park area in light gray tones" data-location="Central Park, NY" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCpnUBN9TqDXm9eDr2KXGGFtJ0SR6ofPpEXJYbsO01hY6FteE4IeLBjG9NIjKhrC7LbmEFxAhk6f8hkOt_-zpQVZViW-o3XPM-p40kH2xiUnobDFu343AlVzcuxdSVcz5LH0ZVNXv5D1sNnf1iD2bMiRSwrSAusAr4104oYJREcgFJgmDI4QyWPPxaaKmHEYBbHFw7J1nI-6kyPNxF2OSbs8ZScFtld17H2OMGwNxZiS-uRYBttQKQTuqkRrZc1lFE6lkTK2L2XBouO"/>
<div class="absolute inset-0 flex items-center justify-center">
<div class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-full shadow-sm flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-sm">location_on</span>
<span class="text-[0.875rem] font-semibold font-['Inter'] text-primary">Near Bethesda Terrace</span>
</div>
</div>
</div>
<!-- Primary CTA -->
<button class="w-full bg-[#F4A261] hover:bg-[#e09152] text-primary font-['Inter'] font-bold py-4 px-6 rounded-DEFAULT transition-all duration-200 active:scale-95 shadow-[0_8px_32px_rgba(13,27,42,0.06)] flex justify-center items-center gap-2">
<span class="material-symbols-outlined">waving_hand</span>
                    This Is Mine — Claim Item
                </button>
</div>
</div>
</main>
<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</body></html>