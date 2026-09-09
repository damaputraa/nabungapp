<?php
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');

require 'application/config/database.php';
$db = $db['default'];

$pdo = new PDO(
    "mysql:host={$db['hostname']};dbname={$db['database']};charset={$db['char_set']}",
    $db['username'],
    $db['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$json_path = 'c:/Users/Damskuy/Downloads/damm5992_nabung.json';
if (!file_exists($json_path)) {
    die("File $json_path not found!\n");
}

$raw = file_get_contents($json_path);
$items = json_decode($raw, true);
if (!$items) {
    die("Failed to parse JSON!\n");
}

$tables = [];
foreach ($items as $it) {
    if (isset($it['type']) && $it['type'] === 'table') {
        $tables[$it['name']] = $it['data'] ?? [];
    }
}

echo "=== IMPORTING DATA FROM damm5992_nabung.json ===\n";
echo "Tables found in JSON: " . implode(', ', array_keys($tables)) . "\n";

// Begin transaction
$pdo->beginTransaction();

try {
    // 1. IMPORT USERS
    echo "\n1. Importing users...\n";
    $users_data = $tables['users'] ?? [];
    $stmt_user = $pdo->prepare("
        INSERT INTO users (id, username, email, password, role, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
            username = VALUES(username),
            email = VALUES(email),
            password = VALUES(password),
            role = VALUES(role),
            created_at = VALUES(created_at),
            updated_at = VALUES(updated_at)
    ");

    foreach ($users_data as $u) {
        $stmt_user->execute([
            $u['id'],
            $u['username'],
            $u['email'],
            $u['password'],
            $u['role'],
            $u['created_at'] ?? date('Y-m-d H:i:s'),
            $u['updated_at'] ?? date('Y-m-d H:i:s')
        ]);
        echo "  [OK] User ID {$u['id']}: {$u['username']} ({$u['email']})\n";
    }

    // 2. ENSURE DEFAULT WALLET FOR EACH USER
    echo "\n2. Ensuring default wallets...\n";
    $wallet_map = []; // user_id => wallet_id
    $stmt_check_wallet = $pdo->prepare("SELECT id FROM wallets WHERE user_id = ? AND is_default = 1 LIMIT 1");
    $stmt_insert_wallet = $pdo->prepare("
        INSERT INTO wallets (user_id, name, type, account_number, balance, color, icon, is_default, created_at)
        VALUES (?, 'Dompet Utama (Tunai)', 'cash', '-', 0, '#2563eb', 'fa-wallet', 1, NOW())
    ");

    foreach ($users_data as $u) {
        $uid = (int) $u['id'];
        $stmt_check_wallet->execute([$uid]);
        $wid = $stmt_check_wallet->fetchColumn();
        if (!$wid) {
            $stmt_insert_wallet->execute([$uid]);
            $wid = $pdo->lastInsertId();
            echo "  [OK] Created default wallet for User #$uid (Wallet ID #$wid)\n";
        } else {
            echo "  [OK] Existing default wallet for User #$uid (Wallet ID #$wid)\n";
        }
        $wallet_map[$uid] = $wid;
    }

    // 3. IMPORT SAVINGS TARGETS
    echo "\n3. Importing savings_targets...\n";
    $targets_data = $tables['savings_targets'] ?? [];
    $pdo->exec("DELETE FROM savings_targets");
    $stmt_target = $pdo->prepare("
        INSERT INTO savings_targets (id, user_id, month_year, target_amount, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    foreach ($targets_data as $t) {
        $stmt_target->execute([
            $t['id'],
            $t['user_id'],
            $t['month_year'],
            $t['target_amount'],
            $t['created_at'] ?? date('Y-m-d H:i:s'),
            $t['updated_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
    echo "  [OK] Imported " . count($targets_data) . " savings targets.\n";

    // 4. IMPORT SAVINGS DEPOSITS
    echo "\n4. Importing savings...\n";
    $savings_data = $tables['savings'] ?? [];
    $pdo->exec("DELETE FROM savings");
    $stmt_saving = $pdo->prepare("
        INSERT INTO savings (id, user_id, wallet_id, amount, deposit_date, description, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    foreach ($savings_data as $s) {
        $uid = (int) $s['user_id'];
        $wid = $wallet_map[$uid] ?? null;
        $stmt_saving->execute([
            $s['id'],
            $uid,
            $wid,
            $s['amount'],
            $s['deposit_date'],
            $s['description'] ?? '',
            $s['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
    echo "  [OK] Imported " . count($savings_data) . " savings deposits.\n";

    // 5. IMPORT TRANSACTIONS
    echo "\n5. Importing transactions...\n";
    $transactions_data = $tables['transactions'] ?? [];
    $pdo->exec("DELETE FROM transactions");
    $stmt_trx = $pdo->prepare("
        INSERT INTO transactions (id, user_id, wallet_id, type, category, amount, description, transaction_date, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    foreach ($transactions_data as $tr) {
        $uid = (int) $tr['user_id'];
        $wid = $wallet_map[$uid] ?? null;
        $stmt_trx->execute([
            $tr['id'],
            $uid,
            $wid,
            $tr['type'],
            $tr['category'],
            $tr['amount'],
            $tr['description'] ?? '',
            $tr['transaction_date'],
            $tr['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }
    echo "  [OK] Imported " . count($transactions_data) . " transactions.\n";

    // 6. UPDATE WALLET BALANCES ACCORDING TO TRANSACTIONS
    echo "\n6. Calculating and updating wallet balances...\n";
    $stmt_calc = $pdo->prepare("
        SELECT 
            COALESCE(SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END), 0) -
            COALESCE(SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END), 0) AS net_balance
        FROM transactions
        WHERE user_id = ?
    ");
    $stmt_update_wallet = $pdo->prepare("UPDATE wallets SET balance = ? WHERE id = ?");

    foreach ($wallet_map as $uid => $wid) {
        $stmt_calc->execute([$uid]);
        $net = (float) $stmt_calc->fetchColumn();
        $stmt_update_wallet->execute([$net, $wid]);
        echo "  [OK] User #$uid (Wallet #$wid) -> Saldo: Rp " . number_format($net, 0, ',', '.') . "\n";
    }

    // 7. RECORD ACTIVITY LOG
    try {
        $stmt_log = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details, ip_address, user_agent, created_at) VALUES (1, 'IMPORT_DATABASE', ?, '127.0.0.1', 'Migration Script', NOW())");
        $stmt_log->execute(['Imported damm5992_nabung.json: ' . count($users_data) . ' users, ' . count($targets_data) . ' targets, ' . count($savings_data) . ' savings, ' . count($transactions_data) . ' transactions.']);
    } catch(Exception $e) {}

    $pdo->commit();
    echo "\n=== ALL DATA IMPORTED SUCCESSFULLY! ===\n";

} catch (Exception $e) {
    $pdo->rollBack();
    echo "\n[ERROR] Transaction rolled back: " . $e->getMessage() . "\n";
    exit(1);
}

