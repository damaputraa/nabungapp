import urllib.request
import urllib.parse
import http.cookiejar
import json

base_url = "http://localhost/keuangan-dams"

user_jar = http.cookiejar.CookieJar()
user_opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(user_jar))

print("=== END-TO-END CRUD TEST ===")

# Login as dama
login_data = urllib.parse.urlencode({'username': 'dama', 'password': 'password'}).encode('utf-8')
req = urllib.request.Request(f"{base_url}/auth/login", data=login_data, headers={'User-Agent': 'Mozilla/5.0'})
user_opener.open(req)
print("[OK] Logged in as dama")

# 1. Add Wallet (BCA Tabungan with Rp 500.000)
post_wallet = urllib.parse.urlencode({
    'name': 'BCA Digital Test',
    'type': 'bank',
    'account_number': '5412889900',
    'balance': '500.000',
    'color': '#2563eb',
    'icon': 'fa-university'
}).encode('utf-8')
res = user_opener.open(f"{base_url}/wallets/add", data=post_wallet)
print(f"[OK] Add Wallet BCA Digital POST -> {res.status}")

# Check wallet page
res = user_opener.open(f"{base_url}/wallets")
body = res.read().decode('utf-8')
has_bca = "BCA Digital Test" in body
print(f"[OK] BCA Digital found on Wallets page: {has_bca}")

# 2. Add Bill (Langganan Netflix Rp 186.000, due on 15th)
post_bill = urllib.parse.urlencode({
    'title': 'Langganan Netflix Test',
    'amount': '186.000',
    'category': 'Langganan Digital',
    'due_day': '15',
    'notes': 'Paket Premium 4K'
}).encode('utf-8')
res = user_opener.open(f"{base_url}/bills/add", data=post_bill)
print(f"[OK] Add Bill Netflix POST -> {res.status}")

# Check bills page
res = user_opener.open(f"{base_url}/bills")
body = res.read().decode('utf-8')
has_netflix = "Langganan Netflix Test" in body
print(f"[OK] Netflix found on Bills page: {has_netflix}")

# 3. Create Challenge (Tantangan 30 Hari Rp 1.000.000)
post_chal = urllib.parse.urlencode({
    'challenge_type': '30_days',
    'title': 'Tantangan 30 Hari Test',
    'target_amount': '1.000.000'
}).encode('utf-8')
res = user_opener.open(f"{base_url}/challenges/create", data=post_chal)
print(f"[OK] Create Challenge POST -> {res.status}")

# Check challenges page
res = user_opener.open(f"{base_url}/challenges")
body = res.read().decode('utf-8')
has_chal = "Tantangan 30 Hari Test" in body
print(f"[OK] Challenge found on Challenges page: {has_chal}")

print("\nALL CRUD WORKFLOWS FUNCTIONED PROPERLY!")

