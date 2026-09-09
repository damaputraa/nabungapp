import urllib.request
import urllib.parse
import http.cookiejar

cookie_jar = http.cookiejar.CookieJar()
opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(cookie_jar))

base_url = "http://localhost/keuangan-dams"

def test_url(name, url, expected_status=200):
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        res = opener.open(req)
        print(f" [OK] {name} ({url}) -> Status: {res.status}")
        return res.read().decode('utf-8', errors='ignore')
    except urllib.error.HTTPError as e:
        print(f" [{ 'OK (Redirect)' if e.code in [301, 302] else 'FAIL' }] {name} -> Code: {e.code}")
        return ""
    except Exception as e:
        print(f" [WARN] {name} -> Error: {e}")
        return ""

print("=== TESTING HTTP ENDPOINTS ===")
test_url("Landing Page", f"{base_url}/")
test_url("User Login Page", f"{base_url}/auth/login")
test_url("Admin Login Page", f"{base_url}/admin/login")

