# Practices - Module 02: CSS

🇧🇬 [Българска версия](README.md)

A practice is the task we work on in class. This time you don't write a page from scratch: you get a **working website** and improve it step by step, the way you would at a real company.

## The project: Little Fern Coffee Co.

Little Fern is a small coffee shop and roastery. Its website already exists: it has content, colours and fonts, but the layout is unfinished. The logo sits above the menu, the menu items are one long column, nothing reacts to the mouse, and on a phone everything is squashed.

Your job is to finish it in **5 challenges**. Each one practises a different part of CSS:

| Challenge | What you do | CSS concepts | Lessons |
|-----------|-------------|--------------|---------|
| 1 - Navigation bar | logo and links on one row | `display: flex`, `justify-content`, `gap` | Topic 03 |
| 2 - Menu grid | cards in 3 columns, prices lined up at the bottom | `display: grid`, `fr`, `gap` | Topic 04 |
| 3 - Hover effects | buttons and cards react to the mouse | `:hover`, `transition`, `transform` | Topic 01, Topic 04 |
| 4 - Positioning | "Bestseller" badge and sticky header | `position: relative / absolute / sticky` | Topic 02 |
| 5 - Responsive | 1 / 2 / 3 columns depending on the screen | `@media`, `clamp()`, mobile first | Topic 04 |

Do them **in order**. Each one builds on the one before.

## How we work

1. **Open the site** `coffee-shop/en/index.html` in the browser and `style.css` in your editor.
2. **Open the challenges** in one of three formats (same content):
   - [CHALLENGES.md](coffee-shop/en/CHALLENGES.md) - the full description, with hints
   - `coffee-shop/en/challenges/index.html` - a short one-screen overview
   - `coffee-shop/en/tickets/index.html` - the same tasks as a sprint of 5 tickets, the way you get them at work
3. **Change the existing files.** Don't start over. Improve what's already there.
4. **After each challenge, open DevTools (F12)** and inspect the elements: which rules apply, which are crossed out, and why.
5. **Stuck?** Compare with `coffee-shop/en/solution/`. Every change there is marked with a `CHALLENGE n` comment. Try on your own first.

> **Working with Claude or another AI assistant?** Give it one challenge at a time and ask it to change the existing code, not to write a new site. Then read what it changed and why.

## Project folder

```
coffee-shop/
├── bg/                    ← Bulgarian
│   ├── index.html
│   ├── style.css
│   ├── задачи.md
│   ├── challenges/
│   ├── tickets/
│   └── solution/
└── en/                    ← English
    ├── index.html         ← the starter site (work here)
    ├── style.css
    ├── CHALLENGES.md      ← full challenge descriptions
    ├── challenges/        ← challenges on one screen
    ├── tickets/           ← challenges as a sprint
    └── solution/          ← all 5 challenges solved
```

Both versions use **the same CSS**. Only the text and the code comments differ. Every page links to the other language (`EN` / `BG`).

The site is plain HTML and CSS. Open it with a double click, no server needed.

## Where to look

- **The module lessons** (in Bulgarian) - [CSS basics](../Тема%2001%20-%20Основи%20на%20CSS/01-основи-на-css.md), [Box Model](../Тема%2002%20-%20Box%20Model/01-box-model.md), [Flexbox](../Тема%2003%20-%20Flexbox/01-flexbox.md), [Responsive design](../Тема%2004%20-%20Бонус/01-responsive-design-media-queries.md).
- **[MDN CSS reference](https://developer.mozilla.org/en-US/docs/Web/CSS/Reference)** - every property: what it does, which values it takes, examples.
- **[`clamp()` on MDN](https://developer.mozilla.org/en-US/docs/Web/CSS/clamp)** - for Challenge 5. It isn't in the lessons, but it's a single function: minimum, preferred value, maximum.
- **DevTools device mode** (`Ctrl + Shift + M`) - for Challenge 5, to see the site as it looks on a phone.
