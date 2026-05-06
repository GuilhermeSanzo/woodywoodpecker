# Project Overview: Woody Woodpecker Bookstore

A comprehensive bookstore web application featuring a public-facing storefront and a custom Content Management System (CMS). The project is built using a traditional PHP stack, focusing on modularity through versioned directories (`v0` and `v1`).

## Core Technologies
- **Backend:** PHP 8+ (utilizing `mysqli` with a custom polyfill layer for legacy `mysql_*` functions).
- **Database:** MySQL/MariaDB (Schema defined in `woody_woodpecker_v1/Documentos/woody_woodpecker_final.sql`).
- **Frontend:** HTML5, CSS3, JavaScript (jQuery, jQuery UI, jQuery Cycle), and Bootstrap.
- **Architecture:** Monolithic multi-versioned structure.
  - `woody_woodpecker_v0/`: Public storefront.
  - `woody_woodpecker_v1/`: Administrative CMS and updated modules.
  - `woody_woodpecker_app/`: JSON-based API backend (e.g., `lib.php`).

## Building and Running
### Prerequisites
- PHP 8.0 or higher.
- MySQL/MariaDB Server.
- A local web server (Apache/Nginx) or PHP's built-in server.

### Setup Instructions
1.  **Database:**
    - Create a database named `woody_woodpecker`.
    - Import the SQL schema and seed data from `woody_woodpecker_v1/Documentos/woody_woodpecker_final.sql`.
2.  **Configuration:**
    - Verify database credentials in `conexao.php`. Default is `localhost`, `root`, `""`, `woody_woodpecker`.
3.  **Run:**
    - Start your local server pointing to the root directory.
    - Access `http://localhost/` (redirects to `v0/home.php`).

## Development Conventions
- **Database Access:** Always include `conexao.php`. Use the provided polyfills if working with legacy code, but prefer modern `mysqli` for new features.
- **Authentication:** Sessions are used for user state. CMS pages require an active session and specific user levels (`codTipoUsuario`).
- **File Uploads:** Store uploaded images in `woody_woodpecker_v1/Arquivos/` or respective `Imagens/` directories.
- **Naming:** Follow the existing snake_case naming convention for PHP files and database columns.
- **Styling:** Version-specific CSS is located in `Estilo/` subdirectories. Use `estilo_geral.css` for shared styles.

## Key Directories
- `/woody_woodpecker_v0`: Legacy/Stable public site.
- `/woody_woodpecker_v1`: CMS and development version of the site.
- `/woody_woodpecker_app`: Mobile/API support.
- `/Documentos`: SQL scripts, design wireframes, and project requirements.
- `/Efeitos`: JavaScript libraries and custom UI logic.
