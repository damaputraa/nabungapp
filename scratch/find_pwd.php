<?php
define('BASEPATH', 'system/');
define('ENVIRONMENT', 'development');

require 'application/config/database.php';
$db = $db['default'];

$pdo = new PDO(
    "mysql:host={$db['hostname']};dbname={$db['database']};charset={$db['char_set']}",
    $db['username'],
    $db['password']
);

$users = $pdo->query("SELECT id, username, password FROM users")->fetchAll(PDO::FETCH_ASSOC);
$candidates = ['password', 'dama', '123456', '12345678', 'dama123', 'admin', 'dama21', 'rahmad', 'intan', '12345'];

foreach ($users as $u) {
    $found = null;
    foreach ($candidates as $c) {
        if (password_verify($c, $u['password'])) {
            $found = $c;
            break;
        }
    }
    echo "User {$u['username']} (ID {$u['id']}): " . ($found ?: "Custom hash") . "\n";
}

