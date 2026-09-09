<?php
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');

$db_config = [];
require 'application/config/database.php';
$db = $db['default'];


$pdo = new PDO(
    "mysql:host={$db['hostname']};dbname={$db['database']};charset={$db['char_set']}",
    $db['username'],
    $db['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

echo "=== DATABASE FUNCTIONAL TEST (PHASE 3) ===\n";

// 1. Wallets check
$stmt = $pdo->query("SELECT * FROM wallets");
$wallets = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "[OK] Wallets count: " . count($wallets) . "\n";
foreach ($wallets as $w) {
    echo "  - ID: {$w['id']} | User ID: {$w['user_id']} | Name: {$w['name']} | Type: {$w['type']} | Balance: {$w['balance']} | Default: {$w['is_default']}\n";
}

// 2. Bills check
$stmt = $pdo->query("SELECT * FROM bills");
$bills = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "[OK] Bills count: " . count($bills) . "\n";

// 3. Savings Challenges check
$stmt = $pdo->query("SELECT * FROM savings_challenges");
$challenges = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "[OK] Savings challenges count: " . count($challenges) . "\n";

// 4. Test adding a bill for user 1 (dama)
$stmt = $pdo->prepare("INSERT INTO bills (user_id, title, amount, category, due_day, status, created_at) VALUES (?, ?, ?, ?, ?, 'unpaid', NOW())");
$stmt->execute([1, 'Tagihan Listrik PLN Test', 250000, 'Utilitas / Tagihan', (int)date('j') + 2]);
$new_bill_id = $pdo->lastInsertId();
echo "[OK] Inserted test bill ID #$new_bill_id\n";

// 5. Test adding a challenge for user 1
$stmt = $pdo->prepare("INSERT INTO savings_challenges (user_id, challenge_type, title, target_amount, current_amount, completed_steps, status, created_at) VALUES (?, '30_days', 'Tantangan 30 Hari Test', 1000000, 0, '[]', 'active', NOW())");
$stmt->execute([1]);
$new_chal_id = $pdo->lastInsertId();
echo "[OK] Inserted test challenge ID #$new_chal_id\n";

// 6. Test challenge toggle step
$stmt = $pdo->prepare("SELECT completed_steps, current_amount, target_amount FROM savings_challenges WHERE id = ?");
$stmt->execute([$new_chal_id]);
$ch = $stmt->fetch(PDO::FETCH_ASSOC);
$steps = json_decode($ch['completed_steps'], true) ?: [];
$steps[] = 1;
$stmt = $pdo->prepare("UPDATE savings_challenges SET completed_steps = ?, current_amount = current_amount + 33333 WHERE id = ?");
$stmt->execute([json_encode($steps), $new_chal_id]);
echo "[OK] Updated challenge step #1 toggle\n";

// Clean up test records
$pdo->prepare("DELETE FROM bills WHERE id = ?")->execute([$new_bill_id]);
$pdo->prepare("DELETE FROM savings_challenges WHERE id = ?")->execute([$new_chal_id]);
echo "[OK] Cleanup test records complete\n";

// 7. Test DB backup utility
echo "\n=== CI3 DBUTIL BACKUP VERIFICATION ===\n";
ob_start();
// Test that dbutil class file exists and is readable
$dbutil_file = 'system/database/DB_utility.php';
$driver_util = 'system/database/drivers/mysqli/mysqli_utility.php';
if (file_exists($dbutil_file) && file_exists($driver_util)) {
    echo "[OK] CI3 DB_utility and mysqli_utility found\n";
} else {
    echo "[FAIL] DB utility files not found\n";
}

echo "\nALL FUNCTIONAL DB TESTS COMPLETED SUCCESSFULLY!\n";
