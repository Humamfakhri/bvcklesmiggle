# Bvcklesmiggle

A Laravel-based web application for managing and showcasing products, articles, partnerships, and downloadable resources — with a full admin dashboard and a public-facing frontend.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [Public Routes](#public-routes)
- [Admin Dashboard](#admin-dashboard)
- [Authentication](#authentication)
- [Testing](#testing)
- [Storage](#storage)

---

## Overview

Bvcklesmiggle is a content-driven web platform with two distinct layers:

- **Public frontend** — visitors can browse articles, products, and partnerships, and leave comments on articles.
- **Admin dashboard** — authenticated administrators manage all content through a protected panel with full CRUD capabilities.

---

## Features

### Public Frontend
- **Home page** — landing page with site overview
- **Articles** — paginated article listing with search, category filter, and sort; individual article pages with a comment section
- **Products** — paginated product catalog with category and search filters; links to Shopee and Tokopedia
- **Partnerships** — showcase of partner organisations with optional links
- **User accounts** — registration and login with username/password; logged-in users can post comments

### Admin Dashboard
- **Articles** — create, edit, and delete articles and article categories; optional hero image upload
- **Products** — create, edit, and delete products and product categories; multiple image uploads; optional Shopee and Tokopedia links
- **Partnerships** — create, edit, and delete partnership entries with logo image upload and optional link
- **Downloads** — create, edit, and delete downloadable resource links
- **Users** — view registered users, create new user accounts, delete non-admin users

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 11 |
| Language | PHP 8.2+ |
| Database | MySQL |
| File Storage | Laravel Filesystem (public disk) |
| Frontend | Blade templates |
| Testing | PHPUnit 11 |

---

## Requirements

- PHP >= 8.2 with extensions: `pdo_mysql`, `mbstring`, `dom`, `fileinfo`
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & npm (for frontend assets)

---

## Installation

```bash
# 1. Clone the repository
git clone <repository-url>
cd bvcklesmiggle

# 2. Install PHP dependencies
composer install

# 3. Install frontend dependencies
npm install

# 4. Copy the environment file
cp .env.example .env

# 5. Generate the application key
php artisan key:generate

# 6. Configure your database in .env (see Configuration below)

# 7. Run migrations
php artisan migrate

# 8. Create the storage symlink
php artisan storage:link
```

---

## Configuration

Edit `.env` with your local values:

```dotenv
APP_NAME=Bvcklesmiggle
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bvcklesmiggle
DB_USERNAME=root
DB_PASSWORD=

# Admin credentials used for seeding (if applicable)
ADMIN_EMAIL=
ADMIN_USERNAME=
ADMIN_PASSWORD=
```

---

## Running the Application

```bash
# Build frontend assets
npm run build

# Start the development server
php artisan serve
```

The application will be available at `http://localhost:8000`.

To create the storage symlink (required for uploaded images to be publicly accessible):

```bash
php artisan storage:link
```

Alternatively, visit `/tes` in your browser once the server is running — this triggers `storage:link` via the web.

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminArticleController.php      # Admin: articles & article categories
│   │   ├── AdminDownloadController.php     # Admin: downloads
│   │   ├── AdminPartnershipController.php  # Admin: partnerships
│   │   ├── AdminProductController.php      # Admin: products & product categories
│   │   ├── AdminUserController.php         # Admin: user management
│   │   ├── ArticleController.php           # Public: article listing, detail, comments
│   │   ├── AuthController.php              # Admin login / logout
│   │   ├── PartnershipController.php       # Public: partnerships page
│   │   ├── ProductController.php           # Public: product listing
│   │   └── UserController.php             # Public: register, login, logout
│   └── Middleware/
│       ├── AuthenticatedAdminMiddleware.php  # Redirects logged-in admins away from login page
│       ├── AuthenticatedUserMiddleware.php   # Guest-only guard for register/login
│       ├── CheckLaunchDate.php              # Redirects to waiting page before launch date
│       └── OnlyAdminMiddleware.php          # Protects all /admin/* routes
├── Models/
│   ├── Article.php
│   ├── ArticleCategory.php
│   ├── ArticleWithCategory.php
│   ├── Comment.php
│   ├── Download.php
│   ├── Partnership.php
│   ├── Product.php
│   ├── ProductCategory.php
│   ├── ProductWithCategory.php
│   └── User.php
└── Support/
    └── HtmlSanitizer.php    # Strips dangerous HTML from rich-text input
```

---

## Public Routes

| Method | URI | Description |
|---|---|---|
| GET | `/` | Home page |
| GET | `/articles` | Article listing (search, category, sort) |
| GET | `/articles/{slug}` | Single article with comments |
| POST | `/articles` | Submit a comment |
| GET | `/products` | Product catalog |
| GET | `/partnership` | Partnerships page |
| GET | `/register` | Registration form |
| POST | `/register` | Create a new user account |
| GET | `/login` | Login form |
| POST | `/login` | Authenticate |
| GET | `/logout` | Log out |

### JSON Endpoints
| Method | URI | Description |
|---|---|---|
| GET | `/get-article?id={id}` | Return article data as JSON |
| GET | `/get-product?id={id}` | Return product data (with decoded image array) as JSON |

---

## Admin Dashboard

The admin panel lives under `/admin/*` and is protected by the `only-admin` middleware — access requires an authenticated user with `is_admin = true`.

### Admin Login

| Method | URI | Description |
|---|---|---|
| GET | `/admin` | Admin login page |
| POST | `/admin` | Authenticate as admin |
| GET | `/logout-admin` | Log out of admin session |

### Admin Resource Routes

| Resource | List | Create | Update | Delete |
|---|---|---|---|---|
| Articles | `GET /admin/articles` | `POST /admin/articles` | `PUT /admin/articles/{id}` | `DELETE /admin/articles/{id}` |
| Products | `GET /admin/products` | `POST /admin/products` | `PUT /admin/products/{id}` | `DELETE /admin/products/{id}` |
| Partnerships | `GET /admin/partnership` | `POST /admin/partnership` | `PUT /admin/partnership/{id}` | `DELETE /admin/partnership/{id}` |
| Downloads | `GET /admin/downloads` | `POST /admin/downloads` | `PUT /admin/downloads/{id}` | `DELETE /admin/downloads/{id}` |
| Users | `GET /admin/users` | `POST /admin/users` | — | `DELETE /admin/users/{id}` |

> Article categories and product categories are created via the same `POST` store endpoint as their parent resource, distinguished by the presence of a `name` or `categoryName` field in the request.

---

## Authentication

The application has two separate authentication flows:

**Regular users** (`/login`, `/register`) — stored in the `users` table with `is_admin = false`. Used for posting comments on articles.

**Admin users** — same `users` table with `is_admin = true`. Access the admin dashboard at `/admin`. Admins cannot be deleted through the user management panel.

---

## Testing

Tests use PHPUnit and run against a dedicated MySQL test database (`bvcklesmiggle_test`).

### Setup

Create the test database before running tests:

```sql
CREATE DATABASE bvcklesmiggle_test;
```

The test environment is configured in `phpunit.xml`:

```xml
<env name="DB_CONNECTION" value="mysql"/>
<env name="DB_DATABASE" value="bvcklesmiggle_test"/>
```

### Running Tests

```bash
# Run all tests
php artisan test

# Run a specific test file
php artisan test --filter=AdminDashboardCrudTest
```

### Test Coverage

| Test File | What It Covers |
|---|---|
| `AdminDashboardCrudTest` | Full CRUD for all admin resources; access control; validation; file upload and cleanup; user management |
| `AdminCrudFlowTest` | End-to-end create → update → delete flow for all dashboard models |
| `AdminOptionalFieldSubmissionTest` | Nullable field handling (articles without images, products without marketplace links) |
| `SecurityHardeningTest` | Non-admin redirect enforcement; XSS sanitization of rich-text input |
| `ExampleTest` | Basic application health check |

---

## Storage

Uploaded files (article images, product images, partnership logos) are stored on the `public` disk under `storage/app/public/` and served via the `storage/` symlink in `public/`.

Subdirectories:
- `article_images/` — article hero images
- `product_images/` — product gallery images
- `partnership_images/` — partner logo images

Run `php artisan storage:link` once after installation to make these publicly accessible.
