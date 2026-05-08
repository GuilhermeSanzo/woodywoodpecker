# Woody Woodpecker Bookstore

A modern, full-featured bookstore application migrated from legacy procedural PHP to the **Laravel** framework. This project demonstrates a robust MVC architecture, secure administrative controls, and a polished frontend using Tailwind CSS.

## 🚀 Features

- **Dynamic Catalog:** Browse a rich collection of books with detailed metadata, covers, and price information.
- **Author Profiles:** Dedicated pages for authors showcasing their biographies and published titles.
- **Admin Hub:** A comprehensive management dashboard for administrators to handle:
    - **Books:** Full CRUD with image uploads and relational data.
    - **Authors:** Manage biographical information and profile images.
    - **User Management:** Secure account controls with role-based access.
    - **Support Entities:** Centralized management of Genres, Publishers, and Stores.
- **Modern Authentication:** Powered by Laravel Breeze for secure login, registration, and profile management.
- **Responsive Design:** Clean and professional UI built with Blade and Tailwind CSS.

## 🛠️ Technology Stack

- **Framework:** [Laravel 11](https://laravel.com)
- **Database:** [SQLite](https://www.sqlite.org) (Default for portability)
- **Styling:** [Tailwind CSS](https://tailwindcss.com)
- **Asset Management:** [Vite](https://vitejs.dev)
- **Auth Scaffolding:** [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)

## 📦 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM

### Steps
1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd woody-woodpecker
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Initialization:**
   The project uses SQLite by default. Ensure an empty `database/database.sqlite` file exists (or Laravel will prompt to create it).
   ```bash
   php artisan migrate --seed
   ```

5. **Build Assets:**
   ```bash
   npm run build
   ```

6. **Start the Server:**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 📂 Architecture Highlights

- **Models:** Eloquent ORM with defined relationships (BelongsTo, HasMany, BelongsToMany).
- **Controllers:** RESTful Resource Controllers with distinct public and administrative logic.
- **Migrations & Seeders:** Fully automated database schema and legacy data migration.
- **Security:** Built-in protection against CSRF, XSS, and SQL injection.

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).
