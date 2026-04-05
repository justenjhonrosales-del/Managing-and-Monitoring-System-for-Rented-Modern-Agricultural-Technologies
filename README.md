<<<<<<< HEAD
# 🚜 AgriTechRent

An intelligent agricultural equipment rental management system built with Laravel. Streamline equipment rentals, track usage, and manage your agricultural business operations efficiently.

##  Features

- ** User Management** - Role-based access control (Admin, Customer, Vendor)
- ** Equipment Rentals** - Browse, book, and manage equipment rentals
- ** Rental Tracking** - Track rental duration, dates, and complete rental history
- ** Secure Authentication** - Login system with login attempt monitoring and security
- ** Equipment Settings** - Manage equipment details, configurations, and rental terms
- ** System Settings** - Flexible system-wide configuration management
- ** Dashboard** - Intuitive user interface for managing rentals and profile
- ** Responsive Design** - Built with Tailwind CSS for optimal mobile experience

##  Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL 8.0+ or MariaDB
- Git

##  Installation

### 1. Clone the Repository
```bash
git clone https://github.com/yourusername/AgriTechRent.git
cd AgriTechRent
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` and configure your database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agritech_rent
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Database (Optional)
```bash
php artisan db:seed
```

### 7. Build Frontend Assets
```bash
npm run dev
```

## 🏃 Running the Application

### Development Server
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser

### Build for Production
```bash
npm run build
php artisan optimize
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

Check tests with coverage:
```bash
php artisan test --coverage
```

##  Project Structure

```
app/
├── Http/
│   ├── Controllers/     # Route controllers
│   ├── Middleware/      # Custom middleware
│   └── Requests/        # Form request validation
├── Models/              # Eloquent models
└── Providers/           # Service providers

database/
├── migrations/          # Database migrations
├── factories/           # Model factories
└── seeders/             # Database seeders

resources/
├── views/               # Blade templates
├── js/                  # JavaScript files
└── css/                 # Stylesheets

routes/
├── web.php              # Web routes
├── auth.php             # Authentication routes
└── console.php          # Console routes

tests/
├── Feature/             # Feature tests
└── Unit/                # Unit tests
```

##  Key Models

| Model | Description |
|-------|-------------|
| **User** | System users with role-based permissions |
| **Rental** | Equipment rental records with dates and duration |
| **EquipmentSetting** | Equipment configuration and details |
| **SystemSetting** | System-wide settings and configuration |
| **LoginAttempt** | Login attempt tracking for security |

##  Configuration

### Key Configuration Files
- `config/app.php` - Application configuration
- `config/auth.php` - Authentication settings
- `config/database.php` - Database configuration
- `.env` - Environment variables

##  Contributing

We welcome contributions! Here's how to get started:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

##  License

This project is open-sourced software licensed under the [MIT license](LICENSE).

##  Support

If you need help, please:
- Check the [Laravel documentation](https://laravel.com/docs)
- Open an [issue](https://github.com/yourusername/AgriTechRent/issues)
- Start a [discussion](https://github.com/yourusername/AgriTechRent/discussions)

##  Security

If you discover a security vulnerability, please email security@example.com instead of using the issue tracker.

---

**Made with  for the agricultural community**
=======
# Managing-and-Monitoring-System-for-Rented-Modern-Agricultural-Technologies
>>>>>>> d9f04a3c55558bf47ce662211c5d931a632f2ee8
