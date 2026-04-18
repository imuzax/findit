<?php require_once 'includes/admin_check.php'; ?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
            "spacing": {},
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
<body class="bg-background text-on-surface font-body h-screen flex overflow-hidden">
<!-- SideNavBar (from JSON) -->
<aside class="w-[220px] h-screen fixed left-0 border-r-0 bg-[#f7fafc] dark:bg-slate-950 flex flex-col gap-4 p-6 z-40 hidden md:flex">
<div class="mb-8">
<h1 class="text-xl font-bold text-[#0D1B2A] dark:text-white font-headline tracking-tight">FindIt</h1>
<p class="text-xs text-on-surface-variant mt-1">Digital Concierge</p>
</div>
<nav class="flex flex-col gap-2 flex-1">
<!-- Active Tab: Dashboard -->
<a class="flex items-center gap-3 px-4 py-3 text-[#0F7173] bg-white dark:bg-slate-800 rounded-lg shadow-sm font-semibold font-['Inter'] text-sm font-medium hover:translate-x-1 transition-transform cursor-pointer transition-all" href="#">
<span class="material-symbols-outlined" data-weight="fill" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                Dashboard
            </a>
<!-- Inactive Tabs -->
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg font-['Inter'] text-sm font-medium hover:translate-x-1 transition-transform cursor-pointer transition-all" href="#">
<span class="material-symbols-outlined">description</span>
                My Reports
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg font-['Inter'] text-sm font-medium hover:translate-x-1 transition-transform cursor-pointer transition-all" href="#">
<span class="material-symbols-outlined">chat</span>
                Messages
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg font-['Inter'] text-sm font-medium hover:translate-x-1 transition-transform cursor-pointer transition-all" href="#">
<span class="material-symbols-outlined">bookmark</span>
                Saved Items
            </a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg font-['Inter'] text-sm font-medium hover:translate-x-1 transition-transform cursor-pointer transition-all" href="#">
<span class="material-symbols-outlined">settings</span>
                Settings
            </a>
</nav>
<div class="mt-auto pt-8">
<button class="w-full py-3 px-4 bg-primary text-on-primary rounded font-label font-semibold hover:bg-primary-container transition-colors duration-200 shadow-[0_8px_32px_rgba(13,27,42,0.06)] flex items-center justify-center gap-2">
<span class="material-symbols-outlined">add</span>
                New Report
            </button>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 ml-0 md:ml-[220px] h-screen overflow-y-auto bg-surface-container-low p-8 lg:p-12">
<!-- Header -->
<?php include 'includes/navbar.php'; ?>
<!-- KPI Row -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
<!-- KPI 1 -->
<div class="bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_32px_rgba(13,27,42,0.06)] relative overflow-hidden">
<div class="absolute top-0 left-0 w-1 h-full bg-secondary"></div>
<h3 class="text-sm font-label font-semibold text-on-surface-variant tracking-widest uppercase mb-4">Total Items</h3>
<div class="flex items-baseline gap-4">
<span class="text-[3.5rem] font-headline font-[800] tracking-tighter text-primary-container leading-none">2,845</span>
<span class="text-secondary font-label font-semibold flex items-center text-sm">
<span class="material-symbols-outlined text-sm">trending_up</span> 12%
                    </span>
</div>
<!-- Sparkline Placeholder -->
<div class="mt-6 flex items-end gap-1 h-12">
<div class="w-full bg-surface-container-highest rounded-t h-[30%] hover:bg-secondary transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[50%] hover:bg-secondary transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[40%] hover:bg-secondary transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[70%] hover:bg-secondary transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[60%] hover:bg-secondary transition-colors"></div>
<div class="w-full bg-secondary rounded-t h-[90%] opacity-80"></div>
</div>
</div>
<!-- KPI 2 -->
<div class="bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_32px_rgba(13,27,42,0.06)] relative overflow-hidden">
<div class="absolute top-0 left-0 w-1 h-full bg-[#F4A261]"></div>
<h3 class="text-sm font-label font-semibold text-on-surface-variant tracking-widest uppercase mb-4">Pending Review</h3>
<div class="flex items-baseline gap-4">
<span class="text-[3.5rem] font-headline font-[800] tracking-tighter text-primary-container leading-none">142</span>
<span class="text-[#F4A261] font-label font-semibold flex items-center text-sm">
<span class="material-symbols-outlined text-sm">error</span> Action needed
                    </span>
</div>
<!-- Sparkline Placeholder -->
<div class="mt-6 flex items-end gap-1 h-12">
<div class="w-full bg-surface-container-highest rounded-t h-[40%]"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[45%]"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[50%]"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[60%]"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[80%]"></div>
<div class="w-full bg-[#F4A261] rounded-t h-[100%] opacity-80"></div>
</div>
</div>
<!-- KPI 3 -->
<div class="bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_32px_rgba(13,27,42,0.06)] relative overflow-hidden">
<div class="absolute top-0 left-0 w-1 h-full bg-primary-container"></div>
<h3 class="text-sm font-label font-semibold text-on-surface-variant tracking-widest uppercase mb-4">Resolution Rate</h3>
<div class="flex items-baseline gap-4">
<span class="text-[3.5rem] font-headline font-[800] tracking-tighter text-primary-container leading-none">68%</span>
<span class="text-on-surface-variant font-label font-semibold flex items-center text-sm">
<span class="material-symbols-outlined text-sm">check_circle</span> 30 days
                    </span>
</div>
<!-- Sparkline Placeholder -->
<div class="mt-6 flex items-end gap-1 h-12">
<div class="w-full bg-surface-container-highest rounded-t h-[60%] hover:bg-primary-container transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[65%] hover:bg-primary-container transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[62%] hover:bg-primary-container transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[68%] hover:bg-primary-container transition-colors"></div>
<div class="w-full bg-surface-container-highest rounded-t h-[70%] hover:bg-primary-container transition-colors"></div>
<div class="w-full bg-primary-container rounded-t h-[72%] opacity-80"></div>
</div>
</div>
</section>
<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-16">
<!-- Pending Items Table Section (Spans 2 columns) -->
<section class="lg:col-span-2">
<div class="flex justify-between items-center mb-8">
<h3 class="text-[1.125rem] font-headline font-[600] text-primary-container">Action Queue</h3>
<button class="text-sm font-label font-semibold text-secondary hover:text-on-secondary-fixed-variant transition-colors">View All</button>
</div>
<div class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] overflow-hidden">
<div class="flex flex-col">
<!-- Table Header (Simulated with no lines) -->
<div class="grid grid-cols-12 gap-4 p-6 bg-surface-container-lowest text-xs font-label font-semibold text-on-surface-variant tracking-widest uppercase">
<div class="col-span-5">Item Details</div>
<div class="col-span-3">Reported By</div>
<div class="col-span-4 text-right">Actions</div>
</div>
<!-- Row 1 -->
<div class="grid grid-cols-12 gap-4 p-6 items-center hover:bg-surface-container transition-colors duration-200">
<div class="col-span-5 flex items-center gap-4">
<div class="w-12 h-12 rounded bg-surface-container-highest bg-cover bg-center" data-alt="close up of a pair of wireless over-ear headphones resting on a clean wooden desk with soft natural light" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAOawurbpJLRflKuEief6q4D5rnz3wnuShR-AGcQWLvJ0_HzAz3xWIBs09A-V-Y4AKjfRn40e8mfOrTHY32FrU1z1wI73KTXFxhz92MBgKRSFebENQn2-4Rt4WKfyF6mpegPJGfNlpxKfdZqy5mn0wJNt8bEiwytzGNAFThtlc9XP__OFep9ClNikf43M0Awu9lAzeZv1ulVjrY2Ht5BuYALel9YnH2XGG1g-IL2z0u0cZaVN4gspwPdWZwz8vRYo9riiiy1KMiGTXQ');"></div>
<div>
<h4 class="font-headline font-[600] text-on-surface text-sm">Sony WH-1000XM4</h4>
<p class="text-xs text-on-surface-variant mt-1">Found at Main Library</p>
</div>
</div>
<div class="col-span-3">
<p class="text-sm font-body text-on-surface">Alex Mercer</p>
<p class="text-xs text-on-surface-variant mt-1">2 hours ago</p>
</div>
<div class="col-span-4 flex justify-end gap-3">
<button class="px-4 py-2 bg-transparent text-on-surface-variant font-label text-xs font-semibold rounded hover:bg-surface-container-high transition-colors">Reject</button>
<button class="px-4 py-2 bg-secondary text-on-secondary font-label text-xs font-semibold rounded hover:bg-on-secondary-fixed-variant transition-colors shadow-sm">Approve</button>
</div>
</div>
<!-- Row 2 -->
<div class="grid grid-cols-12 gap-4 p-6 items-center hover:bg-surface-container transition-colors duration-200">
<div class="col-span-5 flex items-center gap-4">
<div class="w-12 h-12 rounded bg-surface-container-highest bg-cover bg-center" data-alt="close up of a set of silver house keys attached to a thick braided blue cord lanyard laying on asphalt" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDOeCuyrwzNvnt2YtE6F9Bj_-QLNEpq_Hi-1ho0o9kv4_j3s89YHgo62jsJbAXghgIZ3unwPyS6wy9MmQuXsKdFGh3KMobm9ulWf3TDAZMWg0YF0emLCAfhUJsvkZWH3U7294T09IhLQjBXchaTe3JLLeq44C0guw0yBwRhGFS5ZXa0OnlNM-n-lwy6m3Cn_yKrMSTYi-f3fPbWx26HnQ6Xi1VEW5Egq1hGXeq9KKXiV2_Oq5lHkD1B7UkSTVkKCXGt1Ov4mhGnD0ws');"></div>
<div>
<h4 class="font-headline font-[600] text-on-surface text-sm">Keys on Blue Lanyard</h4>
<p class="text-xs text-on-surface-variant mt-1">Found at Cafe 101</p>
</div>
</div>
<div class="col-span-3">
<p class="text-sm font-body text-on-surface">Sam Rivera</p>
<p class="text-xs text-on-surface-variant mt-1">5 hours ago</p>
</div>
<div class="col-span-4 flex justify-end gap-3">
<button class="px-4 py-2 bg-transparent text-on-surface-variant font-label text-xs font-semibold rounded hover:bg-surface-container-high transition-colors">Reject</button>
<button class="px-4 py-2 bg-secondary text-on-secondary font-label text-xs font-semibold rounded hover:bg-on-secondary-fixed-variant transition-colors shadow-sm">Approve</button>
</div>
</div>
<!-- Row 3 -->
<div class="grid grid-cols-12 gap-4 p-6 items-center hover:bg-surface-container transition-colors duration-200">
<div class="col-span-5 flex items-center gap-4">
<div class="w-12 h-12 rounded bg-surface-container-highest bg-cover bg-center flex items-center justify-center text-on-surface-variant">
<span class="material-symbols-outlined">image_not_supported</span>
</div>
<div>
<h4 class="font-headline font-[600] text-on-surface text-sm">Black Umbrella</h4>
<p class="text-xs text-on-surface-variant mt-1">Lost near Bus Stop C</p>
</div>
</div>
<div class="col-span-3">
<p class="text-sm font-body text-on-surface">Jordan Lee</p>
<p class="text-xs text-on-surface-variant mt-1">1 day ago</p>
</div>
<div class="col-span-4 flex justify-end gap-3">
<button class="px-4 py-2 bg-transparent text-on-surface-variant font-label text-xs font-semibold rounded hover:bg-surface-container-high transition-colors">Reject</button>
<button class="px-4 py-2 bg-secondary text-on-secondary font-label text-xs font-semibold rounded hover:bg-on-secondary-fixed-variant transition-colors shadow-sm">Approve</button>
</div>
</div>
</div>
</div>
</section>
<!-- Analytics Section (Side Column) -->
<section class="flex flex-col gap-12">
<!-- Category Donut (Conceptual) -->
<div>
<h3 class="text-[1.125rem] font-headline font-[600] text-primary-container mb-8">Category Breakdown</h3>
<div class="bg-surface-container-lowest rounded-xl p-8 shadow-[0_8px_32px_rgba(13,27,42,0.06)] flex flex-col items-center justify-center min-h-[280px]">
<!-- Abstract representation of a donut chart using CSS -->
<div class="w-48 h-48 rounded-full border-[16px] border-surface-container-low relative flex items-center justify-center mb-6">
<!-- Faux chart segments -->
<div class="absolute inset-0 rounded-full border-[16px] border-secondary" style="clip-path: polygon(50% 50%, 100% 0, 100% 100%, 0 100%, 0 50%); transform: rotate(-45deg);"></div>
<div class="absolute inset-0 rounded-full border-[16px] border-[#F4A261]" style="clip-path: polygon(50% 50%, 0 50%, 0 0, 50% 0); transform: rotate(15deg);"></div>
<div class="absolute inset-0 rounded-full border-[16px] border-primary-container" style="clip-path: polygon(50% 50%, 50% 0, 100% 0); transform: rotate(105deg);"></div>
<div class="text-center z-10">
<span class="block text-2xl font-headline font-[800] text-primary-container">Top</span>
<span class="block text-xs font-label text-on-surface-variant">Electronics</span>
</div>
</div>
<div class="w-full flex justify-between px-4 mt-4">
<div class="flex items-center gap-2">
<div class="w-3 h-3 rounded-full bg-secondary"></div>
<span class="text-xs font-label text-on-surface-variant">Tech</span>
</div>
<div class="flex items-center gap-2">
<div class="w-3 h-3 rounded-full bg-primary-container"></div>
<span class="text-xs font-label text-on-surface-variant">Wallets</span>
</div>
<div class="flex items-center gap-2">
<div class="w-3 h-3 rounded-full bg-[#F4A261]"></div>
<span class="text-xs font-label text-on-surface-variant">Keys</span>
</div>
</div>
</div>
</div>
</section>
</div>
</main>
</body></html>