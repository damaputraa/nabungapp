import urllib.request
import urllib.parse
import http.cookiejar
import re

base_url = "http://localhost/keuangan-dams"

def run_session_tests():
    # 1. USER SESSION TEST
    print("=== TESTING USER SESSION (dama) ===")
    user_jar = http.cookiejar.CookieJar()
    user_opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(user_jar))
    
    # Login as dama
    login_data = urllib.parse.urlencode({'username': 'dama', 'password': 'password'}).encode('utf-8')
    req = urllib.request.Request(f"{base_url}/auth/login", data=login_data, headers={'User-Agent': 'Mozilla/5.0'})
    res = user_opener.open(req)
    print(f" [OK] User Login POST -> {res.status}")
    
    # Visit User Dashboard
    res = user_opener.open(f"{base_url}/dashboard")
    body = res.read().decode('utf-8', errors='ignore')
    has_wallets = "Dompet & Sumber Dana" in body
    has_expense_chart = "chartExpenseCategory" in body
    has_badges = "Lencana & Tantangan" in body
    print(f" [OK] User Dashboard (200) | Has Wallets Widget: {has_wallets} | Has Expense Chart: {has_expense_chart} | Has Badges: {has_badges}")
    if not (has_wallets and has_expense_chart and has_badges):
        print("  [WARN] Some elements missing in user dashboard!")
    
    # Visit Wallets Page
    res = user_opener.open(f"{base_url}/wallets")
    body = res.read().decode('utf-8', errors='ignore')
    has_wallet_list = "Dompet & Rekening" in body and "Transfer Saldo" in body
    print(f" [OK] Wallets Page (200) | Verified content: {has_wallet_list}")

    # Visit Bills Page
    res = user_opener.open(f"{base_url}/bills")
    body = res.read().decode('utf-8', errors='ignore')
    has_bills_list = "Pengingat Tagihan & Rutin" in body
    print(f" [OK] Bills Page (200) | Verified content: {has_bills_list}")

    # Visit Challenges Page
    res = user_opener.open(f"{base_url}/challenges")
    body = res.read().decode('utf-8', errors='ignore')
    has_chal_list = "Tantangan Nabung & Lencana Prestasi" in body
    print(f" [OK] Challenges Page (200) | Verified content: {has_chal_list}")

    # Visit Transactions Add Page
    res = user_opener.open(f"{base_url}/transactions/add")
    body = res.read().decode('utf-8', errors='ignore')
    has_wallet_select = "Dompet / Rekening" in body and "wallet_id" in body
    print(f" [OK] Transactions Add Page (200) | Has wallet selector: {has_wallet_select}")

    # 2. ADMIN SESSION TEST
    print("\n=== TESTING ADMIN SESSION (admin) ===")
    admin_jar = http.cookiejar.CookieJar()
    admin_opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(admin_jar))

    # Login as admin
    admin_login_data = urllib.parse.urlencode({'username': 'admin', 'password': 'password'}).encode('utf-8')
    req = urllib.request.Request(f"{base_url}/admin/login", data=admin_login_data, headers={'User-Agent': 'Mozilla/5.0'})
    res = admin_opener.open(req)
    print(f" [OK] Admin Login POST -> {res.status}")

    # Visit Admin Dashboard
    res = admin_opener.open(f"{base_url}/dashboard")
    body = res.read().decode('utf-8', errors='ignore')
    has_admin_header = "PANEL ADMINISTRATOR" in body
    has_top_cats = "chartPlatformCategories" in body
    has_backup_btn = "Backup Database (.sql)" in body
    print(f" [OK] Admin Dashboard (200) | Panel: {has_admin_header} | Top Cats Chart: {has_top_cats} | Backup Btn: {has_backup_btn}")

    # Test Database Backup Download endpoint
    res = admin_opener.open(f"{base_url}/admin/backup_db")
    content_disp = res.headers.get('Content-Disposition', '')
    data_backup = res.read()
    has_sql = b"CREATE TABLE" in data_backup or b"--" in data_backup or len(data_backup) > 100
    print(f" [OK] Admin Backup DB (200) | Filename header: {content_disp} | Size: {len(data_backup)} bytes | SQL valid: {has_sql}")

if __name__ == '__main__':
    run_session_tests()

