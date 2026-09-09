<?php
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');
require 'application/config/database.php';
$db = $db['default'];
$pdo = new PDO("mysql:host={$db['hostname']};dbname={$db['database']}", $db['username'], $db['password']);

$u4 = $pdo->query("SELECT * FROM users WHERE id = 4")->fetch(PDO::FETCH_ASSOC);
if ($u4) {
    $t_cnt = $pdo->query("SELECT COUNT(*) FROM transactions WHERE user_id = 4")->fetchColumn();
    $s_cnt = $pdo->query("SELECT COUNT(*) FROM savings WHERE user_id = 4")->fetchColumn();
    echo "User 4 ('{$u4['username']}'): $t_cnt transactions, $s_cnt savings\n";
    if ($t_cnt == 0 && $s_cnt == 0) {
        $pdo->exec("DELETE FROM wallets WHERE user_id = 4");
        $pdo->exec("DELETE FROM users WHERE id = 4");
        echo "Deleted temporary test user 4 ('intan2') and its wallet\n";
    }
}

