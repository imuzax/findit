<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Digital Concierge</title>
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
<link rel="stylesheet" href="assets/css/smooth.css">
<script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background font-body antialiased selection:bg-secondary selection:text-on-secondary">
<!-- TopNavBar (Shared Component) -->
<?php include 'includes/navbar.php'; ?>
<main>
<!-- Hero Section -->
<section class="relative pt-24 pb-32 px-8 overflow-hidden bg-primary-container text-on-primary">
<div class="absolute inset-0 bg-gradient-to-br from-primary to-primary-container opacity-90 z-0 pointer-events-none"></div>
<!-- Abstract decorative elements -->
<div class="absolute top-1/4 -left-20 w-96 h-96 bg-secondary/20 rounded-full blur-3xl z-0 pointer-events-none"></div>
<div class="absolute bottom-0 right-10 w-80 h-80 bg-[#F4A261]/10 rounded-full blur-3xl z-0 pointer-events-none"></div>
<div class="relative z-10 max-w-5xl mx-auto flex flex-col items-center text-center">
<h1 class="text-[3.5rem] font-extrabold font-headline leading-[1.1] tracking-[-0.02em] mb-6 text-on-primary">
                    Lost Something? Found Something?<br/>
<span class="text-secondary-fixed">We Connect People.</span>
</h1>
<p class="text-[1.125rem] font-body text-primary-fixed-dim max-w-2xl mb-12 leading-[1.6]">
                    Your community's digital concierge. A trusted platform to report lost belongings or reunite found items with their rightful owners safely and securely.
                </p>
<div class="flex flex-col sm:flex-row gap-4 mb-20 w-full sm:w-auto">
<a href="post-lost.php?type=lost" class="bg-[#F4A261] hover:bg-[#e09252] text-primary-container font-label font-bold text-[0.875rem] py-4 px-8 rounded-DEFAULT transition-all shadow-[0_8px_24px_rgba(244,162,97,0.3)] min-w-[200px]" style="display:inline-block;text-align:center;">I Lost Something</a>
<a href="post-lost.php?type=found" class="bg-secondary hover:bg-[#005a5c] text-on-secondary font-label font-bold text-[0.875rem] py-4 px-8 rounded-DEFAULT transition-all shadow-[0_8px_24px_rgba(0,105,107,0.3)] min-w-[200px]" style="display:inline-block;text-align:center;">I Found Something</a>
</div>
<!-- Stats Bar -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-16 pt-8 border-t border-primary-fixed-dim/20 w-full max-w-3xl">
<div class="flex flex-col items-center">
<span class="text-3xl font-bold font-headline text-on-primary mb-1">12,400+</span>
<span class="text-sm font-label text-primary-fixed-dim uppercase tracking-wider">Items Found</span>
</div>
<div class="flex flex-col items-center">
<span class="text-3xl font-bold font-headline text-on-primary mb-1">98%</span>
<span class="text-sm font-label text-primary-fixed-dim uppercase tracking-wider">Return Rate</span>
</div>
<div class="flex flex-col items-center">
<span class="text-3xl font-bold font-headline text-on-primary mb-1">500+</span>
<span class="text-sm font-label text-primary-fixed-dim uppercase tracking-wider">Active Communities</span>
</div>
</div>
</div>
</section>
<!-- Live Search Bar (Floated over transition) -->
<div class="max-w-4xl mx-auto px-8 -mt-10 relative z-20">
<div class="bg-surface-container-lowest rounded-xl shadow-[0_8px_32px_rgba(13,27,42,0.06)] p-4 flex flex-col md:flex-row gap-4 items-center">
<div class="flex-1 flex items-center bg-surface-container-low rounded-DEFAULT px-4 py-3 w-full">
<span class="material-symbols-outlined text-outline mr-3">search</span>
<input class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body placeholder-outline outline-none" placeholder="What are you looking for?" type="text"/>
</div>
<div class="w-full md:w-48 flex items-center bg-surface-container-low rounded-DEFAULT px-4 py-3">
<span class="material-symbols-outlined text-outline mr-3">category</span>
<select class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body outline-none appearance-none cursor-pointer">
<option>All Categories</option>
<option>Electronics</option>
<option>Pets</option>
<option>Accessories</option>
</select>
</div>
<div class="w-full md:w-56 flex items-center bg-surface-container-low rounded-DEFAULT px-4 py-3">
<span class="material-symbols-outlined text-outline mr-3">location_on</span>
<input class="bg-transparent border-none focus:ring-0 w-full text-on-surface font-body placeholder-outline outline-none" placeholder="Location..." type="text"/>
</div>
<button class="w-full md:w-auto bg-primary-container text-on-primary px-8 py-3 rounded-DEFAULT font-label font-bold hover:bg-primary-container/90 transition-colors shrink-0">
                    Search
                </button>
</div>
</div>
<!-- Recent Listings Grid -->
<section class="py-24 px-8 max-w-7xl mx-auto bg-surface">
<div class="flex justify-between items-end mb-16">
<div>
<h2 class="text-[2rem] font-bold font-headline text-on-surface mb-2">Recent Reports</h2>
<p class="text-[0.875rem] font-body text-on-surface-variant">Browse the latest lost and found items in your area.</p>
</div>
<a class="hidden sm:flex items-center text-secondary font-label font-bold text-sm hover:text-[#004f51] transition-colors" href="#">
                    View All Items
                    <span class="material-symbols-outlined ml-1 text-[18px]">arrow_forward</span>
</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Card 1 (Lost) -->
<div class="bg-surface-container-lowest rounded-xl p-6 relative overflow-hidden group cursor-pointer hover:shadow-[0_8px_32px_rgba(13,27,42,0.06)] transition-all duration-300">
<!-- Accent Line -->
<div class="absolute left-0 top-0 bottom-0 w-1 bg-[#F4A261]"></div>
<div class="flex justify-between items-start mb-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-label bg-[#F4A261]/10 text-[#F4A261]">
<span class="material-symbols-outlined text-[14px] mr-1">campaign</span>
                            LOST
                        </span>
<span class="text-xs font-body text-outline">2 hours ago</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Golden Retriever "Max"</h3>
<div class="flex items-center text-on-surface-variant text-sm font-body mb-4">
<span class="material-symbols-outlined text-[16px] mr-1.5">location_on</span>
                        Central Park, near 72nd St entrance
                    </div>
<div class="aspect-video w-full rounded-lg bg-surface-container-low mb-4 overflow-hidden relative">
<img alt="Golden Retriever dog looking attentive outdoors in a park setting with soft natural lighting" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Golden Retriever dog looking attentive outdoors in a park setting with soft natural lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDggmTya_FPiPsRU7jxukaC_7hQw-2IJAKhRVtS-PEVicz_HtZ4xxTfH13kz9fKoukSf-5G65UD4f7NYeB782HjnidyIyClgXoGuOnZxnJpO3UJHJCv3NKpxujROlYcUHBqEWIswmoLj3Nh_VStLtbvgQfBh4WXPHeH2cqKHcf38PNGGEHhCmVvL63oeEvfyJ6Y0q3cdTWdoliKoSjdAu3TqXxnHTWopVU7IPkb1_hLXLAir38oS8LIKOcz7iyennhQ4QgdScSnR9ES"/>
</div>
<p class="text-[0.875rem] font-body text-on-surface-variant mb-6 line-clamp-2">
                        Friendly male Golden Retriever, wearing a blue collar with tags. Wandered off around 2 PM. Very food motivated.
                    </p>
<a href="item-detail.php" class="w-full bg-surface-container text-on-surface font-label font-bold text-sm py-2.5 rounded-DEFAULT hover:bg-surface-container-high transition-colors" style="display:inline-block;text-align:center;">View Details</a>
</div>
<!-- Card 2 (Found) -->
<div class="bg-surface-container-lowest rounded-xl p-6 relative overflow-hidden group cursor-pointer hover:shadow-[0_8px_32px_rgba(13,27,42,0.06)] transition-all duration-300">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary"></div>
<div class="flex justify-between items-start mb-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-label bg-secondary/10 text-secondary">
<span class="material-symbols-outlined text-[14px] mr-1">check_circle</span>
                            FOUND
                        </span>
<span class="text-xs font-body text-outline">5 hours ago</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Black Leather Wallet</h3>
<div class="flex items-center text-on-surface-variant text-sm font-body mb-4">
<span class="material-symbols-outlined text-[16px] mr-1.5">location_on</span>
                        Downtown Metro Station, Platform 2
                    </div>
<div class="aspect-video w-full rounded-lg bg-surface-container-low mb-4 overflow-hidden flex items-center justify-center">
<span class="material-symbols-outlined text-[48px] text-outline opacity-50">account_balance_wallet</span>
</div>
<p class="text-[0.875rem] font-body text-on-surface-variant mb-6 line-clamp-2">
                        Found a black leather men's bi-fold wallet on the bench. Contains some cash and ID cards. Turned in to station security.
                    </p>
<a href="item-detail.php" class="w-full bg-surface-container text-on-surface font-label font-bold text-sm py-2.5 rounded-DEFAULT hover:bg-surface-container-high transition-colors" style="display:inline-block;text-align:center;">View Details</a>
</div>
<!-- Card 3 (Lost) -->
<div class="bg-surface-container-lowest rounded-xl p-6 relative overflow-hidden group cursor-pointer hover:shadow-[0_8px_32px_rgba(13,27,42,0.06)] transition-all duration-300">
<div class="absolute left-0 top-0 bottom-0 w-1 bg-[#F4A261]"></div>
<div class="flex justify-between items-start mb-4">
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold font-label bg-[#F4A261]/10 text-[#F4A261]">
<span class="material-symbols-outlined text-[14px] mr-1">campaign</span>
                            LOST
                        </span>
<span class="text-xs font-body text-outline">1 day ago</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Silver MacBook Pro</h3>
<div class="flex items-center text-on-surface-variant text-sm font-body mb-4">
<span class="material-symbols-outlined text-[16px] mr-1.5">location_on</span>
                        University Library, 3rd Floor
                    </div>
<div class="aspect-video w-full rounded-lg bg-surface-container-low mb-4 overflow-hidden relative">
<img alt="Silver Apple MacBook laptop sitting open on a wooden desk in a well-lit modern workspace" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Silver Apple MacBook laptop sitting open on a wooden desk in a well-lit modern workspace" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpQvPTHLyo4HDnc7ssCBhZAYMCUd0wbrd6VpXI3K5xEtn2qJq1t8605cSGNCKVqYMyqE2aCNk4jNj-AHbx9xxvHgncOkWDW55SEaGKofbt_diHgGKQI7gXNbGb14jlBJdL13m40ZM2DuIgGCuVKc4-ABF8JgDRkOT9xbz1G8B05gd9rqpDn1wamlyrSX0AoVFnTqnUsitTGmNXdsME6qI-zWPhlVgleIVPeEeKJijH75-JqVQ1NTOh3amI9I_Yjtoh327umYIVeANv"/>
</div>
<p class="text-[0.875rem] font-body text-on-surface-variant mb-6 line-clamp-2">
                        Left my 14-inch MacBook Pro on a desk near the windows. It has a distinctive sticker of a rocket ship on the back.
                    </p>
<a href="item-detail.php" class="w-full bg-surface-container text-on-surface font-label font-bold text-sm py-2.5 rounded-DEFAULT hover:bg-surface-container-high transition-colors" style="display:inline-block;text-align:center;">View Details</a>
</div>
</div>
<div class="mt-12 text-center sm:hidden">
<a href="browse.php" class="bg-surface-container text-on-surface font-label font-bold text-sm py-3 px-8 rounded-DEFAULT hover:bg-surface-container-high transition-colors" style="display:inline-block;text-align:center;">View All Items</a>
</div>
</section>
<!-- How It Works Section -->
<section class="py-24 px-8 bg-surface-container-low">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-16">
<h2 class="text-[2rem] font-bold font-headline text-on-surface mb-4">How FindIt Works</h2>
<p class="text-[1.125rem] font-body text-on-surface-variant max-w-2xl mx-auto">A simple, secure process to connect lost items with their owners.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
<!-- Connecting Line (hidden on mobile) -->
<div class="hidden md:block absolute top-12 left-[10%] right-[10%] h-0.5 bg-outline-variant/30 z-0"></div>
<!-- Step 1 -->
<div class="relative z-10 flex flex-col items-center text-center">
<div class="w-24 h-24 bg-surface-container-lowest rounded-full flex items-center justify-center mb-6 shadow-[0_4px_16px_rgba(13,27,42,0.04)] relative">
<span class="absolute -top-2 -right-2 w-8 h-8 bg-primary-container text-on-primary rounded-full flex items-center justify-center font-label font-bold text-sm">1</span>
<span class="material-symbols-outlined text-[40px] text-primary-container">post_add</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Create a Report</h3>
<p class="text-[0.875rem] font-body text-on-surface-variant">Provide details, location, and photos of the lost or found item.</p>
</div>
<!-- Step 2 -->
<div class="relative z-10 flex flex-col items-center text-center">
<div class="w-24 h-24 bg-surface-container-lowest rounded-full flex items-center justify-center mb-6 shadow-[0_4px_16px_rgba(13,27,42,0.04)] relative">
<span class="absolute -top-2 -right-2 w-8 h-8 bg-primary-container text-on-primary rounded-full flex items-center justify-center font-label font-bold text-sm">2</span>
<span class="material-symbols-outlined text-[40px] text-primary-container">manage_search</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Smart Matching</h3>
<p class="text-[0.875rem] font-body text-on-surface-variant">Our system scans descriptions and locations to find potential matches.</p>
</div>
<!-- Step 3 -->
<div class="relative z-10 flex flex-col items-center text-center">
<div class="w-24 h-24 bg-surface-container-lowest rounded-full flex items-center justify-center mb-6 shadow-[0_4px_16px_rgba(13,27,42,0.04)] relative">
<span class="absolute -top-2 -right-2 w-8 h-8 bg-primary-container text-on-primary rounded-full flex items-center justify-center font-label font-bold text-sm">3</span>
<span class="material-symbols-outlined text-[40px] text-primary-container">chat_bubble</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Connect Securely</h3>
<p class="text-[0.875rem] font-body text-on-surface-variant">Use our private messaging system to verify details without sharing personal info.</p>
</div>
<!-- Step 4 -->
<div class="relative z-10 flex flex-col items-center text-center">
<div class="w-24 h-24 bg-surface-container-lowest rounded-full flex items-center justify-center mb-6 shadow-[0_4px_16px_rgba(13,27,42,0.04)] relative">
<span class="absolute -top-2 -right-2 w-8 h-8 bg-secondary text-on-secondary rounded-full flex items-center justify-center font-label font-bold text-sm">4</span>
<span class="material-symbols-outlined text-[40px] text-secondary">handshake</span>
</div>
<h3 class="text-[1.125rem] font-semibold font-headline text-on-surface mb-2">Reunite</h3>
<p class="text-[0.875rem] font-body text-on-surface-variant">Meet in a safe, public location to return the item to its owner.</p>
</div>
</div>
</div>
</section>
</main>
<!-- Footer (Shared Component) -->
<?php include 'includes/footer.php'; ?>
</body></html>