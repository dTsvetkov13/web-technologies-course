<?php include 'includes/header.php'; ?>
<main>
    <h2>Register User</h2>
    <form method="POST" action="api/register.php">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Register</button>
    </form>
</main>
<?php include 'includes/footer.php'; ?>
