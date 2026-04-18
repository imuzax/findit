<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - User Profile</title>
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background font-body min-h-screen flex flex-col">
<!-- TopNavBar Shared Component -->
<?php include 'includes/navbar.php'; ?>
<!-- Main Content Canvas -->
<main class="flex-1 w-full pb-24">
<!-- Navy Gradient Cover Banner -->
<section class="w-full h-[280px] md:h-[360px] bg-gradient-to-br from-primary-container via-[#162942] to-primary relative overflow-hidden" data-alt="smooth gradient flowing from deep navy to subtle dark teal with soft grain texture">
<!-- Decorative glass flare -->
<div class="absolute -top-24 -right-24 w-96 h-96 bg-secondary opacity-20 blur-[80px] rounded-full"></div>
<div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-background to-transparent opacity-90"></div>
</section>
<!-- Profile Info Layering (Asymmetrical High-End Layout) -->
<section class="max-w-7xl mx-auto px-6 md:px-12 -mt-24 relative z-10">
<div class="flex flex-col md:flex-row items-end md:items-end gap-6 md:gap-10">
<!-- Circular Avatar -->
<div class="relative group">
<div class="w-40 h-40 md:w-48 md:h-48 rounded-full border-[6px] border-surface-container-lowest bg-surface-container-high shadow-[0_8px_32px_rgba(13,27,42,0.08)] overflow-hidden flex-shrink-0">
<img alt="User Avatar" class="w-full h-full object-cover" data-alt="portrait of a smiling young woman with natural lighting and soft blurred background in warm tones" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC5_OkTXRLN30ykUqvRsibBYHd0Jc8Mm5FFzDUj1coixdxLm0qWe1NgCaHiVY3U9nnMrRUoVOencoF1UBKC3WkTjs-HO8iBXknT6BuPJA8lTpqXAThTVOAuK20hk7dnYj-oCc-H6AX7OJdyh5K6DLXH_WXd6YMCMbQIcRrwv5ju6-WV-6eY6xRDtm1BtQLObojYfuJoodITDpcTHT6h7gRisTMRnUuSgR9O2vKdPaxiNXQAR680IZJ5koZA0T5jIQkVeaesDhLr5Pqr"/>
</div>
<!-- Status Indicator -->
<div class="absolute bottom-4 right-4 w-6 h-6 bg-secondary border-4 border-surface-container-lowest rounded-full"></div>
</div>
<!-- User Meta & Badges -->
<div class="flex-1 pb-4 md:pb-6">
<div class="flex flex-wrap items-center gap-4 mb-2">
<h1 class="text-4xl md:text-[3.5rem] font-headline font-extrabold tracking-tight text-on-surface leading-none">Sarah Jenkins</h1>
<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-secondary/10 text-secondary rounded-full font-label text-xs font-bold uppercase tracking-wider">
<span class="material-symbols-outlined text-[14px]" data-icon="verified" data-weight="fill" style="font-variation-settings: 'FILL' 1;">verified</span>
                            Trusted Finder
                        </span>
<span class="inline-flex items-center gap-1.5 px-3 py-1 bg-surface-container-highest text-on-surface-variant rounded-full font-label text-xs font-bold uppercase tracking-wider">
<span class="material-symbols-outlined text-[14px]" data-icon="local_fire_department">local_fire_department</span>
                            24 Returns
                        </span>
</div>
<p class="text-on-surface-variant font-body text-base md:text-lg max-w-2xl leading-relaxed mt-4">
                        Community volunteer and digital concierge. Helping reunite people with their lost valuables across the Pacific Northwest since 2022.
                    </p>
</div>
<!-- Action -->
<div class="pb-4 md:pb-6 flex-shrink-0">
<button class="px-6 py-3 bg-surface-container-lowest text-primary border border-outline-variant/30 rounded shadow-[0_4px_16px_rgba(13,27,42,0.04)] font-label font-bold text-sm hover:bg-surface-container transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-lg" data-icon="mail">mail</span>
                        Message
                    </button>
</div>
</div>
</section>
<!-- Content Area -->
<section class="max-w-7xl mx-auto px-6 md:px-12 mt-16">
<!-- Tabs (Pill style category chips) -->
<div class="flex flex-wrap items-center gap-3 mb-12">
<button class="px-5 py-2.5 bg-primary text-on-primary rounded-full font-label font-bold text-sm tracking-wide shadow-sm">
                    Activity
                </button>
<button class="px-5 py-2.5 bg-surface-container-high text-on-surface-variant rounded-full font-label font-bold text-sm tracking-wide hover:bg-surface-container-highest transition-colors">
                    Lost Posts (3)
                </button>
<button class="px-5 py-2.5 bg-surface-container-high text-on-surface-variant rounded-full font-label font-bold text-sm tracking-wide hover:bg-surface-container-highest transition-colors">
                    Found Posts (18)
                </button>
</div>
<!-- Grid Layout (Bento style, no 1px borders) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Item Card 1: Found -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_8px_32px_rgba(13,27,42,0.04)] border-l-4 border-secondary flex flex-col group hover:-translate-y-1 transition-transform duration-300">
<div class="flex justify-between items-start mb-4">
<span class="inline-flex items-center gap-1.5 text-secondary font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-sm" data-icon="check_circle">check_circle</span>
                            I Found This
                        </span>
<span class="text-on-surface-variant text-xs font-label font-semibold">2h ago</span>
</div>
<div class="w-full h-48 bg-surface-container rounded-lg mb-6 overflow-hidden relative">
<img alt="Found Keys" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="close up of metallic house keys on a wooden park bench with dappled sunlight and green foliage in background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQaSQMRqKxEwbtaVlybwz8fV2otMaA9plEC1Fkh4U-1EVL0uhYHN8gNufEze1e8EbTeFxbmttV0V6htHhZyKGaEwcFXP0SsQiVHixRMJMMHklJGZWVo7KbrcsCFH5Ee0BOvJCBAPOOaTSi1ibNzjbV0vuvXXkUmExx4mjfMkp4JAdQaTuv8QAORnfV_zwLI3rRrzEyuwn8fA3uAmX2aMFTubHj4xwb74wD2e1fRCPQnJy85GG2tl0MHrti_IZUSgbXCg2yNLfHIONM"/>
<div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1.5 rounded text-xs font-label font-bold text-primary shadow-sm flex items-center gap-1.5">
<span class="material-symbols-outlined text-[14px]" data-icon="location_on">location_on</span>
                            Centennial Park
                        </div>
</div>
<h3 class="font-headline font-semibold text-lg text-on-surface mb-2 leading-tight">Silver House Keys with Red Lanyard</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed line-clamp-2">
                        Found a set of 3 silver keys attached to a bright red Supreme lanyard near the north entrance water fountain.
                    </p>
</div>
<!-- Item Card 2: Lost -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-[0_8px_32px_rgba(13,27,42,0.04)] border-l-4 border-on-tertiary-container flex flex-col group hover:-translate-y-1 transition-transform duration-300">
<div class="flex justify-between items-start mb-4">
<span class="inline-flex items-center gap-1.5 text-on-tertiary-container font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-sm" data-icon="search">search</span>
                            Lost Item
                        </span>
<span class="text-on-surface-variant text-xs font-label font-semibold">Yesterday</span>
</div>
<div class="w-full h-48 bg-surface-container rounded-lg mb-6 overflow-hidden relative">
<img alt="Lost Headphones" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="pair of premium black over-ear wireless headphones resting cleanly against a soft neutral background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_hmky5rRH1ogGvPkfp76OwINlySdCRiG0N0cFZBS6_4-l5qnw-Rg7C5tbsrfGgU73EQmbvsm2SL5dqomFFHq1tHz07WDMHB1uekxb2kN6N1Zd5Xs3E7dqHxKKkWgOffEacB7JXAXs43UeSaGT0sJ-teRvG_C6COvx4cTZx5fzFfJWszBMcs3iSWN1eRwefdipxHKlcrKvBKGjqs_H-DJ5xttZDE0s1ouxMUhSe53IdVdRGosJHIFxSXfXJshMS9ifZahP3kasAE7b"/>
<div class="absolute bottom-3 left-3 bg-surface-container-lowest/90 backdrop-blur-md px-3 py-1.5 rounded text-xs font-label font-bold text-primary shadow-sm flex items-center gap-1.5">
<span class="material-symbols-outlined text-[14px]" data-icon="location_on">location_on</span>
                            Downtown Transit
                        </div>
</div>
<h3 class="font-headline font-semibold text-lg text-on-surface mb-2 leading-tight">Sony WH-1000XM4 Headphones</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed line-clamp-2">
                        Left my black noise-canceling headphones on the 42 bus going southbound around 3 PM. Has a small scratch on the right earcup.
                    </p>
</div>
<!-- Item Card 3: Found & Returned (Special State) -->
<div class="bg-surface-container-low rounded-xl p-6 flex flex-col relative overflow-hidden group">
<div class="absolute inset-0 bg-white/40 backdrop-blur-[2px] z-10 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<span class="material-symbols-outlined text-4xl text-secondary mb-2" data-icon="handshake" data-weight="fill" style="font-variation-settings: 'FILL' 1;">handshake</span>
<span class="font-headline font-bold text-primary text-lg">Successfully Returned</span>
</div>
<div class="flex justify-between items-start mb-4 opacity-70">
<span class="inline-flex items-center gap-1.5 text-secondary font-label font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-sm" data-icon="check_circle">check_circle</span>
                            Returned
                        </span>
<span class="text-on-surface-variant text-xs font-label font-semibold">Oct 12</span>
</div>
<div class="w-full h-48 bg-surface-variant rounded-lg mb-6 overflow-hidden relative opacity-70 grayscale-[30%]">
<img alt="Returned Wallet" class="w-full h-full object-cover" data-alt="brown leather bi-fold men's wallet sitting on a clean coffee shop table next to a blurry espresso cup" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAY309j8nWN43B1O0AnkKwq-4Zn_bLWkZgvaMbhDmcBwosFIxqfrV-h8FllQW1lLmPeHD1hFd9RmOrtQM93zV6Z9vJTcWurYf6qinUnwGo_faEwcqimEWiXzE51aLiYJfqHLkulpcNj1Q_VCnfMD7W8HVFjyc3YKoNQjfKUUANY2OCKjI0ngZMN_OtBhl5xxL-XAGZpTASwE6TdoGlYgkyEHYtht4GiULDD2erT5iO8p69ox3ISMtTeb0J1z6AUx9cZsM65zxN2NIru"/>
</div>
<h3 class="font-headline font-semibold text-lg text-on-surface/70 mb-2 leading-tight">Brown Leather Wallet</h3>
<p class="font-body text-sm text-on-surface-variant/70 leading-relaxed line-clamp-2">
                        Found at Elm Street Cafe. Owner verified via ID and returned the same day.
                    </p>
</div>
</div>
</section>
</main>
<!-- Footer Shared Component -->
<?php include 'includes/footer.php'; ?>
</body></html>