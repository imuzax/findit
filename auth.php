<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>FindIt - Login &amp; Registration</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
<body class="bg-background font-body text-on-background min-h-screen flex">
<!-- Split Screen Layout -->
<div class="flex w-full h-screen overflow-hidden">
<!-- Left Navy Panel - Branding (Hidden on mobile) -->
<div class="hidden lg:flex w-1/2 bg-[#0D1B2A] relative flex-col justify-between p-16 overflow-hidden">
<!-- Decorative Elements -->
<div class="absolute inset-0 opacity-20 bg-gradient-to-br from-[#0f1c2c] to-[#0D1B2A]"></div>
<div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] rounded-full bg-secondary opacity-5 blur-3xl"></div>
<div class="relative z-10">
<h1 class="font-headline font-extrabold text-on-primary text-4xl tracking-tight mb-2">FindIt</h1>
<p class="font-body text-inverse-primary text-lg font-medium">Digital Concierge</p>
</div>
<div class="relative z-10 max-w-md">
<h2 class="font-headline font-extrabold text-on-primary text-[3.5rem] leading-[1.1] tracking-[-0.02em] mb-6">
                    Community reassurance, elevated.
                </h2>
<p class="font-body text-inverse-primary text-lg leading-relaxed opacity-80">
                    A curated lost-and-found experience designed to foster trust and connect communities through premium visual execution.
                </p>
</div>
<div class="relative z-10 flex gap-4">
<div class="w-2 h-2 rounded-full bg-on-primary opacity-100"></div>
<div class="w-2 h-2 rounded-full bg-on-primary opacity-30"></div>
<div class="w-2 h-2 rounded-full bg-on-primary opacity-30"></div>
</div>
<!-- Abstract Background Image -->
<img alt="" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-30 pointer-events-none" data-alt="abstract flowing glass-like shapes in dark navy tones with subtle teal edge lighting creating a premium digital aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuABImZCu2vHnqZohARIPyuVK1nNn91TJmNwd4HSLdkJn63GuemeYhcew_55lfKJ9R3aeq0vm1zltdQZposV3n3lXNch2w05OFYEN9yASOUu19--7EhjvBL8VlpVfZfj1VZXDupaWKG0Teu6PfyRZkAxPHtTOrLrmcONiGCQ1lHb0-nDDUk1hVKEQcBVSJ_3TUALeE6zONUOE0NIlfXExjtgzMK563Cy5VQz9etnoEchwfyE3us69lGg85tlkpFp7KnisgLr0uUXvqBq"/>
</div>
<!-- Right White Form Panel -->
<div class="w-full lg:w-1/2 bg-surface-container-lowest flex flex-col justify-center items-center p-8 sm:p-16 relative overflow-y-auto">
<!-- Mobile Brand Header (Visible only on mobile) -->
<div class="lg:hidden absolute top-8 left-8">
<h1 class="font-headline font-extrabold text-[#0D1B2A] text-2xl tracking-tight">FindIt</h1>
</div>
<div class="w-full max-w-md mt-16 lg:mt-0">
<!-- Header -->
<div class="mb-10 text-center">
<h2 class="font-headline font-bold text-[#0D1B2A] text-3xl tracking-tight mb-3" id="form-title">Welcome back</h2>
<p class="font-body text-on-surface-variant text-base" id="form-subtitle">Please enter your details to sign in.</p>
</div>

<!-- Error/Success Message Box -->
<div id="msg-box" class="hidden w-full mb-6 p-4 rounded-md text-sm font-semibold text-center mt-2"></div>

<!-- Tabbed Interface -->
<div class="flex gap-8 mb-8 border-b border-outline-variant/30 relative">
<button id="tab-login" class="font-label font-semibold text-[#0F7173] text-sm pb-3 relative transition-colors focus:outline-none" onclick="toggleAuth('login')">
    Login
    <div id="indicator-login" class="absolute bottom-0 left-0 w-full h-[2px] bg-[#0F7173]"></div>
</button>
<button id="tab-register" class="font-label font-medium text-on-surface-variant text-sm pb-3 hover:text-on-background transition-colors focus:outline-none" onclick="toggleAuth('register')">
    Register
    <div id="indicator-register" class="hidden absolute bottom-0 left-0 w-full h-[2px] bg-[#0F7173]"></div>
</button>
</div>

<!-- Login Form -->
<form id="login-form" class="flex flex-col gap-6" onsubmit="handleLogin(event)">
<div class="flex flex-col gap-2">
<label class="font-label font-semibold text-on-background text-sm" for="login-email">Email Address</label>
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="login-email" name="email" placeholder="Enter your email" type="email" required/>
</div>
<div class="flex flex-col gap-2">
<div class="flex justify-between items-center">
<label class="font-label font-semibold text-on-background text-sm" for="login-password">Password</label>
</div>
<div class="relative">
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="login-password" name="password" placeholder="••••••••" type="password" required/>
</div>
</div>
<button id="login-btn" class="w-full bg-[#0D1B2A] text-white font-label font-semibold text-sm py-4 rounded-DEFAULT hover:bg-[#0f1c2c] transition-colors mt-2 shadow-[0_8px_32px_rgba(13,27,42,0.12)]" type="submit">
    Sign In
</button>
</form>

<!-- Register Form (Hidden by default) -->
<form id="register-form" class="hidden flex flex-col gap-6" onsubmit="handleRegister(event)">
<div class="flex flex-col gap-2">
<label class="font-label font-semibold text-on-background text-sm" for="reg-name">Full Name</label>
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="reg-name" name="full_name" placeholder="John Doe" type="text" required/>
</div>
<div class="flex flex-col gap-2">
<label class="font-label font-semibold text-on-background text-sm" for="reg-email">Email Address</label>
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="reg-email" name="email" placeholder="john@example.com" type="email" required/>
</div>
<div class="flex flex-col gap-2">
<label class="font-label font-semibold text-on-background text-sm" for="reg-phone">Phone Number</label>
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="reg-phone" name="phone" placeholder="0987654321" type="text"/>
</div>
<div class="flex flex-col gap-2">
<label class="font-label font-semibold text-on-background text-sm" for="reg-password">Password (Min 6 chars)</label>
<input class="w-full bg-surface-container-lowest border border-outline-variant/50 rounded-DEFAULT px-4 py-3 font-body text-base text-on-background focus:outline-none focus:ring-2 focus:ring-[#0F7173] focus:border-transparent transition-shadow placeholder:text-on-surface-variant/50 shadow-sm" id="reg-password" name="password" placeholder="••••••••" type="password" required minlength="6"/>
</div>
<button id="register-btn" class="w-full bg-[#0F7173] text-white font-label font-semibold text-sm py-4 rounded-DEFAULT hover:bg-[#066e70] transition-colors mt-2 shadow-[0_8px_32px_rgba(13,27,42,0.12)]" type="submit">
    Create Account
</button>
</form>

<script>
function toggleAuth(type) {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');
    const indLogin = document.getElementById('indicator-login');
    const indRegister = document.getElementById('indicator-register');
    const msgBox = document.getElementById('msg-box');
    
    msgBox.classList.add('hidden');

    if (type === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        
        tabLogin.classList.replace('text-on-surface-variant', 'text-[#0F7173]');
        tabLogin.classList.replace('font-medium', 'font-semibold');
        indLogin.classList.remove('hidden');
        
        tabRegister.classList.replace('text-[#0F7173]', 'text-on-surface-variant');
        tabRegister.classList.replace('font-semibold', 'font-medium');
        indRegister.classList.add('hidden');
        
        document.getElementById('form-title').innerText = "Welcome back";
        document.getElementById('form-subtitle').innerText = "Please enter your details to sign in.";
    } else {
        registerForm.classList.remove('hidden');
        loginForm.classList.add('hidden');
        
        tabRegister.classList.replace('text-on-surface-variant', 'text-[#0F7173]');
        tabRegister.classList.replace('font-medium', 'font-semibold');
        indRegister.classList.remove('hidden');
        
        tabLogin.classList.replace('text-[#0F7173]', 'text-on-surface-variant');
        tabLogin.classList.replace('font-semibold', 'font-medium');
        indLogin.classList.add('hidden');
        
        document.getElementById('form-title').innerText = "Create an account";
        document.getElementById('form-subtitle').innerText = "Join the community to post and search items.";
    }
}

function showMessage(type, text) {
    const msgBox = document.getElementById('msg-box');
    msgBox.classList.remove('hidden', 'bg-error-container', 'text-on-error-container', 'bg-secondary-container', 'text-on-secondary-container');
    
    if (type === 'error') {
        msgBox.classList.add('bg-error-container', 'text-on-error-container');
    } else {
        msgBox.classList.add('bg-secondary-container', 'text-on-secondary-container');
    }
    msgBox.innerText = text;
}

async function handleLogin(e) {
    e.preventDefault();
    const btn = document.getElementById('login-btn');
    btn.disabled = true;
    btn.innerText = "Signing in...";
    
    const formData = new FormData(e.target);
    try {
        const response = await fetch('api/login.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', "Login successful! Redirecting...");
            setTimeout(() => window.location.href = 'index.php', 1000);
        } else {
            showMessage('error', data.message || "Login failed");
            btn.disabled = false;
            btn.innerText = "Sign In";
        }
    } catch (err) {
        showMessage('error', "Network error or invalid server response");
        btn.disabled = false;
        btn.innerText = "Sign In";
    }
}

async function handleRegister(e) {
    e.preventDefault();
    const btn = document.getElementById('register-btn');
    btn.disabled = true;
    btn.innerText = "Creating account...";
    
    const formData = new FormData(e.target);
    try {
        const response = await fetch('api/register.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();
        
        if (data.success) {
            showMessage('success', "Registration successful! Signing you in...");
            setTimeout(() => window.location.href = 'index.php', 1500);
        } else {
            showMessage('error', data.message || "Registration failed");
            btn.disabled = false;
            btn.innerText = "Create Account";
        }
    } catch (err) {
        showMessage('error', "Network error or invalid server response");
        btn.disabled = false;
        btn.innerText = "Create Account";
    }
}
</script>
</div>
</div>
</div>
</body></html>