<?php
require_once 'includes/auth_check.php';
// We can just reuse post-lost.php logic for post-found.php with different text
require_once 'includes/header.php';
?>
<section class="section-surface" style="padding-top: 120px; min-height: 100vh;">
    <div class="container" style="max-width: 800px;">
        <h1 class="headline-lg text-center mb-md">I Found an Item</h1>
        <!-- Same structure as post-lost -->
        <div class="glass-container text-center">
            <p>UI is idential to <a href="post-lost.php" style="text-decoration: underline;">Report Lost Item</a>, but submitting as "Found".</p>
        </div>
    </div>
</section>
<?php
require_once 'includes/footer.php';
?>
