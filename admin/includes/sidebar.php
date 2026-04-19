<aside class="w-64 bg-[#0D1B2A] text-white h-screen fixed left-0 top-0 flex flex-col p-6 shadow-2xl z-50">
    <div class="mb-10">
        <h1 class="text-2xl font-black tracking-tighter text-white">FindIt <span class="text-[#0F7173]">Admin</span></h1>
        <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Management Suite</p>
    </div>

    <nav class="flex-1 space-y-2">
        <a href="dashboard.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition-all <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-[#0F7173] text-white' : 'text-slate-400' ?>">
            <span class="material-symbols-outlined text-sm">dashboard</span>
            <span class="text-sm font-bold">Dashboard</span>
        </a>
        <a href="users.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition-all <?= basename($_SERVER['PHP_SELF']) == 'users.php' ? 'bg-[#0F7173] text-white' : 'text-slate-400' ?>">
            <span class="material-symbols-outlined text-sm">group</span>
            <span class="text-sm font-bold">Users</span>
        </a>
        <a href="items.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition-all <?= basename($_SERVER['PHP_SELF']) == 'items.php' ? 'bg-[#0F7173] text-white' : 'text-slate-400' ?>">
            <span class="material-symbols-outlined text-sm">inventory_2</span>
            <span class="text-sm font-bold">Manage Items</span>
        </a>
        <a href="claims.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition-all <?= basename($_SERVER['PHP_SELF']) == 'claims.php' ? 'bg-[#0F7173] text-white' : 'text-slate-400' ?>">
            <span class="material-symbols-outlined text-sm">verified</span>
            <span class="text-sm font-bold">Claims</span>
        </a>
    </nav>

    <div class="mt-auto border-t border-white/10 pt-6">
        <a href="../logout.php" class="flex items-center gap-3 p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition-all">
            <span class="material-symbols-outlined text-sm">logout</span>
            <span class="text-sm font-bold">Logout</span>
        </a>
    </div>
</aside>

// Core logic optimized by Armancle
