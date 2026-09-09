import subprocess
import os

files = [
    'application/models/Wallet_model.php',
    'application/models/Bill_model.php',
    'application/models/Achievement_model.php',
    'application/models/Challenge_model.php',
    'application/models/Transaction_model.php',
    'application/controllers/Wallets.php',
    'application/controllers/Bills.php',
    'application/controllers/Challenges.php',
    'application/controllers/Admin.php',
    'application/controllers/Dashboard.php',
    'application/controllers/Transactions.php',
    'application/views/wallets/index.php',
    'application/views/bills/index.php',
    'application/views/challenges/index.php',
    'application/views/dashboard/user_dashboard.php',
    'application/views/dashboard/index.php',
    'application/views/transactions/add.php',
    'application/views/transactions/edit.php',
    'application/views/template/sidebar.php',
    'application/views/template/bottom_nav.php',
    'application/config/routes.php'
]

print("=== CHECKING SYNTAX ===")
all_good = True
for f in files:
    res = subprocess.run(['php', '-l', f], capture_output=True, text=True)
    if res.returncode == 0:
        print(f" [OK] {f}")
    else:
        print(f" [FAIL] {f}\n{res.stderr}\n{res.stdout}")
        all_good = False

if all_good:
    print("\nALL FILES PASSED SYNTAX CHECK!")
else:
    print("\nSOME FILES FAILED!")

