# Project Overview: Woody Woodpecker Bookstore (Laravel Migration)

A modern reimagining of the Woody Woodpecker Bookstore application, currently being migrated from legacy procedural PHP to the Laravel framework. This project leverages modern MVC best practices, robust security, and a scalable architecture to provide a premium bookstore experience.

**Note:** This project is in its initial migration phase. Legacy functionality is being systematically rewritten into clean, maintainable Laravel components.

## Main Technologies
- **Framework:** Laravel (Modern MVC)
- **Language:** PHP 8.2+
- **Database:** SQLite (Default for Portability) / MySQL (Optional Production)
- **Frontend:** Blade Templates, Vite, Tailwind CSS, Axios
- **Authentication:** Laravel Breeze (Blade Stack)
- **Package Management:** Composer, NPM

## Architecture
The application adheres to the standard Laravel structure, promoting a clean separation of concerns:
- **Models (`app/Models`):** Data structure and Eloquent relationships.
- **Views (`resources/views`):** UI templates using the Blade engine and Tailwind CSS.
- **Controllers (`app/Http/Controllers`):** Logic for handling requests and orchestrating data. Standard empty CRUD Resource Controllers have been generated for all base and relational entities.
- **Migrations (`database/migrations`):** Version-controlled database schema definitions. The database has been fully seeded with legacy data from the `reference/legacy_database.sql` source using a custom SQLite-compatible seeder.
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
    - The project is pre-configured to use **SQLite**, ensuring maximum portability and zero-config database setup.
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
- **Database:** Always use Eloquent ORM and Migrations. Do not execute raw SQL unless absolutely necessary. SQLite is the primary development database.
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
    - [x] **Admin Dashboard:** Transform the default dashboard into a functional management hub.
    - [x] Integrate global logo in Navbar and Favicon
    - [x] **Global Dark Footer:** Implement a global dark footer in the main layout with developer attribution.
    - [x] Reorganize navigation layout: Move Cart to the right and My Orders into the user dropdown
2.  **Controller Implementation:** Complete the RESTful logic for the remaining Resource Controllers.
3.  **Documentation & Portfolio:**
    - [x] **Create multi-language professional README:** Develop a high-tier presentation in English, Portuguese, and Spanish.
4.  **Admin Panel:**
    - [x] **Authors CRUD:** Implement administrative interface for managing authors, including image uploads and secure routing.
    - [x] **Books CRUD:** Implement administrative interface for managing books, including relational dropdowns, image uploads, and secure routing.
    - [x] **Stock Management:** Add stock field to administrative book CRUD and index.
    - [x] **Genres, Publishers, and Stores CRUD:** Implement administrative interface for managing base support entities.
    - [x] **User Management:** Implement admin controls for users and permissions.
5.  **General Settings:**
    - [x] Update global browser tab title to WoodyWoodpecker

## Feature: Book Purchasing
- [x] Create database migrations and Eloquent models for book purchasing flow
- [x] Create BookFactory, Seeder, Controller, and web routes for catalog listing
- [x] Build Blade view for book catalog matching current project UI
- [x] Implement session-based shopping cart logic and route
- [x] Create cart view to display session items and total amount
- [x] Implement direct checkout flow, database persistence, and success screen
- [x] Add dynamic shopping cart link and item counter to main navigation header
- [x] Build user order history view with nested order items
- [x] Implement edit quantity and remove item features in cart

## UI Standardization
- [x] Update all book views to display author pseudonym by default
- [x] Fix Add to Cart form and display dynamic stock on book details view
- [x] Add dynamic visual feedback state (In Cart) to catalog and details purchasing buttons
- [x] Implement clickable overlay link on catalog book cards
- [x] Implement clickable cards and functional add-to-cart plus icon on Home page

## Feature: Wishlist
- [x] Implement book_user pivot table, model relationships, and toggle controller
- [x] Implement functional and reactive heart toggle button on book details view
- [x] Create wishlist index view with responsive grid and navigation link

## Feature: User Avatar
- [x] Add avatar_path column to users table and update User model fillable properties
- [x] Implement avatar upload, storage logic, and profile view integration
- [x] Safely remove legacy image column using defensive migration
- [x] Display dynamic user avatar in the navigation bar

## Refactor: Media Management
- [x] Create Artisan command to migrate legacy media files to internal storage
- [x] Fix book and author image URLs in Blade views by prepending the storage asset path
- [x] Refactor Book and Author controllers to use Storage facade for new uploads and automatic file cleanup
