<?php
/**
 * about.php - About page demonstrating header/footer reuse
 */

// Set page-specific variables
$pageTitle = 'За проекта - Demo 4';
$pageHeading = 'За този проект';
$pageSubtitle = 'Демонстрация на PHP includes';

// Include header
include 'includes/header.php';
?>

            <section class="demo-section">
                <h2>Как работят PHP Includes?</h2>
                
                <div class="code-example">
                    <h3>В началото на файла:</h3>
                    <pre><code>&lt;?php
// Задаваме променливи за страницата
$pageTitle = 'Заглавие';
$pageHeading = 'Heading';

// Зареждаме header
include 'includes/header.php';
?&gt;</code></pre>
                </div>
                
                <div class="code-example">
                    <h3>В края на файла:</h3>
                    <pre><code>&lt;?php
// Зареждаме footer
include 'includes/footer.php';
?&gt;</code></pre>
                </div>
            </section>

            <section class="info-section">
                <h2>Include vs Require</h2>
                
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Команда</th>
                            <th>Поведение при грешка</th>
                            <th>Кога да използваме</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>include</code></td>
                            <td>Warning - скриптът продължава</td>
                            <td>За незадължителни файлове</td>
                        </tr>
                        <tr>
                            <td><code>require</code></td>
                            <td>Fatal Error - скриптът спира</td>
                            <td>За задължителни файлове (header, config)</td>
                        </tr>
                        <tr>
                            <td><code>include_once</code></td>
                            <td>Warning + зарежда само веднъж</td>
                            <td>За файлове с функции/класове</td>
                        </tr>
                        <tr>
                            <td><code>require_once</code></td>
                            <td>Fatal Error + зарежда само веднъж</td>
                            <td>За конфигурационни файлове</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="demo-section">
                <h2>Примери за употреба</h2>
                
                <div class="example-card">
                    <h3>1. Header и Footer</h3>
                    <p>Използваме <code>include</code> или <code>require</code> за header/footer, които се повтарят на всяка страница.</p>
                </div>
                
                <div class="example-card">
                    <h3>2. Database Connection</h3>
                    <p>Използваме <code>require_once</code> за database config файл, за да сме сигурни, че е зареден само веднъж.</p>
                </div>
                
                <div class="example-card">
                    <h3>3. Helper Functions</h3>
                    <p>Използваме <code>include_once</code> за файлове с функции, за да избегнем дублиране.</p>
                </div>
            </section>

<?php
// Include footer
include 'includes/footer.php';
?>
