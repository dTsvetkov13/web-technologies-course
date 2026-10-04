<?php
require_once 'config.php';
// =====================
// XSS Problem (uncomment to test)

$pdo = getConnection();
$users = $pdo->query("SELECT username FROM users")->fetchAll();
foreach ($users as $user) {
    // Direct output (vulnerable)
    echo "<div>Username: " . $user['username'] . "</div>";
}

// =====================
// XSS Solution (uncomment to test)
/*
$pdo = getConnection();
$users = $pdo->query("SELECT username FROM users")->fetchAll();
foreach ($users as $user) {
    // Escaped output (secure)
    echo "<div>Username: " . htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . "</div>";
}
*/
// =====================
// CORS Problem (uncomment to test)
/*
// No headers set, browser blocks cross-origin requests
*/
// =====================
// CORS Solution (uncomment to test)
/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
*/
