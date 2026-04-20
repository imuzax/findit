<?php
require_once 'includes/config.php';
require_once 'includes/auth_check.php';

$user_id = $_SESSION['user_id'];

// Fetch all conversations
$sql = "
    SELECT 
        m.item_id,
        CASE WHEN m.sender_id = :u1 THEN m.receiver_id ELSE m.sender_id END as other_id,
        MAX(m.sent_at) as latest_message_time,
        SUM(CASE WHEN m.receiver_id = :u2 AND m.is_read = 0 THEN 1 ELSE 0 END) as unread_count,
        u.full_name as other_name,
        i.title as item_title,
        i.status as item_status,
        (SELECT image_path FROM item_images img WHERE img.item_id = m.item_id ORDER BY is_primary DESC LIMIT 1) as item_image
    FROM messages m
    JOIN users u ON u.user_id = (CASE WHEN m.sender_id = :u3 THEN m.receiver_id ELSE m.sender_id END)
    JOIN items i ON i.item_id = m.item_id
    WHERE m.sender_id = :u4 OR m.receiver_id = :u5
    GROUP BY m.item_id, other_id, u.full_name, i.title, i.status
    ORDER BY latest_message_time DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['u1'=>$user_id, 'u2'=>$user_id, 'u3'=>$user_id, 'u4'=>$user_id, 'u5'=>$user_id]);
$conversations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch latest text for each conversation (safer than complex SQL alias subquery)
foreach ($conversations as &$conv) {
    $stmtText = $pdo->prepare("SELECT message_text FROM messages WHERE item_id = ? AND (sender_id = ? OR receiver_id = ?) ORDER BY sent_at DESC LIMIT 1");
    $stmtText->execute([$conv['item_id'], $conv['other_id'], $conv['other_id']]);
    $conv['latest_text'] = $stmtText->fetchColumn();
}
unset($conv);

// Determine active conversation
$active_item_id = isset($_GET['item_id']) ? (int)$_GET['item_id'] : null;
$active_other_id = isset($_GET['other_id']) ? (int)$_GET['other_id'] : null;

$active_conv = null;

if ($active_item_id && $active_other_id) {
    // Check if it exists in our list
    foreach ($conversations as $c) {
        if ($c['item_id'] == $active_item_id && $c['other_id'] == $active_other_id) {
            $active_conv = $c;
            break;
        }
    }
} elseif (count($conversations) > 0) {
    $active_conv = $conversations[0];
    $active_item_id = $active_conv['item_id'];
    $active_other_id = $active_conv['other_id'];
}

// Function to format relative time
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    if ($diff->d == 0 && $diff->h == 0 && $diff->i < 1) return 'Just now';
    if ($diff->d == 0 && $diff->h == 0) return $diff->i . 'm ago';
    if ($diff->d == 0) return $diff->h . 'h ago';
    if ($diff->d == 1) return 'Yesterday';
    return $ago->format('M j');
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Messages - FindIt</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#000000",
                        "secondary": "#00696b",
                        "surface": "#f7fafc",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f1f4f6",
                        "surface-container": "#ebeef0",
                        "surface-container-high": "#e5e9eb",
                        "on-surface": "#181c1e",
                        "on-surface-variant": "#44474c",
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "primary-container": "#0f1c2c",
                        "on-primary-container": "#778598",
                        "outline-variant": "#c4c6cc"
                    },
                    "fontFamily": {
                        "headline": ["Inter"], "body": ["Inter"], "label": ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 1; }
        
        /* Custom Scrollbar for messages */
        .chat-scroll::-webkit-scrollbar { width: 6px; }
        .chat-scroll::-webkit-scrollbar-track { background: transparent; }
        .chat-scroll::-webkit-scrollbar-thumb { background: #c4c6cc; border-radius: 10px; }
        .chat-scroll::-webkit-scrollbar-thumb:hover { background: #74777d; }
    </style>
</head>
<body class="bg-surface text-on-surface flex min-h-screen font-body overflow-hidden">
    
    <!-- SideNavBar Component -->
    <nav class="hidden md:flex flex-col gap-4 p-6 bg-[#f7fafc] dark:bg-slate-950 w-[220px] h-screen border-r border-outline-variant/20 z-40">
        <div class="mb-8">
            <h1 class="text-xl font-bold text-[#0D1B2A] dark:text-white font-headline tracking-tight">FindIt</h1>
            <p class="text-sm text-on-surface-variant">Digital Concierge</p>
        </div>
        <div class="flex flex-col gap-2 font-label text-sm font-medium">
            <a href="dashboard.php" class="flex items-center gap-3 p-3 text-slate-500 rounded-lg hover:bg-surface-container transition-all">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span> Dashboard
            </a>
            <a href="dashboard.php" class="flex items-center gap-3 p-3 text-slate-500 rounded-lg hover:bg-surface-container transition-all">
                <span class="material-symbols-outlined" data-icon="description">description</span> My Reports
            </a>
            <a href="messages.php" class="flex items-center gap-3 p-3 text-[#0F7173] bg-white shadow-sm font-semibold rounded-lg">
                <span class="material-symbols-outlined" data-icon="chat">chat</span> Messages
            </a>
        </div>
        <div class="mt-auto pt-6">
            <a href="post-lost.php" class="w-full bg-[#0D1B2A] hover:bg-primary-container text-white py-3 px-4 rounded-DEFAULT font-bold text-sm shadow-md flex items-center justify-center gap-2 transition-all">
                <span class="material-symbols-outlined">add</span> New Report
            </a>
        </div>
    </nav>

    <!-- Content Split -->
    <main class="flex-1 flex h-screen bg-surface relative">
        
        <!-- Left Panel: Conversations List -->
        <section class="w-full md:w-[350px] lg:w-[400px] flex flex-col h-full bg-surface-container-low border-r border-outline-variant/15 flex-shrink-0 z-10 transition-transform duration-300 <?= ($active_conv) ? 'hidden md:flex' : 'flex' ?>">
            <div class="p-6 pb-4">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold font-headline text-on-surface tracking-tight">Chats</h2>
                    <!-- md-hidden back button to dashboard if needed -->
                    <a href="dashboard.php" class="md:hidden p-2 rounded-full hover:bg-surface-container text-on-surface-variant flex items-center justify-center">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto px-4 pb-4 flex flex-col gap-2 chat-scroll">
                <?php if (empty($conversations)): ?>
                    <div class="text-center p-6 text-on-surface-variant mt-10">
                        <span class="material-symbols-outlined text-4xl opacity-50 mb-2">forum</span>
                        <p class="text-sm">No messages yet.</p>
                        <p class="text-xs opacity-70 mt-1">When someone claims your item or you claim an item, chat will appear here.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($conversations as $conv): 
                        $isActive = ($active_conv && $active_conv['item_id'] == $conv['item_id'] && $active_conv['other_id'] == $conv['other_id']);
                        $initials = strtoupper(substr($conv['other_name'], 0, 1) . substr($conv['other_name'], strpos($conv['other_name'], ' ') + 1, 1));
                    ?>
                    <a href="messages.php?item_id=<?= $conv['item_id'] ?>&other_id=<?= $conv['other_id'] ?>" 
                       class="block p-4 rounded-xl cursor-pointer transition-colors relative group <?= $isActive ? 'bg-surface-container-lowest shadow-sm' : 'hover:bg-surface-container-lowest/50' ?>">
                        <?php if ($isActive): ?>
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 h-3/4 w-1 bg-secondary rounded-r-full"></div>
                        <?php endif; ?>
                        
                        <div class="flex gap-4 items-center">
                            <div class="relative flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-lg">
                                    <?= $initials ?>
                                </div>
                                <?php if ($conv['unread_count'] > 0): ?>
                                    <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-[#ba1a1a] rounded-full border-2 border-surface-container-low"></span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h3 class="font-bold text-[1rem] text-on-surface truncate pr-2 <?= $conv['unread_count'] > 0 ? 'text-primary' : '' ?>"><?= htmlspecialchars($conv['other_name']) ?></h3>
                                    <span class="text-[0.65rem] font-label font-medium <?= $conv['unread_count'] > 0 ? 'text-[#ba1a1a]' : 'text-on-surface-variant' ?> whitespace-nowrap whitespace-nowrap"><?= time_elapsed_string($conv['latest_message_time']) ?></span>
                                </div>
                                <p class="text-[0.8rem] truncate font-body <?= $conv['unread_count'] > 0 ? 'font-bold text-on-surface' : 'text-on-surface-variant' ?>">
                                    <?= htmlspecialchars($conv['latest_text']) ?>
                                </p>
                                <div class="mt-1.5 flex items-center gap-1.5 opacity-80">
                                    <span class="px-2 py-0.5 bg-surface-container rounded gap-1 flex items-center max-w-full text-xs">
                                        <span class="material-symbols-outlined text-[12px] shrink-0 text-secondary">inventory_2</span>
                                        <span class="truncate font-semibold text-secondary"><?= htmlspecialchars($conv['item_title']) ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Right Panel: Chat Thread -->
        <section class="flex-1 flex flex-col h-full bg-surface relative <?= ($active_conv) ? 'flex' : 'hidden md:flex' ?>">
            <?php if ($active_conv): ?>
                
                <!-- Chat Header / Mobile Back -->
                <div class="px-6 py-4 bg-surface/90 backdrop-blur-md border-b border-outline-variant/15 flex items-center justify-between sticky top-0 z-20 shadow-sm">
                    <div class="flex items-center gap-4">
                        <a href="messages.php" class="md:hidden p-2 rounded-full hover:bg-surface-container text-on-surface flex items-center justify-center -ml-2">
                            <span class="material-symbols-outlined">arrow_back</span>
                        </a>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold">
                                <?= strtoupper(substr($active_conv['other_name'], 0, 1)) ?>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-on-surface leading-tight"><?= htmlspecialchars($active_conv['other_name']) ?></h2>
                                <p class="text-xs text-on-surface-variant flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#0F7173]"></span> Active User
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Item Context Card -->
                <div class="px-6 py-4 bg-surface z-10 sticky top-[70px]">
                    <div class="bg-surface-container-lowest rounded-xl p-3 shadow-sm border border-outline-variant/20 flex gap-4 items-center">
                        <?php if(!empty($active_conv['item_image'])): ?>
                            <img src="<?= htmlspecialchars(preg_replace('/^\.\.\//', '', $active_conv['item_image'])) ?>" class="w-12 h-12 rounded-lg object-cover bg-surface-container shrink-0"/>
                        <?php else: ?>
                            <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-outline">image</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-[0.95rem] text-on-surface truncate"><?= htmlspecialchars($active_conv['item_title']) ?></h4>
                            <p class="text-[0.75rem] text-on-surface-variant uppercase tracking-wider font-semibold mt-0.5">
                                Status: <span class="text-secondary"><?= htmlspecialchars($active_conv['item_status']) ?></span>
                            </p>
                        </div>
                        <a href="item-detail.php?id=<?= $active_conv['item_id'] ?>" class="hidden sm:inline-block px-4 py-2 bg-surface-container text-on-surface rounded font-label font-bold text-[0.75rem] hover:bg-surface-container-high transition-colors whitespace-nowrap">View Item</a>
                    </div>
                </div>

                <!-- Chat Messages Stream -->
                <div class="flex-1 overflow-y-auto px-6 py-6 flex flex-col gap-4 chat-scroll" id="chatWindow">
                    <!-- Loaded dynamically via JS -->
                    <div class="flex items-center justify-center h-full text-on-surface-variant">
                        <span class="material-symbols-outlined animate-spin text-2xl mr-2">progress_activity</span> Loading messages...
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-surface-container-lowest border-t border-outline-variant/15 z-20">
                    <form id="sendMessageForm" class="max-w-4xl mx-auto bg-surface border border-outline-variant/20 rounded-xl flex items-end p-2 gap-2 focus-within:border-secondary transition-all">
                        <input type="hidden" id="active_other_id" value="<?= $active_other_id ?>">
                        <input type="hidden" id="active_item_id" value="<?= $active_item_id ?>">
                        <textarea id="messageInput" class="w-full bg-transparent border-none focus:ring-0 resize-none py-2.5 px-3 text-[0.9rem] font-body text-on-surface max-h-[120px] min-h-[44px]" placeholder="Type your message..." rows="1" required></textarea>
                        <button type="submit" id="sendBtn" class="p-2.5 bg-secondary text-on-secondary hover:bg-[#0a4e50] rounded-lg transition-colors shrink-0 flex items-center justify-center disabled:opacity-50">
                            <span class="material-symbols-outlined text-[20px]">send</span>
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <!-- Empty State (No active conversation selected) -->
                <div class="flex-1 flex flex-col items-center justify-center p-8 text-center text-on-surface-variant bg-surface">
                    <div class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[3rem] text-outline-variant">forum</span>
                    </div>
                    <h3 class="text-xl font-bold text-on-surface mb-2 font-headline">No Conversation Selected</h3>
                    <p class="max-w-md mx-auto text-sm">Select a chat from the left panel to view message history, or go to the dashboard to start a new claim.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php if ($active_conv): ?>
    <script>
        const myUserId = <?= $user_id ?>;
        const chatWindow = document.getElementById('chatWindow');
        const sendForm = document.getElementById('sendMessageForm');
        const msgInput = document.getElementById('messageInput');
        
        let lastMessageId = 0;

        function renderMessage(msg) {
            const isMe = (parseInt(msg.sender_id) === myUserId);
            
            const timeStr = new Date(msg.sent_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            let bubble = document.createElement('div');
            bubble.classList.add('flex', 'gap-3', 'max-w-[85%]', 'sm:max-w-[75%]');
            
            if (isMe) {
                bubble.classList.add('self-end', 'flex-row-reverse');
                bubble.innerHTML = `
                    <div class="flex flex-col items-end">
                        <div class="bg-secondary text-on-secondary p-3 sm:p-4 rounded-2xl rounded-tr-sm shadow-sm text-[0.9rem] font-body">
                            ${escapeHtml(msg.message_text)}
                        </div>
                        <div class="flex items-center gap-1 mt-1 mr-1">
                            <span class="text-[0.65rem] font-label text-on-surface-variant">${timeStr}</span>
                        </div>
                    </div>
                `;
            } else {
                bubble.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-bold text-xs flex-shrink-0 mt-1">
                        <?= strtoupper(substr($active_conv['other_name'], 0, 1)) ?>
                    </div>
                    <div>
                        <div class="bg-surface-container-lowest p-3 sm:p-4 rounded-2xl rounded-tl-sm shadow-sm border border-outline-variant/10 text-[0.9rem] text-on-surface font-body">
                            ${escapeHtml(msg.message_text)}
                        </div>
                        <span class="text-[0.65rem] font-label text-on-surface-variant mt-1 block ml-1">${timeStr}</span>
                    </div>
                `;
            }
            return bubble;
        }

        async function fetchMessages() {
            const other_id = document.getElementById('active_other_id').value;
            const item_id = document.getElementById('active_item_id').value;
            
            try {
                const response = await fetch(`api/get_messages.php?other_id=${other_id}&item_id=${item_id}`);
                const data = await response.json();
                
                if (data.success) {
                    if (data.data.length === 0) {
                        chatWindow.innerHTML = '<div class="text-center w-full text-sm text-on-surface-variant mt-10">Start the conversation...</div>';
                        return;
                    }
                    
                    chatWindow.innerHTML = ''; // clear loading state
                    data.data.forEach(msg => {
                        chatWindow.appendChild(renderMessage(msg));
                    });
                    
                    chatWindow.scrollTop = chatWindow.scrollHeight;
                }
            } catch(e) {
                console.error("Failed to load messages", e);
                chatWindow.innerHTML = '<div class="text-center w-full text-sm text-error mt-10">Failed to load messages.</div>';
            }
        }

        sendForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = msgInput.value.trim();
            if(!text) return;
            
            const btn = document.getElementById('sendBtn');
            btn.disabled = true;
            
            const formData = new FormData();
            formData.append('receiver_id', document.getElementById('active_other_id').value);
            formData.append('item_id', document.getElementById('active_item_id').value);
            formData.append('message_text', text);
            
            try {
                const response = await fetch('api/send_message.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                if(data.success) {
                    msgInput.value = '';
                    chatWindow.appendChild(renderMessage(data.message));
                    chatWindow.scrollTop = chatWindow.scrollHeight;
                }
            } catch(e) {
                console.error("Failed to send", e);
            } finally {
                btn.disabled = false;
            }
        });

        // Load initially
        fetchMessages();
        
        // Auto-refresh messages every 5 seconds
        setInterval(fetchMessages, 5000);

        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    </script>
    <?php endif; ?>
</body>
</html>
