# Little Fern Coffee — CSS Challenges

Open `index.html` in your browser (or the live preview), then work through these
challenges **in order**. Each one builds on the one before.

For each challenge, ask Claude to make the change *in the existing files*
(`index.html` and `style.css`). Don't start over — improve what's there.
After each change, open DevTools (F12) and inspect the elements to see which CSS rules are doing the work.

---

## Challenge 1: A real navigation bar (Flexbox)

**Concepts:** `display: flex`, `justify-content`, `align-items`, `gap`

**Goal:** Right now the logo sits on top of the links. Put the logo on the left and the
links on the right, all on one line and vertically centred. Swap the `margin-right` on
the nav links for `gap`.

**Expected result:** A slim, single-row dark green header. "Little Fern Coffee Co." on the
left, "Menu · Our Beans · Visit Us" on the right, evenly spaced.

**Try asking:** *"Use Flexbox to put the logo and the nav links on one row in the header."*

---

## Challenge 2: Menu cards in a grid (CSS Grid + spacing)

**Concepts:** `display: grid`, `grid-template-columns`, `repeat()`, `fr` units, `gap`, margin vs. padding

**Goal:** The six menu items are stacked in one long column. Turn `.menu-list` into a
3-column grid. Remove the `margin-bottom` from the cards and let the grid's `gap` handle
the spacing. Then do the same thing for the two "Visit us" boxes (2 columns).

**Expected result:** Two rows of three equal-width cards with equal space between them.
The prices line up along the bottom of each card.

**Hint:** To push the price to the bottom, make each `.menu-item` a flex column and give
`.price` `margin-top: auto`.

---

## Challenge 3: Hover effects and transitions

**Concepts:** `:hover`, `transition`, `transform`, `box-shadow`

**Goal:** Make the page feel alive when you move the mouse.
- Buttons get slightly darker (or fill in, for the outline button) on hover.
- Menu cards lift up a few pixels and get a soft shadow on hover.
- Nav links get a saffron underline on hover.

All changes should animate smoothly over about 0.2–0.3 seconds instead of jumping.

**Expected result:** Hovering any button, card or nav link shows a smooth, subtle change.
Nothing moves when you are not hovering.

**Bonus:** Wrap the movement in `@media (prefers-reduced-motion: no-preference)` so
people who turned off animations on their device don't see it.

---

## Challenge 4: Positioning (relative, absolute, sticky)

**Concepts:** `position: relative` / `absolute` / `sticky`, `top`, `right`, `z-index`

**Goal:**
1. Add a small **"Bestseller"** badge to the Flat White and Cold Brew cards. The badge
   should sit in the top-right corner of the card, partly overlapping its edge.
   (The card needs `position: relative`; the badge needs `position: absolute`.)
2. Make the header **sticky**, so it stays at the top of the screen while you scroll.

**Expected result:** Two saffron pill-shaped badges pinned to card corners. When you
scroll down, the green header stays visible above the content.

---

## Challenge 5: Responsive design (media queries)

**Concepts:** `@media`, breakpoints, mobile-first CSS, `clamp()`

**Goal:** Your grids from Challenge 2 look squashed on a phone. Make the layout adapt:
- **Phones (under 600px):** menu cards in 1 column, Visit boxes stacked, nav links
  wrap below the logo.
- **Tablets (600–900px):** menu in 2 columns.
- **Desktop (over 900px):** menu in 3 columns, and the hero text and the
  "Today's pour-over" card side by side.

Also make the big hero heading shrink smoothly on small screens using `clamp()`.

**Expected result:** Resize the browser (or use DevTools' device toolbar) and watch the
layout change from 1 → 2 → 3 columns. Nothing should ever scroll sideways.

---

### Done all five?
Pick your own: a dark mode with `prefers-color-scheme`, a hero background pattern with
`linear-gradient`, or a CSS-only animated steam effect on the brew card.
