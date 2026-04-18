import os
import re

dir_path = r"d:\Freelancing\ReclaimHub\findit"
php_files = [f for f in os.listdir(dir_path) if f.endswith('.php')]

for file in php_files:
    try:
        path = os.path.join(dir_path, file)
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # Replace header safely
        content = re.sub(r'<header[^>]*>.*?</header>', r"<?php include 'includes/navbar.php'; ?>", content, flags=re.DOTALL)
        
        # Replace footer safely
        content = re.sub(r'<footer[^>]*>.*?</footer>', r"<?php include 'includes/footer.php'; ?>", content, flags=re.DOTALL)
        
        # Specific link button replacements 
        content = re.sub(r'<button([^>]*)>\s*I Lost Something\s*</button>', r'<a href="post-lost.php?type=lost"\1 style="display:inline-block;text-align:center;">I Lost Something</a>', content, flags=re.IGNORECASE)
        content = re.sub(r'<button([^>]*)>\s*I Found Something\s*</button>', r'<a href="post-lost.php?type=found"\1 style="display:inline-block;text-align:center;">I Found Something</a>', content, flags=re.IGNORECASE)
        content = re.sub(r'<button([^>]*)>\s*View Details\s*</button>', r'<a href="item-detail.php"\1 style="display:inline-block;text-align:center;">View Details</a>', content, flags=re.IGNORECASE)
        content = re.sub(r'<button([^>]*)>\s*View All Items\s*</button>', r'<a href="browse.php"\1 style="display:inline-block;text-align:center;">View All Items</a>', content, flags=re.IGNORECASE)
        
        # Save back
        with open(path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Processed {file}")
    except Exception as e:
        print(f"Skipping {file} due to {e}")
        
