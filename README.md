# Laravel 10 Material Inventory Management

A minimal Laravel 10 application layer for the requested assignment. It includes category CRUD, material CRUD with soft deletes, and dated inward/outward quantity transactions.

## Requirements
- PHP 8.1+
- Composer
- MySQL
- Laravel 10

## 1. Create the Laravel project
```bash
composer create-project laravel/laravel:^10.0 material-inventory
cd material-inventory
```

## 2. Configure MySQL
Create a database:
```sql
CREATE DATABASE material_inventory;
```

Update `.env` in the Laravel project:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
Use your own MySQL username and password.

## 3. Run migrations and seed default categories
```bash
php artisan migrate --seed
```

## 4. Start the application
```bash
php artisan serve
```
Open http://127.0.0.1:8000.

## Pages
- `/categories` — category master CRUD
- `/materials` — material management with opening/current balance
- `/inward-transactions` — record positive or negative quantity movements and view history

## Design notes
- Material and transaction IDs are database-generated auto-incrementing IDs.
- Material name accepts letters and numbers, including spaces, hyphens and underscores; it must contain at least one letter or digit.
- Quantity and opening balance allow up to two decimal places.
- Negative transaction quantities represent outward movement; positive quantities represent inward movement.
- Material deletion uses Laravel soft deletes, so transaction history is retained.
- Categories with materials cannot be deleted, avoiding orphaned records.
- This package contains application files only; it does not include Laravel's vendor directory.
