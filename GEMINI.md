# Project Overview: Woody Woodpecker Bookstore

A modern bookstore web application featuring a public storefront, a custom Content Management System (CMS), and a dedicated API. The project is currently undergoing an architectural refactor to consolidate legacy components into a more organized and maintainable structure.

## Core Technologies
- **Backend:** PHP 8.0+ (utilizing `mysqli`).
- **Database:** MySQL/MariaDB.
- **Frontend:** HTML5, CSS3, JavaScript (jQuery, jQuery UI, jQuery Cycle), and Bootstrap.
- **Architecture:** Transitioning to a modern modular structure.
  - `/public`: Centralized assets (CSS, images) for both site and admin.
  - `/src`: Core business logic and configuration.
  - `/api`: RESTful API logic.
  - `/woody_woodpecker_v0`: (Legacy) Public storefront (phasing out).
  - `/woody_woodpecker_v1`: (Legacy) Administrative CMS (phasing out).

## Building and Running
### Prerequisites
- PHP 8.0 or higher.
- MySQL/MariaDB Server.
- A local web server (Apache/Nginx) or PHP's built-in server.

### Setup Instructions
1.  **Database:**
    - Create a database named `woody_woodpecker`.
    - Import the SQL schema from `woody_woodpecker_v1/Documentos/woody_woodpecker_final.sql`.
2.  **Configuration:**
    - Database credentials are managed in `src/database.php`.
3.  **Run:**
    - Point your web server to the root directory.
    - Access the public site via the root or the legacy `v0` path.

## Development Conventions
- **Database Access:** Always use `require_once 'src/database.php'` (or appropriate relative path).
- **API Logic:** API core logic is located in `api/lib.php`.
- **Assets:** Reference assets using absolute paths: `/public/css/` or `/public/images/`.
- **Naming:** Follow snake_case for PHP files and database columns.

## Key Directories
- `/public`: Static assets (CSS, images).
- `/src`: Core configuration and backend logic (e.g., `database.php`).
- `/api`: API-related logic (e.g., `lib.php`).
- `/woody_woodpecker_v0`: Legacy public site components.
- `/woody_woodpecker_v1`: Legacy CMS components.
- `/Documentos`: SQL scripts and design documentation.
