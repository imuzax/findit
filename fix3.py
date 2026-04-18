import os

dir_path = r"d:\Freelancing\ReclaimHub\findit"
php_files = [f for f in os.listdir(dir_path) if f.endswith('.php')]

for file in php_files:
    path = os.path.join(dir_path, file)
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Remove the slashes before quotes that powershell introduced
    content = content.replace(r'\"', '"')
    
    # Just in case `n or \n literals are printed out as text:
    content = content.replace('`n', '')

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)
        
print("Fixed slashes and formatting.")
