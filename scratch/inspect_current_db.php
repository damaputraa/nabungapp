<?php
define('BASEPATH', 'system/');
require 'application/config/database.php';
$db = $db['default'];

$pdo = new PDO("mysql:host={$db['hostname']};dbname={$db['database']};charset={$db['char_set']}", $db['username'], $db['password']);

echo "=== CURRENT DB DATA ===\n";
foreach (['users', 'savings', 'savings_targets', 'transactions', 'wallets'] as $tbl) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM $tbl");
    echo "$tbl: " . $stmt->fetchColumn() . " rows\n";
}

echo "\n--- USERS IN DB ---\n";
$users = $pdo->query("SELECT id, username, email, role FROM users")->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $u) {
    echo "ID: {$u['id']} | Username: {$u['username']} | Role: {$u['role']}\n";
}

echo "\n--- WALLETS IN DB ---\n";
$wallets = $pdo->query("SELECT id, user_id, name, type, balance, is_default FROM wallets")->fetchAll(PDO::FETCH_ASSOC);
foreach ($wallets as $w) {
    echo "ID: {$w['id']} | User: {$w['user_id']} | Name: {$w['name']} | Balance: {$w['balance']} | Default: {$w['is_default']}\n";
}

echo "\n--- TABLE STRUCTURE CHECK ---\n";
foreach (['savings', 'transactions'] as $tbl) {
    echo "$tbl columns:\n";
    $cols = $pdo->query("DESCRIBE $tbl")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($cols as $c) {
        echo "  - {$c['Field']} ({$c['Type']})\n";
    }
}

