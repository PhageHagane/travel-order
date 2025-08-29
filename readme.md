# Laravel Boilerplate 6.0.5 (Customized)

## Introduction

Laravel Boilerplate 6.0.5 provides developers with a robust starting point for building Laravel applications. It includes built-in authentication, role and permission management, user management, and various UI components built on Bootstrap.

### Features

- Laravel 6.x Support
- Pre-configured authentication system
- User & Role management
- Bootstrap-based UI
- API-ready structure
- Built-in notifications
- Command-line tools for easier management

## Installation

### 1. Download the Repository

Download the repository through this link: [Laravel Boilerplate v6.0.5](https://github.com/rappasoft/laravel-boilerplate/archive/refs/tags/v6.0.5.zip) and extract the contents.

```sh
cd laravel-boilerplate
```

### 2. Install Dependencies

```sh
composer install
npm install
```

### 3. Configure the Application

```sh
cp .env.example .env
php artisan key:generate
```

Update the database configuration in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### 4. Set Up Database

```sh
php artisan migrate --seed
php artisan storage:link
```

### 5. Start the NPM Watcher

```sh
npm run watch
```

### 6. Start the Development Server

```sh
php artisan serve
```

Access your application at `http://127.0.0.1:8000`.

## Demo Credentials

**User:** [admin@admin.com](mailto:admin@admin.com)\
**Password:** secret

## Official Documentation

[Click here for the official documentation](http://laravel-boilerplate.com)
