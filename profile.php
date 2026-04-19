<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/auth_check.php';

$user_id = $_SESSION['user_id'];

// Fetch current user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>FindIt - Profile Management</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#000000",
                        secondary: "#00696b",
                        background: "#f7fafc",
                        surface: "#ffffff"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        xl: "1rem"
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/smooth.css">
    <script src="assets/js/smooth.js" defer></script>
</head>
<body class="bg-background text-on-background antialiased font-['Inter']">
    <?php include 'includes/navbar.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="flex items-center gap-4 mb-12">
            <a href="dashboard.php" class="p-2 hover:bg-surface rounded-full transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight">Profile Settings</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Sidebar Info -->
            <div class="space-y-8">
                <div class="bg-surface p-8 rounded-xl shadow-sm text-center">
                    <div class="w-32 h-32 bg-slate-100 rounded-full mx-auto mb-4 relative group overflow-hidden border-4 border-white shadow-md">
                        <?php if(!empty($user['profile_photo'])): ?>
                            <img src="<?= htmlspecialchars($user['profile_photo']) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-[64px]">account_circle</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h2 class="font-bold text-xl mb-1"><?= htmlspecialchars($user['full_name']) ?></h2>
                    <p class="text-sm text-slate-500"><?= htmlspecialchars($user['email']) ?></p>
                </div>
                
                <div class="bg-primary p-6 rounded-xl text-white shadow-lg">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">lock</span> Security
                    </h3>
                    <p class="text-sm text-slate-300 mb-6">Update your password to keep your account secure.</p>
                    <button onclick="document.getElementById('passwordSection').scrollIntoView({behavior:'smooth'})" class="w-full py-2 bg-white/10 hover:bg-white/20 rounded font-bold text-xs transition-colors">Change Password</button>
                </div>
            </div>

            <!-- Forms -->
            <div class="md:col-span-2 space-y-12">
                <!-- Personal Info Form -->
                <section class="bg-surface p-8 md:p-10 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold mb-8">Personal Information</h3>
                    <form id="profileForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">Full Name</label>
                                <input name="full_name" type="text" value="<?= htmlspecialchars($user['full_name']) ?>" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">Phone Number</label>
                                <input name="phone" type="text" value="<?= htmlspecialchars($user['phone']) ?>" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">Department</label>
                                <input name="department" type="text" value="<?= htmlspecialchars($user['department']) ?>" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">Roll Number</label>
                                <input name="roll_number" type="text" value="<?= htmlspecialchars($user['roll_number']) ?>" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary">
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" id="profileBtn" class="bg-secondary text-white px-8 py-3 rounded font-bold hover:opacity-90 transition-all shadow-md">Save Changes</button>
                        </div>
                    </form>
                </section>

                <!-- Password Change Form -->
                <section id="passwordSection" class="bg-surface p-8 md:p-10 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold mb-8">Change Password</h3>
                    <form id="passwordForm" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-600">Current Password</label>
                            <input name="current_password" type="password" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary" required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">New Password</label>
                                <input name="new_password" type="password" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-600">Confirm New Password</label>
                                <input name="confirm_password" type="password" class="w-full p-3 rounded bg-slate-50 border-none focus:ring-2 focus:ring-secondary" required>
                            </div>
                        </div>
                        <div class="pt-4">
                            <button type="submit" id="passwordBtn" class="bg-primary text-white px-8 py-3 rounded font-bold hover:opacity-90 transition-all shadow-md">Update Password</button>
                        </div>
                    </form>
                </section>

                <div id="statusMsg" class="hidden fixed bottom-8 right-8 p-4 rounded-lg shadow-xl text-white font-bold z-[200] animate-bounce"></div>
            </div>
        </div>
    </main>

    <script>
        function showStatus(msg, isError = false) {
            const status = document.getElementById('statusMsg');
            status.innerText = msg;
            status.classList.remove('hidden', 'bg-green-500', 'bg-red-500');
            status.classList.add(isError ? 'bg-red-500' : 'bg-green-500');
            setTimeout(() => status.classList.add('hidden'), 3000);
        }

        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('profileBtn');
            btn.disabled = true;
            btn.innerText = 'Saving...';
            
            try {
                const formData = new FormData(this);
                const response = await fetch('api/update_profile.php', { method: 'POST', body: formData });
                const data = await response.json();
                showStatus(data.message, !data.success);
            } catch (err) {
                showStatus('Error updating profile', true);
            } finally {
                btn.disabled = false;
                btn.innerText = 'Save Changes';
            }
        });

        document.getElementById('passwordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('passwordBtn');
            const formData = new FormData(this);
            
            if(formData.get('new_password') !== formData.get('confirm_password')) {
                showStatus('Passwords do not match', true);
                return;
            }

            btn.disabled = true;
            btn.innerText = 'Updating...';
            
            try {
                formData.append('change_password', '1');
                const response = await fetch('api/update_profile.php', { method: 'POST', body: formData });
                const data = await response.json();
                showStatus(data.message, !data.success);
                if(data.success) this.reset();
            } catch (err) {
                showStatus('Error updating password', true);
            } finally {
                btn.disabled = false;
                btn.innerText = 'Update Password';
            }
        });
    </script>
</body>
</html>
// Project finalized and optimized by Armancle
