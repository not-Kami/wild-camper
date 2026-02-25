# AGENTS.md

## Cursor Cloud specific instructions

### Project overview

WildCampers is a vanilla PHP vehicle rental website (school project for EFP). No frameworks, no package managers, no build tools. All third-party libraries (Splide.js, Google Fonts) are loaded from CDNs.

### Running the development server

```bash
php -S 0.0.0.0:8000
```

Run from the repository root (`/workspace`). The site is then accessible at `http://localhost:8000/index.php?page=home`.

### Lint

There are no dedicated lint tools configured. Use PHP's built-in syntax checker:

```bash
find . -name "*.php" -exec php -l {} \;
```

### Testing

No automated test framework is configured. Manual browser testing is the only option.

### Known caveats

- The `skeleton.php` template overwrites the `$page` variable (via `basename($_SERVER['PHP_SELF'], '.php')`), which causes the main content area to appear empty. This is a pre-existing bug in the codebase.
- Several pages are incomplete: `fleet.php` and `about.php` are empty stubs; `booking.php` references `booking_step1/2/3.php` files that do not exist yet.
- A MariaDB SQL dump exists at `database/backup/wldcamper.sql`, but no PHP code currently connects to a database — all data is hardcoded in HTML templates.
- The routing in `index.php` checks for page files in a `pages/` directory that does not exist, so `?page=` parameters always fall through to the 404 handler.

### System dependency

PHP 8.3+ (with `php-cli`) must be installed. The update script handles this automatically via `apt-get`.
