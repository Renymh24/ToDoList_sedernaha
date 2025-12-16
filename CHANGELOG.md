# Changelog

Semua perubahan penting pada proyek ini akan didokumentasikan dalam file ini.

Format changelog ini berdasarkan [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
dan proyek ini mematuhi [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- **Fitur Pencarian**
  - Pencarian data berdasarkan judul dan deskripsi
  - Input search dengan desain Islamic theme yang konsisten
  - Tombol reset untuk menghapus pencarian
  - Indikator hasil pencarian aktif dengan badge

- **Fitur Filter Status**
  - Filter berdasarkan status todo (All, Pending, Completed, Late)
  - Dropdown select dengan desain responsive
  - Filter dapat dikombinasikan dengan pencarian
  - Badge berwarna untuk menunjukkan filter aktif
  - Tombol apply dan reset untuk kontrol filter

- **Error Handling untuk Deadline**
  - Validasi deadline wajib diisi (required)
  - Custom error messages dalam bahasa Indonesia
  - Validasi tanggal tidak boleh masa lalu (after_or_equal:today)
  - UI indicator dengan tanda asterisk merah (*)
  - HTML5 validation dengan atribut required dan min
  - Warning box merah untuk informasi deadline wajib
  - Error handling di CreateController dan EditController

### Changed
- TodoController.php: Menambahkan parameter Request untuk pencarian dan filter
- Index view: Menambahkan form pencarian dan filter yang terintegrasi
- CreateController.php: Mengubah validasi deadline dari nullable menjadi required
- EditController.php: Menambahkan validasi after_or_equal untuk deadline
- create.blade.php: Menambahkan indicator wajib dan warning box untuk deadline
- edit.blade.php: Menambahkan indicator wajib dan warning box untuk deadline

### Technical Details
- Search menggunakan LIKE query dengan wildcard untuk partial matching
- Filter status dengan WHERE clause conditional
- Dual validation: client-side (HTML5) dan server-side (Laravel)
- Responsive design untuk mobile dan desktop
- Persistent filter state dengan old() helper

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

## Changelog Detail

### December 17, 2025
- ✅ Implementasi fitur pencarian data berdasarkan deskripsi dan judul
- ✅ Implementasi fitur filter berdasarkan status (pending, completed, late)
- ✅ Penambahan error handling untuk input deadline kosong
- ✅ Peningkatan user experience dengan visual feedback dan warning messages
- ✅ Integrasi search dan filter dalam satu form yang responsive

---
Terimakasih
**Last Updated**: 2025-12-17


