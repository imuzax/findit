import os
import re

dir_path = r"d:\Freelancing\ReclaimHub\findit"
php_files = [f for f in os.listdir(dir_path) if f.endswith('.php')]

for file in php_files:
    try:
        path = os.path.join(dir_path, file)
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
            
        # Fix literal `n from PowerShell injection
        content = content.replace(">`n<script", ">\n<script")
        content = content.replace("</script>`n</head>", "</script>\n</head>")
        
        # Replace remaining hardcoded navbars (Stitch uses <nav> in some files instead of <header>)
        if "<!-- TopNavBar" in content and "<?php include 'includes/navbar.php'; ?>" not in content:
            content = re.sub(r'<!-- TopNavBar.*?-->\s*<nav[^>]*>.*?</nav>', r"<?php include 'includes/navbar.php'; ?>", content, flags=re.DOTALL)
            
        # Replace remaining hardcoded footers
        if "<footer" in content and "<?php include 'includes/footer.php'; ?>" not in content:
            content = re.sub(r'<footer[^>]*>.*?</footer>', r"<?php include 'includes/footer.php'; ?>", content, flags=re.DOTALL)
        
        with open(path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Cleaned up {file}")
    except Exception as e:
        print(f"Error on {file}: {e}")
