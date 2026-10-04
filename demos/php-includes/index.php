<?php
/**
 * index.php - Main page using PHP includes
 */

// Set page-specific variables
$pageTitle = 'Demo 4 - PHP Includes';
$pageHeading = 'Simple AJAX Demo';
$pageSubtitle = 'С преизползваем header и footer';

// Include header
include 'includes/header.php';
?>

            <section class="demo-section">
                <h2>Изпрати заявка към сървъра</h2>
                
                <div class="info-box">
                    <strong>💡 Забележка:</strong> Този header и footer се зареждат от отделни PHP файлове!
                </div>
                
                <form id="ajaxForm" novalidate>
                    <fieldset>
                        <legend class="sr-only">Данни за заявка</legend>
                        
                        <div class="input-group">
                            <label for="username">Твоето име: <span class="required">*</span></label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username"
                                placeholder="Въведи име..."
                                required
                                minlength="2"
                                maxlength="50"
                                autocomplete="name"
                                aria-required="true"
                                aria-describedby="username-hint"
                            >
                            <small id="username-hint" class="input-hint">Минимум 2 символа</small>
                        </div>

                        <div class="input-group">
                            <label for="color">Любим цвят: <span class="required">*</span></label>
                            <select 
                                id="color" 
                                name="color"
                                required
                                aria-required="true"
                            >
                                <option value="">Избери цвят</option>
                                <option value="blue">Син</option>
                                <option value="green">Зелен</option>
                                <option value="red">Червен</option>
                                <option value="purple">Лилав</option>
                                <option value="orange">Оранжев</option>
                            </select>
                        </div>

                        <button type="submit" id="sendBtn" class="btn-primary">
                            Изпрати към сървъра
                        </button>
                    </fieldset>
                </form>
            </section>

            <section class="response-section" id="responseSection">
                <h2>Отговор от сървъра</h2>
                <div id="response" class="response-box">
                    <p class="placeholder">Все още няма данни...</p>
                </div>
            </section>

            <section class="info-section">
                <h3>Какво се случва?</h3>
                <ol>
                    <li><strong>Клиент</strong> (JavaScript) изпраща данни към сървъра чрез AJAX</li>
                    <li><strong>Сървър</strong> (PHP) обработва данните</li>
                    <li><strong>Сървър</strong> връща JSON отговор</li>
                    <li><strong>Клиент</strong> актуализира UI-а без презареждане на страницата</li>
                </ol>
                
                <h3>Предимства на PHP Includes</h3>
                <ul>
                    <li>✅ <strong>Преизползваемост</strong> - header и footer се пишат веднъж</li>
                    <li>✅ <strong>Лесна поддръжка</strong> - промяната на header/footer се прави само на едно място</li>
                    <li>✅ <strong>Последователност</strong> - всички страници имат еднакъв външен вид</li>
                    <li>✅ <strong>По-малко код</strong> - не се повтаря HTML код</li>
                </ul>
            </section>

    <script src="js/app.js"></script>

<?php
// Include footer
include 'includes/footer.php';
?>
