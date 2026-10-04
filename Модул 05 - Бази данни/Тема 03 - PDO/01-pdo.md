# PDO — PHP Data Objects

## Какво е PDO?

**PDO** (PHP Data Objects) е абстракционен слой за достъп до бази данни в PHP. Предоставя единен интерфейс за работа с различни СУБД (MySQL, PostgreSQL, SQLite и др.).

### Защо PDO?

- **Сигурност** — prepared statements предотвратяват SQL injection
- **Портативност** — лесна смяна на базата данни
- **Обработка на грешки** — чрез exceptions

## Свързване с базата

```php
<?php
class Db {
    private $connection;

    public function __construct() {
        $dbhost = "localhost";
        $dbName = "myfirstdatabase";
        $userName = "root";
        $userPassword = "";

        $this->connection = new PDO(
            "mysql:host=$dbhost;dbname=$dbName;charset=utf8mb4",
            $userName,
            $userPassword,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        // Включване на exceptions при грешки
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
```

### DSN формат

```
mysql:host=localhost;dbname=myfirstdatabase;charset=utf8mb4
```

| Част | Описание |
|------|----------|
| `mysql:` | Драйвер за базата |
| `host=` | Адрес на сървъра |
| `dbname=` | Име на базата |
| `charset=` | Кодировка на връзката — винаги `utf8mb4` |

### Настройки

| Настройка | Описание |
|-----------|----------|
| `PDO::ATTR_ERRMODE` | Как да се обработват грешки |
| `PDO::ERRMODE_EXCEPTION` | Хвърля exception при грешка |
| `PDO::ATTR_DEFAULT_FETCH_MODE` | Формат на върнатите данни |
| `PDO::FETCH_ASSOC` | Връща асоциативен масив |
| `PDO::ATTR_EMULATE_PREPARES` | `false` — истински prepared statements от сървъра |

> **Защо `utf8mb4`, а не `utf8`?** В MySQL `utf8` е непълен — побира само 3 байта на символ и не може да запише емоджи и някои редки символи. `utf8mb4` е пълният UTF-8. Задавайте го в DSN, не с `SET NAMES`, защото тогава важи от първата заявка.

## Prepared Statements

### Защо са задължителни?

```php
<?php
// ❌ ОПАСНО — SQL Injection!
$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email = '$email'";

// ✅ БЕЗОПАСНО — Prepared Statement
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
?>
```

Ако потребителят въведе `' OR 1=1 --` като имейл, без prepared statement ще получи достъп до всички записи.

## CRUD операции

### CREATE — Вмъкване

```php
<?php
$pdo = (new Db())->getConnection();

$query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email)";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':username' => $username,
    ':pwd' => $hashedPassword,
    ':email' => $email
]);

// Получаване на ID на новия запис
$newId = $pdo->lastInsertId();
echo "Inserted user with ID: $newId";
?>
```

### READ — Четене

```php
<?php
// Един запис
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(); // Връща един ред (или false)

// Много записи
$stmt = $pdo->prepare("SELECT * FROM users WHERE age > :age");
$stmt->execute(['age' => 18]);
$users = $stmt->fetchAll(); // Връща масив от редове

// Проверка дали има резултати
if ($stmt->rowCount() === 0) {
    echo "Няма намерени потребители";
}
?>
```

### UPDATE — Обновяване

```php
<?php
$stmt = $pdo->prepare("UPDATE users SET username = :name WHERE id = :id");
$stmt->execute([
    'name' => 'Ново Име',
    'id' => 5
]);

echo "Updated rows: " . $stmt->rowCount();
?>
```

### DELETE — Изтриване

```php
<?php
$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => 5]);
?>
```

## Обработка на грешки

```php
<?php
try {
    $pdo = (new Db())->getConnection();

    $stmt = $pdo->prepare("INSERT INTO users (email, password, name, age) VALUES (:email, :password, :name, :age)");
    $stmt->execute([
        'email' => $user->getEmail(),
        'password' => $user->getHashedPassword(),
        'name' => $user->getName(),
        'age' => $user->getAge(),
    ]);

    $userId = $pdo->lastInsertId();
    echo json_encode(['success' => true, 'id' => $userId]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'ERROR',
        'message' => 'Грешка в базата данни'
    ]);
    // Логвайте грешката, не я показвайте на потребителя:
    error_log($e->getMessage());
}
?>
```

> ⚠️ **Никога** не показвайте `$e->getMessage()` на потребителя в production — може да разкрие информация за структурата на базата.

## Пълен пример: Регистрация

### index.php (форма)

```html
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <form action="includes/register.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit">Регистрация</button>
    </form>
</body>
</html>
```

### includes/db.php

```php
<?php
function getDB() {
    $dsn = "mysql:host=localhost;dbname=myfirstdatabase";
    try {
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        throw new PDOException("Грешка при връзка: " . $e->getMessage());
    }
}
?>
```

### includes/register.php

```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once "db.php";

        $pdo = getDB();
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':pwd' => password_hash($pwd, PASSWORD_DEFAULT),
            ':email' => $email
        ]);

        $pdo = null;  // затваряне на връзката
        $stmt = null;

        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        echo "Грешка: " . $e->getMessage();
    }
} else {
    header("Location: ../index.php");
}
?>
```

## Пълен пример: Логин

### login.html

```html
<form id="login-form">
    <input type="email" name="email" placeholder="Имейл" required>
    <input type="password" name="pwd" placeholder="Парола" required>
    <button type="submit">Вход</button>
</form>
<div id="response"></div>

<script>
const form = document.getElementById("login-form");

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const data = {
        email: form.email.value,
        password: form.pwd.value,
    };

    const res = await fetch("includes/login_user.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
    });

    const result = await res.json();
    document.getElementById("response").textContent = result.message;

    if (result.status === "SUCCESS") {
        window.location.href = "homepage.html";
    }
});
</script>
```

### includes/login_user.php

```php
<?php
require_once("db.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["email"], $data["password"])) {
    http_response_code(400);
    echo json_encode(["status" => "ERROR", "message" => "Липсващи данни!"]);
    exit;
}

try {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT id, pwd FROM users WHERE email = :email");
    $stmt->execute(["email" => $data["email"]]);

    if ($stmt->rowCount() === 0) {
        http_response_code(400);
        echo json_encode(["status" => "ERROR", "message" => "Невалиден имейл!"]);
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($data["password"], $user["pwd"])) {
        http_response_code(400);
        echo json_encode(["status" => "ERROR", "message" => "Грешна парола!"]);
        exit;
    }

    session_start();
    $_SESSION["user_id"] = $user["id"];

    echo json_encode(["status" => "SUCCESS", "message" => "Успешен вход!"]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["status" => "ERROR", "message" => "Грешка в сървъра!"]);
}
?>
```

## Затваряне на връзката

```php
<?php
$pdo = null;   // затваря PDO връзката
$stmt = null;  // освобождава statement-а
?>
```

PHP автоматично затваря връзката в края на скрипта, но е добра практика да го направите ръчно.
