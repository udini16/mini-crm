# MiniCRM

MiniCRM is a streamlined, elegantly designed Customer Relationship Management application built for modern web standards. It manages Company and Employee data through a fast, SPA-like interface with smooth page transitions and beautiful micro-interactions.

## Features

- **Company Management**: Create, read, update, and delete company records (Name, Email, Website, Logo).
- **Employee Management**: Manage employees linked to companies (Name, Email, Phone Number).
- **Global Search**: Search companies by name/email and employees by name/email/phone instantly.
- **Fluid Navigation**: Seamless, single-page application (SPA) feel without full page reloads.
- **Dynamic Animations**: Custom interactive form submissions and animated elements.

## Technology Stack

This project leverages a modern, lightweight, and powerful tech stack to deliver a premium user experience:

### Backend
- **[Laravel 11](https://laravel.com/)**: The core PHP framework powering the application structure, routing, Eloquent ORM, and database seeding.
- **PHP 8.4**: Built using the latest PHP features and best practices.

### Frontend
- **[Tailwind CSS](https://tailwindcss.com/)**: A utility-first CSS framework used for rapid UI development, responsive layouts, and custom styling (such as glassmorphism and custom scrollbars).
- **[Alpine.js](https://alpinejs.dev/)**: A rugged, minimal framework for composing JavaScript behavior directly in HTML templates. Used for responsive search bars, interactive pagination jumps, and custom tooltips.
- **[Swup.js (v4)](https://swup.js.org/)**: A versatile page transition library that fetches the next page and swaps the content seamlessly, giving the classic Blade application the speed and feel of a true SPA.
- **[Anime.js](https://animejs.com/)**: A lightweight JavaScript animation engine used to power custom, micro-animated SVG submit buttons for a premium "WOW" factor.
- **[intl-tel-input](https://github.com/jackocnr/intl-tel-input)**: Advanced phone number formatting and validation with a customized dark-mode dropdown.

## Setup & Installation

1. Clone the repository and navigate into the project directory:
   ```bash
   git clone https://github.com/udini16/mini-crm.git
   cd mini-crm
   ```

2. Install PHP and Node.js dependencies:
   ```bash
   composer install
   npm install
   ```

3. Copy the `.env.example` file to `.env` and configure your database settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run the database migrations and seeders (this will populate dummy data including an admin user):
   ```bash
   php artisan migrate --seed
   ```

5. Build the frontend assets:
   ```bash
   npm run build
   # Or for local development: npm run dev
   ```

6. Start the local development server:
   ```bash
   php artisan serve
   ```

You can now log in at `http://localhost:8000/login`.
