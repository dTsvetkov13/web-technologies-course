# Responsive Design и Media Queries

## Какво е Responsive Design?

**Responsive Design** е подход при разработка на уебсайтове, при които дизайнът и функционалността се адаптират към различните размери на екраните. Един уебсайт трябва да изглежда добре на:

- 📱 **Мобилни телефони** (320px - 480px)
- 📱 **Таблети** (481px - 768px)
- 💻 **Лаптопи** (769px - 1024px)
- 🖥️ **Десктопи** (1025px+)

## Защо е важен Responsive Design?

- Голяма част от потребителите открива веб сайтовете от мобилни устройства
- Google приоритизира мобилни версии при индексиране
- Един код за всички экрани — по-лесно поддържане
- По-добро потребителско преживяване

## Viewport Meta Tag

За да работи правилно responsive design, трябва да добавим `<meta viewport>` таг в `<head>`:

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Design</title>
</head>
```

| Атрибут | Описание |
|---------|----------|
| `width=device-width` | Ширината на viewport е равна на ширината на устройството |
| `initial-scale=1.0` | Начално мащабиране е 100% (без увеличение) |

## Media Queries

**Media queries** позволяват CSS правила да се прилагат условно въз основа на характеристики на медията (размер на екрана, ориентация и т.н.).

### Синтаксис

```css
@media (условие) {
    /* CSS правила, които се прилагат, когато условието е истинно */
}
```

### Съответствие по ширина на екрана

```css
/* Екрани до 600px (мобилни) */
@media (max-width: 600px) {
    body {
        font-size: 14px;
    }
    h1 {
        font-size: 18px;
    }
}

/* Екрани от 601px до 768px (таблети) */
@media (min-width: 601px) and (max-width: 768px) {
    body {
        font-size: 16px;
    }
    h1 {
        font-size: 24px;
    }
}

/* Екрани от 769px нагоре (десктопи) */
@media (min-width: 769px) {
    body {
        font-size: 18px;
    }
    h1 {
        font-size: 32px;
    }
}
```

## Common Breakpoints

Типични точки за промяна на дизайна (breakpoints):

| Устройство | Ширина | Media Query |
|-----------|--------|-------------|
| **Мобилен телефон** | 320px - 480px | `(max-width: 480px)` |
| **Малък таблет** | 481px - 600px | `(min-width: 481px) and (max-width: 600px)` |
| **Таблет** | 601px - 768px | `(min-width: 601px) and (max-width: 768px)` |
| **Малък лаптоп** | 769px - 1024px | `(min-width: 769px) and (max-width: 1024px)` |
| **Десктоп** | 1025px+ | `(min-width: 1025px)` |

## Mobile-First Подход

**Препоръчителният подход** е да разработите първо за мобилни устройства, а след това добавяте правила за по-големи екрани:

```css
/* Базови правила за мобилни */
body {
    font-size: 14px;
    margin: 0;
}

.container {
    width: 100%;
    padding: 10px;
}

h1 {
    font-size: 24px;
}

/* За таблети и нагоре */
@media (min-width: 601px) {
    .container {
        width: 90%;
        margin: 0 auto;
    }
    h1 {
        font-size: 32px;
    }
}

/* За десктопи */
@media (min-width: 1025px) {
    .container {
        width: 80%;
        max-width: 1200px;
    }
    h1 {
        font-size: 42px;
    }
}
```

## Практичен пример: Responsive Layout

### HTML

```html
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Layout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Моят Сайт</h1>
        <nav>
            <a href="#">Начало</a>
            <a href="#">За нас</a>
            <a href="#">Контакти</a>
        </nav>
    </header>

    <main>
        <section class="content">
            <article class="card">
                <h2>Статия 1</h2>
                <p>Описание на статията...</p>
            </article>
            <article class="card">
                <h2>Статия 2</h2>
                <p>Описание на статията...</p>
            </article>
            <article class="card">
                <h2>Статия 3</h2>
                <p>Описание на статията...</p>
            </article>
        </section>
        
        <aside class="sidebar">
            <h3>Страничен панел</h3>
            <p>Допълнителна информация...</p>
        </aside>
    </main>

    <footer>
        <p>&copy; 2025 Моят Сайт. Всички права запазени.</p>
    </footer>
</body>
</html>
```

### CSS — Mobile-First

```css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
}

/* ========== МОБИЛНА ВЕРСИЯ (по подразбиране) ========== */

header {
    background: #333;
    color: white;
    padding: 15px;
    text-align: center;
}

header h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 8px 12px;
    background: #555;
    border-radius: 4px;
    font-size: 14px;
}

main {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 15px;
}

.content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 15px;
}

.card {
    background: #f4f4f4;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.sidebar {
    background: #e9e9e9;
    padding: 15px;
    border-radius: 8px;
}

footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 20px;
    font-size: 14px;
}

/* ========== ТАБЛЕТ (601px+) ========== */
@media (min-width: 601px) {
    header h1 {
        font-size: 32px;
    }

    nav {
        gap: 15px;
    }

    nav a {
        font-size: 16px;
        padding: 10px 16px;
    }

    main {
        flex-direction: row;
        padding: 25px;
        margin: 0 auto;
        max-width: 100%;
    }

    .content {
        flex: 2;
        grid-template-columns: 1fr 1fr;
    }

    .sidebar {
        flex: 1;
        height: fit-content;
    }

    .card h2 {
        font-size: 24px;
    }
}

/* ========== ДЕСКТОП (1025px+) ========== */
@media (min-width: 1025px) {
    header h1 {
        font-size: 40px;
    }

    body {
        font-size: 16px;
    }

    main {
        max-width: 1200px;
        padding: 30px;
    }

    .content {
        grid-template-columns: repeat(3, 1fr);
    }

    .card {
        padding: 20px;
    }

    .card h2 {
        font-size: 28px;
    }
}
```

## Други Media Query Условия

### Ориентация (Portrait/Landscape)

```css
/* Вертикална ориентация (портретна) */
@media (orientation: portrait) {
    body {
        margin: 5px;
    }
}

/* Хоризонтална ориентация (пейзажна) */
@media (orientation: landscape) {
    main {
        display: flex;
        flex-direction: row;
    }
}
```

### Densidade на пиксели (Retina дисплеи)

```css
/* За висока резолюция дисплеи (2x пиксели) */
@media (-webkit-min-device-pixel-ratio: 2),
       (min-resolution: 192dpi) {
    img {
        width: 50%;
    }
}
```

### Преференции на потребителя

```css
/* За потребители, които предпочитат тъмен режим */
@media (prefers-color-scheme: dark) {
    body {
        background: #1e1e1e;
        color: #fff;
    }
}

/* За потребители, които предпочитат по-малко движение */
@media (prefers-reduced-motion: reduce) {
    * {
        animation: none !important;
        transition: none !important;
    }
}
```

## Best Practices

✅ **ДОБРЕ:**

```css
/* Mobile-first подход */
.container {
    width: 100%;
    font-size: 14px;
}

@media (min-width: 768px) {
    .container {
        width: 750px;
    }
}

@media (min-width: 1200px) {
    .container {
        width: 1170px;
    }
}
```

❌ **ЛОШО:**

```css
/* Desktop-first подход — по-трудно за мобилни */
.container {
    width: 1200px;
    font-size: 18px;
}

@media (max-width: 768px) {
    .container {
        width: 100%;
        font-size: 14px;
    }
}
```

### Препоръки

1. **Започнете с мобилни** — добавяйте функционалност за по-големи екрани
2. **Използвайте относителни единици** — `rem`, `em`, `%` вместо `px`
3. **Тестирайте на множество устройства** — браузър DevTools, действителни телефони
4. **Оптимизирайте производителността** — намалявайте размера на изображенията за мобилни
5. **Поддържайте читаемост** — хубав contrast, достатъчен размер на шрифт (минимум 16px)
6. **Елемент за докосване** — минимум 44x44px за мобилни бутони
