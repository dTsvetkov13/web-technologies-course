<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Demo 4 - PHP Includes'; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo isset($pageHeading) ? $pageHeading : 'PHP Includes Demo'; ?></h1>
            <p class="subtitle"><?php echo isset($pageSubtitle) ? $pageSubtitle : 'Преизползваеми PHP файлове'; ?></p>
            
            <!-- Navigation menu -->
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>Начало</a></li>
                    <li><a href="about.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'class="active"' : ''; ?>>За проекта</a></li>
                </ul>
            </nav>
        </header>

        <main>
