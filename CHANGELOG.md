# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Unit testing framework setup
- Test coverage for core functionality

## [1.0.0] - 2025-05-30

### Added
- Initial project setup with Laravel framework
- User authentication system (Login, Register, Logout)
- Todo CRUD operations (Create, Read, Update, Delete)
- Todo status management (Complete/Incomplete toggle)
- Automatic late status update functionality
- RESTful API endpoints with Laravel Sanctum authentication
- Web interface with Blade templates
- Repository pattern implementation for User model
- Service layer for authentication logic
- Custom DateHelper utility class
- Database migrations:
  - Users table
  - Todos table
  - Cache table
  - Jobs table
  - Personal access tokens table
- API authentication middleware (`auth:sanctum`)
- Web authentication middleware (`auth`)
- CSRF protection for web routes
- Session management
- Cookie encryption
- Database query logging with Laravel Debugbar
- Environment configuration for local development

### API Endpoints
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout (authenticated)
- `GET /api/user` - Get authenticated user details
- `GET /api/todos` - List all todos (authenticated)
- `POST /api/todos` - Create new todo (authenticated)
- `PUT /api/todos/{id}` - Update todo (authenticated)
- `PATCH /api/todos/{id}/status` - Update todo status (authenticated)
- `DELETE /api/todos/{id}` - Delete todo (authenticated)
- `POST /api/todos/update-late-status` - Update late status for all todos (authenticated)

### Web Routes
- `GET /login` - Login page
- `POST /login-post` - Login form submission
- `GET /register` - Registration page
- `POST /register-post` - Registration form submission
- `GET /` - Home/Dashboard (authenticated)
- `GET /todos/create` - Create todo page (authenticated)
- `POST /todos` - Store new todo (authenticated)
- `GET /todos/{todo}/edit` - Edit todo page (authenticated)
- `PUT /todos/{todo}` - Update todo (authenticated)
- `DELETE /todos/{todo}` - Delete todo (authenticated)
- `PATCH /todos/{todo}/toggle` - Toggle todo status (authenticated)

### Models
- User model with authentication functionality
- Todo model with status and late status management

### Helpers
- DateHelper class for date manipulation and formatting
- Global helper functions

### Security
- Password hashing with bcrypt
- Token-based API authentication (Laravel Sanctum)
- Session-based web authentication
- CSRF token validation
- Encrypted cookies
- Environment-based configuration

### Development Tools
- Laravel Debugbar for debugging
- PHPUnit for testing
- Faker for test data generation
- Composer for dependency management
- Vite for asset bundling

### Configuration
- MySQL database configuration
- Session storage in database
- Log channel configuration
- Cache configuration
- Queue configuration with database driver
- Mail configuration with log driver

## [0.1.0] - Initial Commit

### Added
- Project initialization
- Basic Laravel application structure
- Composer dependencies
- NPM dependencies
- Environment configuration template
- README documentation

---

## Notes

### Migration History
1. `0001_01_01_000000_create_users_table` - User authentication table
2. `0001_01_01_000001_create_cache_table` - Application cache storage
3. `0001_01_01_000002_create_jobs_table` - Queue jobs table
4. `2025_05_30_072355_create_to_dos_table` - Todo items table
5. `2025_05_30_072501_create_personal_access_tokens_table` - API tokens table

### Middleware Stack
- **API Routes**: `auth:sanctum` for token-based authentication
- **Web Routes**: `auth` for session-based authentication
- **Sanctum Middleware**: Session authentication, cookie encryption, CSRF validation

### Repository Pattern
- `UserRepositoryInterface` - Interface for user data operations
- `EloquentUserRepository` - Eloquent implementation of user repository

### Service Layer
- `AuthService` - Handles authentication business logic

---

[Unreleased]: https://github.com/Renymh24/ToDoList_sedernaha/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/Renymh24/ToDoList_sedernaha/releases/tag/v1.0.0
[0.1.0]: https://github.com/Renymh24/ToDoList_sedernaha/releases/tag/v0.1.0
