# Changelog

Semua perubahan penting pada proyek ini akan didokumentasikan dalam file ini.

Format changelog ini berdasarkan [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
dan proyek ini mematuhi [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.0] - 2025-05-30

### Added
- **Sistem Autentikasi**
  - Implementasi autentikasi dengan Laravel Sanctum
  - Service autentikasi (`AuthService.php`)
  - Repository pattern untuk User dengan interface `UserRepositoryInterface`
  - Login test untuk memastikan fungsionalitas autentikasi

- **Model dan Database**
  - Model `User` dengan migrasi
  - Model `ToDo` dengan migrasi untuk manajemen todo list
  - Migration untuk Personal Access Tokens

- **Helper Functions**
  - `DateHelper.php` - Helper untuk manipulasi tanggal
  - Global helper functions di `helpers.php`

- **Struktur Proyek**
  - Direktori Controllers untuk HTTP controllers
  - Direktori Requests untuk form requests
  - Providers setup (`AppServiceProvider`)
  - Blade templates di `resources/views/`
  - Asset management dengan Vite
  - Tailwind CSS integration

- **Testing**
  - Unit tests
  - Feature tests
  - PHPUnit configuration

### Changed
- Format tanggal dalam DateHelper untuk konsistensi

### Technical Stack
- **Backend**: Laravel 12.x dengan PHP 8.2+
- **Frontend**: Tailwind CSS 4.x dengan Vite
- **Testing**: PHPUnit 11.x, Mockery
- **Database**: Migrasi database diatur dengan Eloquent
- **API**: Laravel Sanctum untuk authentication API

## Commit History

### [bbb5b49] - Format tanggal
- Perbaikan format tanggal di DateHelper

### [a50866e] - Merge pull request #1
- Merge feature branch `feat/coba-commit`

### [5bbb4c1] - Commit kedua
- Update struktur dan konfigurasi

### [492ec50] - Commit pertama
- Inisialisasi project

### [5324aa6] - ToDoListku
- Setup awal project ToDoList

---

## Fitur-Fitur Utama

### 1. Autentikasi & Autorizasi
- User authentication dengan Laravel Sanctum
- Repository pattern untuk fleksibilitas
- Secure API token management

### 2. Manajemen ToDo
- Model ToDo dengan struktur database
- Relasi antara User dan ToDo
- CRUD operations untuk todo items

### 3. Helper Functions
- Datetime formatting utilities
- Global helper functions untuk penggunaan di seluruh aplikasi

### 4. Frontend
- Blade templating engine
- Tailwind CSS untuk styling
- Vite untuk asset bundling

### 5. Testing
- Unit tests untuk business logic
- Feature tests untuk workflows
- LoginTest untuk autentikasi

---

## Installasi & Setup

```bash
# Clone repository
git clone [repository-url]

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run build

# Untuk development
npm run dev
```

## Teknologi yang Digunakan

- **PHP**: 8.2+
- **Laravel**: 12.x
- **Node.js**: Dengan npm
- **Tailwind CSS**: 4.x
- **Vite**: Build tool
- **PHPUnit**: 11.x untuk testing
- **SQLite/MySQL**: Database

## Catatan Versi

### Versi 1.0.0 - Initial Release
Rilis pertama ToDoList dengan fitur dasar:
- Autentikasi user
- CRUD ToDo
- Testing framework setup
- Frontend dengan Tailwind CSS

---
Terimakasih
**Last Updated**: 2025-12-12


