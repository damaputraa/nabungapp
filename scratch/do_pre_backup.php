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

// Backup all tables
$tables = ['users', 'savings', 'savings_targets', 'transactions', 'wallets', 'bills', 'savings_challenges', 'budget_limits', 'savings_goals', 'activity_logs', 'announcements'];
$dump = "-- PRE-IMPORT BACKUP " . date('Y-m-d H:i:s') . "\n\n";

foreach ($tables as $t) {
    try {
        $rows = $pdo->query("SELECT * FROM $t")->fetchAll(PDO::FETCH_ASSOC);
        $dump .= "-- Table: $t (" . count($rows) . " rows)\n";
        foreach ($rows as $r) {
            $cols = array_map(function($c) { return "`$c`"; }, array_keys($r));
            $vals = array_map(function($v) use ($pdo) {
                return $v === null ? "NULL" : $pdo->quote($v);
            }, array_values($r));
            $dump .= "INSERT INTO `$t` (" . implode(', ', $cols) . ") VALUES (" . implode(', ', $vals) . ");\n";
        }
        $dump .= "\n";
    } catch(Exception $e) {
        $dump .= "-- Skipped $t: " . $e->getMessage() . "\n\n";
    }
}

file_put_contents('scratch/pre_import_backup.sql', $dump);
echo "Pre-import backup saved to scratch/pre_import_backup.sql (" . strlen($dump) . " bytes)\n";

