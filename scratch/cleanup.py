import urllib.request
import urllib.parse
import http.cookiejar
import re

base_url = "http://localhost/keuangan-dams"

jar = http.cookiejar.CookieJar()
opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(jar))

# Login
opener.open(f"{base_url}/auth/login", urllib.parse.urlencode({'username': 'dama', 'password': 'password'}).encode())

# Delete wallet
wallets_html = opener.open(f"{base_url}/wallets").read().decode()
for m in re.finditer(r'href="[^"]*wallets/delete/(\d+)"', wallets_html):
    opener.open(f"{base_url}/wallets/delete/{m.group(1)}")
    print(f"Deleted wallet {m.group(1)}")

# Delete bill
bills_html = opener.open(f"{base_url}/bills").read().decode()
for m in re.finditer(r'href="[^"]*bills/delete/(\d+)"', bills_html):
    opener.open(f"{base_url}/bills/delete/{m.group(1)}")
    print(f"Deleted bill {m.group(1)}")

# Delete challenge
ch_html = opener.open(f"{base_url}/challenges").read().decode()
for m in re.finditer(r'href="[^"]*challenges/delete/(\d+)"', ch_html):
    opener.open(f"{base_url}/challenges/delete/{m.group(1)}")
    print(f"Deleted challenge {m.group(1)}")

print("Cleanup complete!")

