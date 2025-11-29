#!/usr/bin/env python3
import os

php_ini_path = r"C:\xampp\php\php.ini"

try:
    with open(php_ini_path, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Replace ;extension=gd with extension=gd
    new_content = content.replace(';extension=gd', 'extension=gd')
    
    with open(php_ini_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    
    print(f"✓ Berhasil! GD extension diaktifkan di {php_ini_path}")
    
    # Verify
    with open(php_ini_path, 'r', encoding='utf-8') as f:
        lines = f.readlines()
        for i, line in enumerate(lines[930:935], start=931):
            print(f"Baris {i}: {line.rstrip()}")
            
except Exception as e:
    print(f"✗ Error: {e}")
