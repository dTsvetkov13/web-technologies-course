<?php
require_once 'config.php';
// =====================
// SQL Injection Problem (uncomment to test)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Vulnerable query
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $pdo->query($sql);
    if ($result->fetch()) {
        echo 'Login success (INSECURE)';
    } else {
        echo 'Login failed';
    }
}

// =====================
// SQL Injection Solution (uncomment to test)
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Secure query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    if ($stmt->fetch()) {
        echo 'Login success (SECURE)';
    } else {
        echo 'Login failed';
    }
}
*/
// =====================
// Hashed Password Login (uncomment to test)
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = getConnection();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $row = $stmt->fetch();
    if ($row && password_verify($password, $row['password'])) {
        echo 'Login success (SECURE)';
    } else {
        echo 'Login failed';
    }
}
*/
