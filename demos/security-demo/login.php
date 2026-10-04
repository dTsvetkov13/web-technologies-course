<?php include 'includes/header.php'; ?>
<main>
    <h2>Login</h2>
    <form method="POST" action="api/login.php">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
