<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Messages - FindIt</title>
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
<body class="bg-background text-on-background min-h-screen flex font-body">
<!-- SideNavBar Component -->
<nav class="hidden md:flex w-[220px] h-screen fixed left-0 border-r-0 bg-[#f7fafc] dark:bg-slate-950 flex-col gap-4 p-6 z-50 tonal-layering bg-[#f1f4f6] dark:bg-slate-900 flat no-line">
<div class="mb-8">
<h1 class="text-xl font-bold text-[#0D1B2A] dark:text-white font-headline">FindIt</h1>
<p class="text-sm text-on-surface-variant font-body">Digital Concierge</p>
</div>
<button class="w-full bg-primary-container text-on-primary py-3 px-4 rounded-DEFAULT font-label font-bold text-[0.75rem] mb-6 flex items-center justify-center gap-2 hover:bg-primary transition-colors">
<span class="material-symbols-outlined text-[18px]">add</span>
            New Report
        </button>
<div class="flex flex-col gap-2 flex-grow">
<!-- Inactive -->
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all font-['Inter'] text-sm font-medium" href="#">
<span class="material-symbols-outlined text-[20px]" data-icon="dashboard">dashboard</span>
                Dashboard
            </a>
<!-- Inactive -->
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all font-['Inter'] text-sm font-medium" href="#">
<span class="material-symbols-outlined text-[20px]" data-icon="description">description</span>
                My Reports
            </a>
<!-- Active -->
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#0F7173] bg-white dark:bg-slate-800 shadow-sm font-semibold hover:translate-x-1 transition-transform cursor-pointer transition-all font-['Inter'] text-sm" href="#">
<span class="material-symbols-outlined text-[20px]" data-icon="chat" data-weight="fill" style="font-variation-settings: 'FILL' 1;">chat</span>
                Messages
            </a>
<!-- Inactive -->
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all font-['Inter'] text-sm font-medium" href="#">
<span class="material-symbols-outlined text-[20px]" data-icon="bookmark">bookmark</span>
                Saved Items
            </a>
<!-- Inactive -->
<a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 hover:translate-x-1 transition-transform cursor-pointer transition-all font-['Inter'] text-sm font-medium mt-auto" href="#">
<span class="material-symbols-outlined text-[20px]" data-icon="settings">settings</span>
                Settings
            </a>
</div>
</nav>
<!-- Main Content -->
<main class="flex-1 md:ml-[220px] flex h-screen bg-surface overflow-hidden">
<!-- Conversations List Panel -->
<section class="w-full md:w-[380px] flex flex-col h-full bg-surface-container-low border-r border-outline-variant/15 flex-shrink-0">
<div class="p-6 pb-4">
<h2 class="text-[2rem] font-bold font-headline text-on-surface tracking-tight mb-6">Messages</h2>
<div class="relative mb-6 shadow-[0_8px_32px_rgba(13,27,42,0.06)] rounded-lg">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
<input class="w-full pl-12 pr-4 py-3 bg-surface-container-lowest rounded-lg border-none focus:ring-2 focus:ring-secondary text-[0.875rem] font-body text-on-surface placeholder:text-on-surface-variant" placeholder="Search conversations..." type="text"/>
</div>
</div>
<div class="flex-1 overflow-y-auto overflow-x-hidden p-3 gap-2 flex flex-col">
<!-- Active Conversation -->
<article class="p-4 bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] cursor-pointer relative overflow-hidden group">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary"></div>
<div class="flex gap-4 items-start">
<div class="relative">
<img alt="Sarah Jenkins" class="w-12 h-12 rounded-full object-cover shadow-sm" data-alt="close up portrait of a smiling young woman with bright natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9DUAdMaIYvU5K7RB2K3PNnfoMlFRtbG4hKyTY3iEIgxhoHEur0Gk-m_i6q_3axffN6bUHDMkHqU0itdmBpVjduisHfEsUrwH0A1zq_WCCxYocoREj0cTvYcGexUoT2gy5JbbmYoIMXBYVZZlF39v_zje0RdwbooZIHAM1sZNFS3kLtBdmlL4DIMmE1Y3Micbw_1p-3f2sZ6RVbQjH8UA0nnh5j8FdzMUNhtWgKovAT9JfEOKldIguVFMo84MdbVAzIrAWczB60Eg0"/>
<span class="absolute bottom-0 right-0 w-3 h-3 bg-secondary rounded-full border-2 border-surface-container-lowest"></span>
</div>
<div class="flex-1 min-w-0">
<div class="flex justify-between items-baseline mb-1">
<h3 class="font-semibold text-[1.125rem] text-on-surface truncate pr-2">Sarah Jenkins</h3>
<span class="text-[0.75rem] font-label text-on-surface-variant whitespace-nowrap">2m ago</span>
</div>
<p class="text-[0.875rem] text-on-surface-variant truncate font-body">Yes, I found it near the park entrance. I can meet you later today.</p>
<div class="mt-2 flex items-center gap-2">
<span class="px-2 py-0.5 bg-surface-container-high rounded-full text-[0.75rem] font-label text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">watch</span>
                                    Silver Watch
                                </span>
</div>
</div>
</div>
</article>
<!-- Unread Conversation -->
<article class="p-4 bg-transparent hover:bg-surface-container-lowest/50 rounded-xl cursor-pointer transition-colors relative group">
<div class="flex gap-4 items-start">
<div class="relative">
<img alt="Michael Chen" class="w-12 h-12 rounded-full object-cover shadow-sm" data-alt="portrait of a young man with glasses in urban setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvqCSuOIYrwqq-05WBZxk0F4PVIfXbKRemP5RKE9MpxnCa98MAp4VPfPbHwhr0bkZgUeXiKaPpsSwC5xIb4Dpcmh07BBdqOKdCew0lmEvBd38NeYEuCCopo3JquKfa70mBPVdgl3QfXa9NDpNPo67oqAfgfL7GTS1JCUGjvIKnYHLFgS4K-o3CaZZ_KYjpD9rbr1I15j_i_8NQwBZi5URPKS5QSP3VA6idvWClwdHotVajQf05hEA3_jPvuYj7Wm-uoTbh1e39DHsT"/>
</div>
<div class="flex-1 min-w-0">
<div class="flex justify-between items-baseline mb-1">
<h3 class="font-bold text-[1.125rem] text-on-surface truncate pr-2">Michael Chen</h3>
<span class="text-[0.75rem] font-label text-secondary font-bold whitespace-nowrap">1h ago</span>
</div>
<p class="text-[0.875rem] text-on-surface font-semibold truncate font-body">Thanks! I'll come pick it up tomorrow morning.</p>
<div class="mt-2 flex items-center gap-2">
<span class="px-2 py-0.5 bg-surface-container-high rounded-full text-[0.75rem] font-label text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">key</span>
                                    Keys
                                </span>
<span class="w-2 h-2 bg-secondary rounded-full ml-auto"></span>
</div>
</div>
</div>
</article>
<!-- Read Conversation -->
<article class="p-4 bg-transparent hover:bg-surface-container-lowest/50 rounded-xl cursor-pointer transition-colors relative group">
<div class="flex gap-4 items-start opacity-70">
<div class="relative">
<div class="w-12 h-12 rounded-full bg-primary-fixed-dim text-on-primary-fixed flex items-center justify-center font-bold text-lg">
                                EJ
                            </div>
</div>
<div class="flex-1 min-w-0">
<div class="flex justify-between items-baseline mb-1">
<h3 class="font-semibold text-[1.125rem] text-on-surface truncate pr-2">Elena James</h3>
<span class="text-[0.75rem] font-label text-on-surface-variant whitespace-nowrap">Yesterday</span>
</div>
<p class="text-[0.875rem] text-on-surface-variant truncate font-body">Glad we could get that sorted out.</p>
<div class="mt-2 flex items-center gap-2">
<span class="px-2 py-0.5 bg-surface-container-high rounded-full text-[0.75rem] font-label text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">pets</span>
                                    Golden Retriever
                                </span>
</div>
</div>
</div>
</article>
</div>
</section>
<!-- Main Chat Window -->
<section class="flex-1 flex flex-col h-full bg-surface relative hidden md:flex">
<!-- Chat Header -->
<?php include 'includes/navbar.php'; ?>
<!-- Item Reference Card -->
<div class="px-8 py-4 bg-surface z-0">
<div class="bg-surface-container-lowest rounded-xl p-4 shadow-[0_8px_32px_rgba(13,27,42,0.06)] flex gap-4 items-center border-l-4 border-secondary">
<img alt="Silver Watch" class="w-16 h-16 rounded-lg object-cover" data-alt="close up of a modern silver wristwatch on a light surface" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBniyTUxq5xXAullBql1icbFcOvxQl9VcJf_MlAqMZUbTiN0K8QhnoY3ywsWhjNKjTz5PhptSMo0ZmBFIEn2J5BZhsOQ1MM2i3pgdDEu9XNbturDsRZou6tcksrIxZ0rUuX21mjg2K9ZeRU3HEJzFlphPGwjMVZeZRb3ncvcokj-oB52Ieya265ZQ3-ZijPj6eGugWJnmBi5mcS4n4IO3EWSV7I4t7Y5mlznvC54flWqam-5eSTC_zI3dsbg-gtoHDcAs6O42rchh3R"/>
<div class="flex-1">
<span class="text-[0.75rem] font-label text-secondary uppercase tracking-wider mb-1 block">Regarding Found Item</span>
<h4 class="font-semibold text-[1.125rem] text-on-surface">Silver Citizen Eco-Drive Watch</h4>
<p class="text-[0.875rem] text-on-surface-variant">Found at Riverside Park on Oct 12</p>
</div>
<a href="item-detail.php" class="px-4 py-2 bg-secondary text-on-secondary rounded-DEFAULT font-label font-bold text-[0.75rem] hover:bg-on-secondary-fixed-variant transition-colors" style="display:inline-block;text-align:center;">View Details</a>
</div>
</div>
<!-- Chat Messages Area -->
<div class="flex-1 overflow-y-auto px-8 py-6 flex flex-col gap-6">
<!-- Date Divider -->
<div class="flex items-center justify-center gap-4">
<div class="h-px bg-outline-variant/20 flex-1"></div>
<span class="text-[0.75rem] font-label text-on-surface-variant uppercase tracking-wider">Today, 10:42 AM</span>
<div class="h-px bg-outline-variant/20 flex-1"></div>
</div>
<!-- Received Message -->
<div class="flex gap-4 max-w-[80%]">
<img alt="Sarah Jenkins" class="w-8 h-8 rounded-full object-cover flex-shrink-0 mt-1" data-alt="close up portrait of a smiling young woman with bright natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbz9suL9bVnufy2PyvTEPjrhKKEwKoVqlnLQt2h-0_YTR-zkp9aJAhRd7eIJ7aZnMQq6Ma2he5RRhrYEXjQ6oe2DH2mTuV49DehJm-669G64swVjqprLffG8wKOMSTpfgKkcyStalc55N_dTF698acl65Zw8mvgSt9-uEXVTzlHS33euxfwSMBfbgRaW4I1XWOsurUbZ3cTApr0S1JAEIsR8saY41Wf6YjdMrzr7Pi7sXZJYsgCAFsFaO_ND3l4Nuhplhh5iysqqZp"/>
<div>
<div class="bg-surface-container-lowest p-4 rounded-2xl rounded-tl-sm shadow-sm text-[0.875rem] text-on-surface font-body leading-relaxed">
                            Hi there! I saw your post about the silver watch. I think it might be mine. Does it have a small scratch near the 3 o'clock mark?
                        </div>
<span class="text-[0.75rem] font-label text-on-surface-variant mt-1 block ml-1">10:42 AM</span>
</div>
</div>
<!-- Sent Message -->
<div class="flex gap-4 max-w-[80%] self-end flex-row-reverse">
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-sm flex-shrink-0 mt-1">
                        Me
                    </div>
<div class="flex flex-col items-end">
<div class="bg-secondary text-on-secondary p-4 rounded-2xl rounded-tr-sm shadow-sm text-[0.875rem] font-body leading-relaxed">
                            Hello Sarah! Yes, it actually does. I'm pretty sure it's yours then. Where would be a good place to meet up to return it?
                        </div>
<div class="flex items-center gap-1 mt-1 mr-1">
<span class="text-[0.75rem] font-label text-on-surface-variant">10:45 AM</span>
<span class="material-symbols-outlined text-[14px] text-secondary">done_all</span>
</div>
</div>
</div>
<!-- Received Message (Current typing/recent) -->
<div class="flex gap-4 max-w-[80%]">
<img alt="Sarah Jenkins" class="w-8 h-8 rounded-full object-cover flex-shrink-0 mt-1" data-alt="close up portrait of a smiling young woman with bright natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_htUX_VLG9pc0Atza6eCxBU7bbMCn8wrMyCLlMUGDh-u5HFw0p_zP1lKzAZ2V5FzY3Vz4KeDV_raiczDmZDbBAreyT8J4FXCL5E6dfOn1R4x6p6qHbuCgmS2NBKgKE34JzZ2i6ErYY9Hrzpt9Eh5F-ZRKV-vwwnXuQlRkxUTYoV3Mbo94_FDFTFkyooFrPbkX2yGaArERnqmib1IXhgN4CWL5cGEOY1gItf-OabRDF9n_owWlUqx85t4KFHVtSa-UFK_48R4Ge5Hr"/>
<div>
<div class="bg-surface-container-lowest p-4 rounded-2xl rounded-tl-sm shadow-sm text-[0.875rem] text-on-surface font-body leading-relaxed">
                            That's amazing news! Yes, I found it near the park entrance. I can meet you later today.
                        </div>
<span class="text-[0.75rem] font-label text-on-surface-variant mt-1 block ml-1">2 mins ago</span>
</div>
</div>
</div>
<!-- Input Area -->
<div class="p-6 bg-surface-container-lowest border-t border-outline-variant/15 z-10 shadow-[0_-8px_32px_rgba(13,27,42,0.03)]">
<div class="max-w-4xl mx-auto bg-surface rounded-xl flex items-end p-2 gap-2 shadow-sm focus-within:ring-2 focus-within:ring-secondary/50 transition-all">
<button class="p-3 text-on-surface-variant hover:text-secondary rounded-full hover:bg-surface-container transition-colors shrink-0">
<span class="material-symbols-outlined">attach_file</span>
</button>
<textarea class="w-full bg-transparent border-none focus:ring-0 resize-none py-3 px-2 text-[0.875rem] font-body text-on-surface max-h-[120px] min-h-[48px]" placeholder="Type a message..." rows="1" style="scrollbar-width: thin;"></textarea>
<button class="p-3 bg-secondary text-on-secondary hover:bg-on-secondary-fixed-variant rounded-lg transition-colors shrink-0 flex items-center justify-center mb-0.5">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">send</span>
</button>
</div>
</div>
</section>
</main>
</body></html>