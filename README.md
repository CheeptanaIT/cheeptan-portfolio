# Cheeptan Portfolio

Personal portfolio / resume site for **Cheeptan Yenlad** — IT Infrastructure & Operations Specialist.

**Live site:** [cheeptana.infinityfree.io](http://cheeptana.infinityfree.io/)

## Features

- Bilingual Thai / English with a persistent language switch (cookie-based)
- Working contact form — sends via SMTP (PHPMailer) in production, falls back to `mail()` locally
- Portfolio page for project and document case studies
- Blog backed by MySQL (schema included, currently unlinked while hosting is finalized)
- Responsive layout, reviewed against WCAG accessibility basics
- Auto-deploys to hosting via GitHub Actions on every push to `master`

## Tech stack

- PHP 8, no framework — a single [config.php](config.php) drives all page content
- MySQL / MariaDB via PDO for the blog
- Vanilla CSS and JavaScript, no build step
- [PHPMailer](includes/PHPMailer) for SMTP email delivery
- GitHub Actions + FTP deploy to shared hosting

## Project structure

```
config.php            All site copy/content, split by language (th/en)
includes/             Shared layout (header/footer), language + DB helpers, icons
index.php             Home page (hero, about, competencies, achievements, contact)
portfolio.php         Portfolio / case studies page
blog.php, blog-post.php  MySQL-backed blog listing and post detail
contact-handler.php   Contact form submission endpoint
assets/               CSS, JS, images
schema.sql            MySQL schema + seed data for the blog
.github/workflows/    CI deploy workflow
```

## Local development

```bash
php -S 127.0.0.1:8899
```

The blog feature additionally needs a local MySQL/MariaDB server, with the database
created first and the schema imported into it:

```bash
mysql -u root -e "CREATE DATABASE p1_home_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
mysql -u root p1_home_blog < schema.sql
```

## Deployment

Every push to `master` triggers [.github/workflows/deploy.yml](.github/workflows/deploy.yml), which uploads the site to hosting via FTP using GitHub Secrets (`FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`, `FTP_SERVER_DIR`).

Database and SMTP credentials are read from environment variables at runtime — see [.env.example](.env.example) for the full list and where to find each value on the hosting side.

## License

Personal project — not licensed for reuse.
