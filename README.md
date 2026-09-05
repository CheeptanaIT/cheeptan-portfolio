# Cheeptan Portfolio

Personal portfolio / resume site for **Cheeptan Yenlad** — IT Infrastructure & Operations Specialist.

**Live site:** [cheeptana.infinityfree.io](http://cheeptana.infinityfree.io/)

## Features

- Bilingual Thai / English with a persistent language switch (cookie-based)
- Working contact form — sends via SMTP (PHPMailer) in production, falls back to `mail()` locally
- Portfolio page for project and document case studies
- Blog, Services, and Shop content are all backed by MySQL (schema included), each managed from the
  password-protected `/admin/` panel — no code changes or deploys needed to edit content
- Services page (freelance IT services list) and Shop page (cart + email/LINE order request) — each can be turned on/off independently, see [Feature toggles](#feature-toggles)
- Responsive layout, reviewed against WCAG accessibility basics
- Auto-deploys to hosting via GitHub Actions on every push to `master`

## Tech stack

- PHP 8, no framework — [config.php](config.php) merges [config/th.php](config/th.php) and [config/en.php](config/en.php), which drive page chrome/copy (nav labels, section text)
- MySQL / MariaDB via PDO for Blog, Services, and Shop content
- Vanilla CSS and JavaScript, no build step
- [PHPMailer](includes/PHPMailer) for SMTP email delivery
- GitHub Actions + FTP deploy to shared hosting

## Project structure

Every URL on the site is unchanged (`/blog.php`, `/shop.php`, etc.) — the files behind them just
live in subfolders now, grouped by responsibility. [.htaccess](.htaccess) (production/Apache) and
[router.php](router.php) (local `php -S`) both rewrite those URLs to their real file location; see
[Local development](#local-development) and [Deployment](#deployment) below.

```
config.php            Merges config/th.php + config/en.php for the page files to consume
config/th.php         All Thai site copy/content
config/en.php         All English site copy/content
includes/             Shared layout (header/footer), language + DB helpers, icons, feature toggles
pages/                One file per route — the actual URL still maps to the bare filename:
  index.php             Home page (hero, about, competencies, achievements, contact) — also "/"
  portfolio.php         Portfolio / case studies page
  blog.php, blog-post.php  MySQL-backed blog listing and post detail
  services.php          MySQL-backed services list (freelance IT work), links out to the contact form
  shop.php, cart.php    MySQL-backed product listing, cart (localStorage), and checkout form
actions/               Form submission endpoints (called via fetch() from assets/js/*.js)
  contact-handler.php    Contact form submission endpoint
  order-handler.php      Shop checkout endpoint; re-validates item ids/prices against the
                          `products` table before emailing the order, ignoring client-sent values
admin/                Password-protected CRUD for blog posts, services, products, and the
                      Blog/Services/Shop/Portfolio menu toggles (settings.php)
assets/               CSS, JS, images
schema.sql            MySQL schema + seed data for blog_posts, services, and products
.github/workflows/    CI deploy workflow
```

## Feature toggles

Blog, Services, Shop, and Portfolio can each be switched on/off independently from
**`/admin/settings.php`** — check a box, hit Save, no code change or deploy needed. Turning one off
hides its nav link (Shop also controls the Cart link) and sends anyone who hits the page URL
directly back to the home page; nothing is deleted, flip it back on any time.

The toggles live in the `settings` table (see [schema.sql](schema.sql)), read through
[includes/features.php](includes/features.php)'s `get_features()`. If the DB is unreachable or the
table doesn't exist yet (e.g. before the migration below has run), it falls back to hardcoded
defaults — Blog/Services/Shop on, Portfolio off — matching the site's behavior before this table
existed, so a DB hiccup can't accidentally take down the whole nav.

Service listings and shop products/prices live in MySQL (`services` and `products` tables) and are
edited from `/admin/`, same as blog posts. Page chrome around them — the eyebrow/title/subtitle,
button labels, currency symbol, empty/error-state text — stays in `config.php` (`services`, `shop`,
`cart` keys, one per language) since that's copy, not inventory. The Shop's "order" flow only
emails/collects the request; it doesn't take payment or track stock.

## Local development

```bash
php -S 127.0.0.1:8899 router.php
```

`router.php` maps the site's plain URLs (`/blog.php`, `/cart.php`, ...) to their real location
under `pages/`/`actions/`, the same way [.htaccess](.htaccess) does on the production Apache host.
It's dev-only — don't skip the `router.php` argument, or every page will 404 — and is excluded from
deploy since production doesn't need it.

Blog, Services, and Shop all need a local MySQL/MariaDB server, with the database created first
and the schema imported into it:

```bash
mysql -u root -e "CREATE DATABASE p1_home_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
mysql -u root p1_home_blog < schema.sql
```

## Admin panel

Blog posts, services, products, and the menu toggles are all managed at `/admin/` (list, create,
edit, delete for each — no public link, reached by typing the URL directly). It's protected by a
single password, stored only as a hash via `ADMIN_PASSWORD_HASH` — never the plaintext. Generate it
once with:

```bash
php -r "echo password_hash('your-password', PASSWORD_DEFAULT), PHP_EOL;"
```

Then set the resulting hash as the `ADMIN_PASSWORD_HASH` value in `includes/local.env.php`
(local dev) or as a GitHub Secret of the same name (production).

## Deployment

Every push to `master` triggers [.github/workflows/deploy.yml](.github/workflows/deploy.yml), which uploads the site to hosting via FTP using GitHub Secrets (`FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`, `FTP_SERVER_DIR`).

Database and SMTP credentials are read from environment variables at runtime — see [.env.example](.env.example) for the full list and where to find each value on the hosting side.

New MySQL tables (like `services`/`products`) aren't created automatically by a deploy — visit a
one-off migration script's URL once in a browser after it ships (it uses `CREATE TABLE IF NOT
EXISTS`, so it's safe to load twice), then delete the script in a follow-up commit. That's the same
approach `update-blog-post.php` used for `blog_posts` earlier in this project's history.

## License

Personal project — not licensed for reuse.
