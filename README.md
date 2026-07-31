# Chirper — Getting Started with PHP

A Twitter-style micro-blogging app built with **Laravel**, created as a hands-on introduction to full-stack PHP development. This repo tracks the project from an empty folder to a working, styled, authenticated application — commit by commit.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/Database-SQLite-003B57?logo=sqlite&logoColor=white)
![Status](https://img.shields.io/badge/Status-Complete-brightgreen)

---

## What is Chirper?

Chirper is a small Twitter-style app: users register, log in, and post short messages ("chirps") to a public feed. It's the project used in Laravel's own official bootcamp tutorial, adapted here as a self-directed learning exercise.

## Features

- **Authentication** — register, login, logout, password hashing (via Laravel Breeze)
- **Public feed, gated posting** — anyone can read the feed; only logged-in users can post, edit, or delete
- **Chirp CRUD** — create, edit, and delete posts
- **Ownership-based authorization** — enforced server-side via a Laravel Policy (confirmed with a real `403 Forbidden` when a user attempts to edit someone else's post, not just a hidden UI button)
- **"Edited" indicator** — shows when a chirp has been modified since posting
- **Relative timestamps** — "2 minutes ago" style, via Laravel's `diffForHumans()`
- **Per-user avatar colors** — consistent color assigned to each user based on their ID
- **Custom branding** — mascot logo, feather-icon buttons, brand color palette

## Tech stack

| Layer | Tool |
|---|---|
| Backend framework | Laravel 11 |
| Language | PHP 8.5 |
| Auth scaffolding | Laravel Breeze (Blade stack) |
| Database | SQLite |
| Frontend | Blade templates, Tailwind CSS |
| Icons | Tabler Icons |
| Build tool | Vite |

## Database schema

**users**
```
id
name
email
password
created_at
updated_at
```

**chirps**
```
id
user_id (foreign key → users.id, cascade delete)
body
created_at
updated_at
```

## Project structure

```
app/
  Http/Controllers/ChirpController.php   # CRUD logic
  Models/Chirp.php                       # Chirp model + user relationship
  Models/User.php                        # User model + chirps relationship
  Policies/ChirpPolicy.php               # Authorization: users can only edit/delete their own chirps
database/
  migrations/                            # users + chirps table schema
resources/
  views/chirps/
    index.blade.php                      # Public feed + post form
    edit.blade.php                       # Edit form
routes/
  web.php                                # Public + auth-gated routes
public/images/
  logo.jpg                               # Brand mascot logo
```

## Setup

**Requirements:** PHP 8.2+, Composer, Node 18+

```bash
git clone https://github.com/simbarashemamvura1/Chirper-GettingStartedWithPHP.git
cd Chirper-GettingStartedWithPHP

composer install
npm install

cp .env.example .env
php artisan key:generate

# database.sqlite is included; ensure DB_CONNECTION=sqlite in .env
php artisan migrate

npm run build
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## What this project demonstrates

Built as a portfolio piece alongside other projects (embedded systems, robotics), Chirper shows a different but complementary skill set:

- Relational database design (foreign keys, cascading deletes)
- Eloquent ORM relationships (`hasMany` / `belongsTo`)
- Authentication and session management
- Authorization via Policies (server-enforced, not just UI-hidden)
- MVC structure and RESTful resource routing
- Frontend styling with Tailwind and component-based Blade templates

## Possible extensions

Not implemented here, but natural next steps for extending the project:

- Likes and comments
- Search
- Follow/unfollow
- Image uploads on chirps
- Pagination / infinite scroll
- Admin moderation tools

## Author

Simbarashe Mamvura — built as a learning project to get hands-on with Laravel fundamentals.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
