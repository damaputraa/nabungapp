<?php
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');
require 'application/config/database.php';
$db = $db['default'];
$pdo = new PDO("mysql:host={$db['hostname']};dbname={$db['database']}", $db['username'], $db['password']);

echo "================ DATABASE STATUS ================\n";
foreach (['users', 'wallets', 'savings_targets', 'savings', 'transactions'] as $t) {
    $c = $pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
    echo str_pad($t, 18) . ": $c rows\n";
}

echo "\n--- USERS & WALLET BALANCES ---\n";
$stmt = $pdo->query("
    SELECT u.id, u.username, u.email, u.role, w.id AS wallet_id, w.name AS wallet_name, w.balance
    FROM users u
    LEFT JOIN wallets w ON w.user_id = u.id AND w.is_default = 1
    ORDER BY u.id ASC
");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$r['id']} | User: " . str_pad($r['username'], 14) . " | Role: " . str_pad($r['role'], 6) . " | Saldo: Rp " . number_format($r['balance'], 0, ',', '.') . "\n";
}
echo "=================================================\n";

