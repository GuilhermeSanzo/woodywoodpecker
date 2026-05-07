# Project Overview: Woody Woodpecker Bookstore

A modern, refactored bookstore web application featuring a public storefront, a custom Content Management System (CMS), and a dedicated RESTful API. The project follows a clean modular architecture that separates static assets, business logic, and user interface components.

## Core Technologies
- **Backend:** PHP 8.0+ (utilizing `mysqli`).
- **Database:** MySQL/MariaDB.
- **Frontend:** HTML5, CSS3, JavaScript (jQuery, jQuery UI, jQuery Cycle), and Bootstrap.
- **Architecture:** Modular separation of concerns.
  - `/public`: Centralized static assets (CSS, images, uploads).
  - `/src`: Core system configuration and business logic.
  - `/api`: RESTful API endpoints.
  - `/views`: Application screens divided into Public and Admin sections.

## Building and Running
### Prerequisites
- PHP 8.0 or higher.
- MySQL/MariaDB Server.
- A local web server (Apache/Nginx) or PHP's built-in server.

### Setup Instructions
1.  **Database:**
    - Create a database named `woody_woodpecker`.
    - Import the SQL schema from `/views/admin/Documentos/woody_woodpecker_final.sql`.
2.  **Configuration:**
    - Update database credentials in `src/database.php`.
3.  **Run:**
    - Point your web server to the project root.
    - Access the application via `http://localhost/` (Entry point is `index.php`).

## Development Conventions
- **Database Access:** Always use `require_once __DIR__ . '/src/database.php'` (or appropriate relative path).
- **Includes:** Use absolute paths with `__DIR__` for all `include` and `require` statements.
- **Assets:** Reference assets using absolute paths starting from root: `/public/css/` or `/public/images/`.
- **Dynamic Images:** Dynamic uploads are located in `/public/images/uploads/`.
- **Naming:** Follow `snake_case` for PHP files and database columns.

## Directory Structure
- `/api`: API-related logic (e.g., `lib.php`).
- `/public`: Static assets.
    - `/css`: Stylesheets for site and admin.
    - `/images`: Static images and user `/uploads`.
- `/src`: Core configuration (e.g., `database.php`).
- `/views`: Application screens.
    - `/public`: Public-facing storefront pages.
    - `/admin`: Administrative CMS pages.
- `index.php`: Main entry point (loads the public home view).

## Key Files
- `index.php`: Project entry point.
- `src/database.php`: Central database connection and session management.
- `api/lib.php`: API core logic.
- `views/public/home.php`: Landing page for customers.
- `views/admin/home.php`: Dashboard for administrators.
