# D3WAT Confirmation Link Receiver

Laravel + Filament app that records attendance confirmations from WhatsApp reminder links sent by the d3wat invite sender.

## Features

- **Direct mode**: `GET /confirm?phone=9665XXXXXXXX&name=...` — per-invitee personalized links
- **Session mode**: `GET /confirm` — one shared link for all invitees; auto-confirms on visit with browser-session deduplication
- **Filament admin** at `/admin` — manage events, view totals, export CSV
- **SQLite only** — simple hosting, no MySQL/Redis/queues

## Local setup

```bash
composer install
cp .env.example .env   # if needed
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Default admin (created by migration):

- Email: `admin@d3wat.test`
- Password: `password`

## Environment defaults

```env
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
APP_URL=http://127.0.0.1:8000
```

## Public URLs

| Mode | URL | Use case |
|------|-----|----------|
| Session (shared) | `{APP_URL}/confirm` | Paste into d3wat with "رابط جلسة موحد" checked |
| Direct (per invitee) | `{APP_URL}/confirm?phone=9665…&name=…` | Generated automatically by d3wat reminder mode |

## Admin workflow (session mode)

1. Log in at `/admin`
2. Create a **فعالية** (event) and mark it **نشطة**
3. Copy the public link `https://your-domain.com/confirm`
4. In d3wat reminder mode: enable **رابط جلسة موحد**, paste the link, send reminders
5. Monitor confirmation count in Filament

## Shared hosting deploy

1. Upload project; set web root to `public/`
2. `composer install --no-dev --optimize-autoloader`
3. Copy `.env.example` → `.env`, set `APP_URL` and `APP_ENV=production`, `APP_DEBUG=false`
4. `php artisan key:generate`
5. Ensure `database/database.sqlite` exists and is writable
6. `php artisan migrate --force`
7. Writable: `storage/`, `bootstrap/cache/`, `database/`

**Backup**: download `database/database.sqlite` periodically.

## Laravel Forge deploy

**Requirements:** PHP **8.3+**, web root = `public/`, SQLite writable at `database/database.sqlite`.

If `composer install` fails with `codeload.github.com ... HTTP/2 400`, Forge cannot download zip archives from GitHub. This project sets `"preferred-install": "source"` in `composer.json` so Composer clones via git instead.

Replace the Forge deployment script with [scripts/forge-deploy.sh](scripts/forge-deploy.sh), or at minimum change the install line to:

```bash
composer install --no-interaction --prefer-source --no-dev --optimize-autoloader
```

**Optional (recommended):** In Forge → Server → Meta → add a [GitHub personal access token](https://github.com/settings/tokens) under Composer credentials to avoid GitHub rate limits during `git clone`.

Default admin (created on first migrate):

- Email: `admin@d3wat.test`
- Password: `password`

Each deploy runs `composer run-script deploy`, which migrates the database.

**Optional (recommended):** In Forge → Server → Meta → add a [GitHub personal access token](https://github.com/settings/tokens) under Composer credentials to avoid GitHub rate limits during `git clone`.

Ensure writable dirs:

```bash
chmod -R ug+rwx storage bootstrap/cache database
```

## d3wat integration

In the invite sender reminder mode:

- **Per-invitee links**: leave "رابط جلسة موحد" unchecked — d3wat appends `phone` and `name` to the base URL
- **Shared link**: check "رابط جلسة موحد" and set base URL to `https://your-domain.com/confirm`

## Manual checks

```bash
# Direct mode
curl -s "http://127.0.0.1:8000/confirm?phone=966512345678&name=test" | head

# Session mode (activate an event in admin first)
curl -s -c /tmp/cookies.txt -b /tmp/cookies.txt "http://127.0.0.1:8000/confirm" | head
```
