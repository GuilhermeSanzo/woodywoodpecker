# Project Overview: Woody Woodpecker Bookstore (Laravel Migration)

A modern reimagining of the Woody Woodpecker Bookstore application, currently being migrated from legacy procedural PHP to the Laravel framework. This project leverages modern MVC best practices, robust security, and a scalable architecture to provide a premium bookstore experience.

**Note:** This project is in its initial migration phase. Legacy functionality is being systematically rewritten into clean, maintainable Laravel components.

## Main Technologies
- **Framework:** Laravel (Modern MVC)
- **Language:** PHP 8.2+
- **Database:** SQLite (Development) / MySQL (Production)
- **Frontend:** Blade Templates, Vite, Tailwind CSS, Axios
- **Authentication:** Laravel Breeze (Blade Stack)
- **Package Management:** Composer, NPM

## Architecture
The application adheres to the standard Laravel structure, promoting a clean separation of concerns:
- **Models (`app/Models`):** Data structure and Eloquent relationships.
- **Views (`resources/views`):** UI templates using the Blade engine and Tailwind CSS.
- **Controllers (`app/Http/Controllers`):** Logic for handling requests and orchestrating data. Standard empty CRUD Resource Controllers have been generated for all base and relational entities.
- **Migrations (`database/migrations`):** Version-controlled database schema definitions. The database has been fully seeded with legacy data from the `reference/legacy_database.sql` source.
- **Routes (`routes/web.php`, `routes/auth.php`):** Centralized route management. Resource routes have been registered for all core entities, mapping them to their respective controllers while preserving Breeze authentication routes.

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
- **Authentication:** Scaffolding (Login, Register, Dashboard) is provided by Laravel Breeze.
- **Database:** Always use Eloquent ORM and Migrations. Do not execute raw SQL unless absolutely necessary.
- **Controllers:** Utilize Resource Controllers for consistent CRUD operations across all entities.
- **Validation:** Utilize Form Requests or the `validate` method to ensure data integrity.
- **Consistency:** Follow PSR-12 coding standards.
- **Security:** Leverage Laravel's built-in CSRF protection, password hashing, and SQL injection prevention.

## Key Directories
- `/app`: Core business logic and models.
- `/routes`: All application endpoint definitions.
- `/resources/views`: Frontend Blade components.
- `/database`: Migrations, factories, and seeders.
- `/public`: Entry point and compiled assets.

## Current Database Schema
The following tables and models have been established as part of the initial migration phase:

- **Base Entities:** `authors`, `distributors`, `publishers`, `genres`, `promotions`, `user_types`, `stores`, `newsletters`, `abouts`, `contacts`.
- **Relational Entities:**
    - `users`: Links to `user_types`.
    - `books`: Central entity linking to `authors`, `genres`, `distributors`, and `publishers`.
    - `featured_authors`: Highlighting specific `authors`.
    - `books_of_the_month`: Showcasing specific `books`.
    - `book_promotion`: Pivot table linking `books` and `promotions`.

## Next Steps
1.  **Frontend Refinement:**
    - [x] **Books Listing:** Implement responsive grid with eager loading, guest navigation support, and legacy image mapping.
    - [x] **Book Details:** Create a comprehensive detailed view for individual books, showcasing metadata, descriptions, and related content.
    - [x] **Author Profiles:** Develop dedicated pages for authors, listing biographies and associated titles.
    - [x] **Welcome Page:** Modernize the landing page with featured authors and books of the month.
2.  **Controller Implementation:** Complete the RESTful logic for the remaining Resource Controllers.
3.  **Admin Panel:** Develop the administrative interface for managing books, authors, and users.
