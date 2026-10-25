# Laravel Library Project

This repo is a **personal learning playground**. A Laravel 13 application that I use to practice the fundamentals: routing, middleware, Eloquent, Blade templates, Vite for assets and a very small CRUD example (books & borrowing records).

## Running locally

```bash
# 1. Copy the environment file
cp .env.example .env

# 2. Install PHP and Node dependencies
composer install
npm isntall

# 3. Create an app key
php artisan key:generate

# 4. Run database migrations (SQLite is used by default)
php artisan migrate --force

# 5. Build the front‑end with Vite (only once for a dev environment)
npm run build

# 6. Serve the application
php artisan serve   # default runs at http://localhost:8000