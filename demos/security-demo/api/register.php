<?php
require_once 'config.php';
// =====================
// Plaintext Password (uncomment to test)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    echo 'User registered (INSECURE)';
}

// =====================
// Hashed Password (uncomment to test)
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
    echo 'User registered (SECURE)';
}
*/
