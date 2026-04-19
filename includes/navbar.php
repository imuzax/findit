<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl sticky top-0 z-50 w-full no-line-philosophy shadow-[0_8px_32px_rgba(13,27,42,0.06)]">
<div class="flex justify-between items-center max-w-7xl mx-auto px-8 h-20">
    <!-- Brand Logo -->
    <a class="text-2xl font-extrabold text-[#0D1B2A] dark:text-white font-['Inter'] tracking-tight" href="index.php">FindIt Azam Campus</a>
    <!-- Navigation Links -->
    <nav class="hidden md:flex items-center gap-8">
        <a class="<?= ($currentPage == 'index.php') ? 'text-[#0F7173] font-bold border-b-2 border-[#0F7173] pb-1' : 'text-slate-600 dark:text-slate-400 hover:text-[#0D1B2A] dark:hover:text-white transition-colors' ?> hover:bg-slate-100/50 hidden md:inline-block dark:hover:bg-slate-800/50 transition-all duration-200 active:scale-95 duration-150 font-['Inter'] tracking-tight" href="index.php">Home</a>
        
        <a class="<?= ($currentPage == 'browse.php') ? 'text-[#0F7173] font-bold border-b-2 border-[#0F7173] pb-1' : 'text-slate-600 dark:text-slate-400 hover:text-[#0D1B2A] dark:hover:text-white transition-colors' ?> hover:bg-slate-100/50 hidden md:inline-block dark:hover:bg-slate-800/50 transition-all duration-200 active:scale-95 duration-150 font-['Inter'] tracking-tight" href="browse.php">Browse Items</a>
        
        <?php if ($isLoggedIn): ?>
        <a class="<?= ($currentPage == 'dashboard.php') ? 'text-[#0F7173] font-bold border-b-2 border-[#0F7173] pb-1' : 'text-slate-600 dark:text-slate-400 hover:text-[#0D1B2A] dark:hover:text-white transition-colors' ?> hover:bg-slate-100/50 hidden md:inline-block dark:hover:bg-slate-800/50 transition-all duration-200 active:scale-95 duration-150 font-['Inter'] tracking-tight" href="dashboard.php">Dashboard</a>
        <?php endif; ?>
        
        <?php if ($isAdmin): ?>
        <a class="<?= ($currentPage == 'admin.php') ? 'text-[#0F7173] font-bold border-b-2 border-[#0F7173] pb-1' : 'text-slate-600 dark:text-slate-400 hover:text-[#0D1B2A] dark:hover:text-white transition-colors' ?> hover:bg-slate-100/50 hidden md:inline-block dark:hover:bg-slate-800/50 transition-all duration-200 active:scale-95 duration-150 font-['Inter'] tracking-tight" href="admin.php">Admin Panel</a>
        <?php endif; ?>
    </nav>
    <!-- Actions -->
    <div class="flex items-center gap-4">
        <?php if ($isLoggedIn): ?>
            <span class="text-[#0D1B2A] font-['Inter'] font-semibold tracking-tight mr-2 hidden sm:inline-block">Hi, <?= htmlspecialchars($_SESSION['full_name'] ?? 'User') ?></span>
            <a class="text-rose-600 font-['Inter'] font-bold tracking-tight hover:bg-rose-50 px-4 py-2 rounded-DEFAULT transition-all duration-200 active:scale-95 duration-150" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="text-[#0D1B2A] dark:text-slate-100 font-['Inter'] font-bold tracking-tight hover:bg-slate-100/50 dark:hover:bg-slate-800/50 px-4 py-2 rounded-DEFAULT transition-all duration-200 active:scale-95 duration-150" href="auth.php">Login / Sign Up</a>
        <?php endif; ?>
        <a class="bg-[#F4A261] text-primary-container hover:opacity-90 transition-all px-4 py-2.5 rounded-DEFAULT font-['Inter'] font-bold tracking-tight shadow-md flex items-center gap-1" href="post-lost.php">
            <span class="material-symbols-outlined" style="font-size: 20px;">search</span> Lost
        </a>
        <a class="bg-[#0F7173] text-white hover:opacity-90 transition-all px-4 py-2.5 rounded-DEFAULT font-['Inter'] font-bold tracking-tight shadow-md flex items-center gap-1" href="post-found.php">
            <span class="material-symbols-outlined" style="font-size: 20px;">volunteer_activism</span> Found
        </a>
    </div>
</div>
</header>
