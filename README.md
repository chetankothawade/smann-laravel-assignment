# Shipment Tracking Web Application

Laravel 13 assessment project for managing shipment visibility with a paginated list page and a shipment details timeline.

## Features

- Server-side rendered shipment list at `/shipments`
- Pagination with tracking number search
- Shipment detail page with sender and receiver information
- Status timeline with timestamps and locations
- Seeded demo data for local review
- Feature tests covering list, search, pagination, and detail rendering

## Tech Stack

- PHP 8.3+
- Laravel 13
- MySQL
- Blade + Bootstrap 5 (CDN)

## Setup

1. Install dependencies:

```bash
composer install
```

2. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

3. Update `.env` with your MySQL connection. Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shipment_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

5. Start the application:

```bash
php artisan serve
```

Visit `http://localhost:8000/shipments`.

## Running Tests

```bash
php artisan test
```

## Demo Data
The application includes seeders to generate sample shipment and status logs data.


## Architecture Notes

- `ShipmentStatus` enum centralizes valid shipment states and badge presentation.
- `Shipment` exposes a dedicated `searchTrackingNumber()` scope so filtering logic stays out of controllers.
- `ShipmentController` keeps actions thin and delegates persistence/query structure to models and relationships.
- Bootstrap is loaded from CDN, so the app does not require a Vite build to render correctly.

## Refactoring and Code Quality

- Applied DRY by centralizing status values in `app/Enums/ShipmentStatus.php`.
- Improved readability by separating list and detail concerns into a dedicated `ShipmentController`.
- Kept the query efficient by selecting only the list-page columns and eager loading timeline data only on the detail page.

## Performance Notes

- Shipment search uses a database filter at query time instead of filtering in PHP.
- Pagination limits page payload size and avoids loading the full dataset into memory.
- Timeline records are loaded only for the selected shipment, reducing unnecessary relation queries.

## Security Notes

- Views rely on Blade escaping, which mitigates XSS for shipment names, addresses, and locations.
- Search input is passed through Eloquent query bindings, avoiding raw SQL injection risks.
- Route model binding constrains detail lookups to valid shipment identifiers managed by Laravel.

## Verification

- `php artisan migrate:fresh --seed`
- `php artisan test`
