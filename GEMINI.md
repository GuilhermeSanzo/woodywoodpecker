# Project Overview: Woody Woodpecker Bookstore (Laravel Migration)

A modern reimagining of the Woody Woodpecker Bookstore application, currently being migrated from legacy procedural PHP to the Laravel framework. This project leverages modern MVC best practices, robust security, and a scalable architecture to provide a premium bookstore experience.

**Note:** This project is in its initial migration phase. Legacy functionality is being systematically rewritten into clean, maintainable Laravel components.

## Main Technologies
- **Framework:** Laravel (Modern MVC)
- **Language:** PHP 8.2+
- **Database:** SQLite (Development) / MySQL (Production)
- **Frontend:** Blade Templates, Vite, Tailwind CSS
- **Package Management:** Composer, NPM

## Architecture
The application adheres to the standard Laravel structure, promoting a clean separation of concerns:
- **Models (`app/Models`):** Data structure and Eloquent relationships.
- **Views (`resources/views`):** UI templates using the Blade engine.
- **Controllers (`app/Http/Controllers`):** Logic for handling requests and orchestrating data.
- **Migrations (`database/migrations`):** Version-controlled database schema definitions.
- **Routes (`routes/web.php`):** Centralized route management.

## Building and Running

### Prerequisites
- PHP 8.2 or higher.
- Composer.
- Node.js & NPM.

### Setup Instructions
1.  **Dependencies:**
    ```bash
    composer install
    npm install && npm run build
    ```
2.  **Configuration:**
    - Copy `.env.example` to `.env`.
    - Configure your database in the `.env` file (SQLite is used by default).
3.  **Application Initialization:**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```
4.  **Launch:**
    ```bash
    php artisan serve
    ```
    Access the application at `http://localhost:8000`.

## Development Conventions
- **Database:** Always use Eloquent ORM and Migrations. Do not execute raw SQL unless absolutely necessary.
- **Validation:** Utilize Form Requests or the `validate` method to ensure data integrity.
- **Consistency:** Follow PSR-12 coding standards.
- **Security:** Leverage Laravel's built-in CSRF protection, password hashing, and SQL injection prevention.

## Key Directories
- `/app`: Core business logic and models.
- `/routes`: All application endpoint definitions.
- `/resources/views`: Frontend Blade components.
- `/database`: Migrations, factories, and seeders.
- `/public`: Entry point and compiled assets.
