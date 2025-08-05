# ShopHub - Laravel E-commerce Application

<p align="center">
<img src="public/logo.png" width="200" alt="ShopHub Logo">
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About ShopHub

ShopHub is a full-featured e-commerce web application built with Laravel 12, designed for CSIT 4th semester students at LICT (2080 Batch). This project demonstrates modern web development practices using PHP, Laravel framework, and contemporary front-end technologies.

### 🚀 Key Features

- **User Management**
  - User registration and authentication
  - User profiles with editable information
  - Role-based access control (Admin/User)
  - Secure password hashing and validation

- **Product Management**
  - Product catalog with categories
  - Product search functionality with suggestions
  - Product image uploads
  - Stock management
  - Pricing with discount support
  - Product reviews and ratings

- **Shopping Experience**
  - Shopping cart functionality
  - Order management system
  - Order tracking and status updates
  - Order cancellation with automatic refunds
  - Multiple payment status tracking

- **Admin Features**
  - Admin dashboard
  - Product CRUD operations
  - Category management
  - Order management and fulfillment
  - User management

- **Modern UI/UX**
  - Responsive design with Tailwind CSS
  - Interactive elements with Alpine.js
  - Modern component-based architecture
  - Mobile-friendly interface

- **Notifications System**
  - Email notifications for order events
  - Real-time status updates
  - Alert messaging system

## 🛠️ Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: SQLite (can be configured for MySQL/PostgreSQL)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Authentication**: Laravel Breeze
- **Build Tools**: Vite
- **Testing**: Pest PHP
- **Package Manager**: Composer & NPM

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL
- Web Server (Apache/Nginx) or Laravel's built-in server

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/sudipparajulee/ecommerce-csit-4th-lict-2080-BATCH.git
cd ecommerce-csit-4th-lict-2080-BATCH
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Environment Variables

Edit `.env` file with your settings:

```env
APP_NAME=ShopHub
APP_ENV=local
APP_KEY=base64:your_generated_key
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# For MySQL (optional)
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=shophub
# DB_USERNAME=root
# DB_PASSWORD=

# Mail Configuration (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@shophub.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 6. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 7. Storage Link

```bash
# Create symbolic link for file uploads
php artisan storage:link
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Start the Application

```bash
# Start Laravel development server
php artisan serve

# The application will be available at http://localhost:8000
```

## 📁 Project Structure

```
ecommerce-csit-4th-lict-2080-BATCH/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Notifications/       # Email notifications
│   └── View/Components/     # Blade components
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/            # Database seeders
│   └── factories/          # Model factories
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   ├── web.php             # Web routes
│   └── auth.php            # Authentication routes
├── public/
│   ├── images/             # Product images
│   └── storage/            # Linked storage
└── tests/                  # Test files
```

## 🗄️ Database Schema

### Main Tables

- **users** - User accounts and profiles
- **categories** - Product categories
- **products** - Product catalog
- **carts** - Shopping cart items
- **orders** - Customer orders
- **order_items** - Individual order items
- **reviews** - Product reviews and ratings

## 👥 Default Users

After running the seeder, you'll have access to:

### Admin Account
- **Email**: admin@shopHub.com
- **Password**: password
- **Role**: admin

### Regular User Account
- **Email**: john@example.com
- **Password**: password
- **Role**: user

## 🎯 Main Features Usage

### For Customers:
1. **Browse Products**: Visit homepage to see featured products
2. **Search**: Use the search bar for finding specific products
3. **Filter by Category**: Browse products by categories
4. **Add to Cart**: Add desired products to shopping cart
5. **Place Orders**: Complete purchase through checkout
6. **Track Orders**: Monitor order status in profile
7. **Leave Reviews**: Rate and review purchased products

### For Admins:
1. **Dashboard Access**: Login with admin credentials
2. **Manage Products**: Add, edit, delete products
3. **Manage Categories**: Organize product categories
4. **Process Orders**: Update order status and fulfillment
5. **User Management**: Monitor user accounts

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📧 Email Notifications

The application includes email notifications for:
- Order placed confirmation
- Order status updates
- Order cancellation notices

Configure your mail settings in `.env` to enable email notifications.

## 🔧 Configuration

### File Uploads
Product images are stored in `public/images/` directory. Ensure proper permissions for file uploads.

### Queue Configuration
For production, configure queue workers for handling email notifications:

```bash
php artisan queue:work
```

## 🚀 Deployment

### Production Checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Configure production database
3. Set up proper mail configuration
4. Configure web server (Apache/Nginx)
5. Set up SSL certificate
6. Configure queue workers
7. Set up scheduled tasks (if any)
8. Optimize application:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## 🤝 Contributing

This is an educational project for CSIT 4th semester students. Contributions are welcome:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 Development Notes

This project was developed as part of the curriculum for:
- **Course**: Web Development with PHP
- **Institution**: LICT (Lumbini ICT Campus)
- **Batch**: 2080
- **Semester**: 4th
- **Program**: CSIT (Computer Science and Information Technology)

## 🐛 Known Issues

- Image upload validation could be enhanced
- Advanced filtering options can be added
- Payment gateway integration is not implemented
- Advanced inventory management features pending

## 📚 Learning Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev/)
- [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits#laravel-breeze)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Sudip Parajuli**
- GitHub: [@sudipparajulee](https://github.com/sudipparajulee)

## 🙏 Acknowledgments

- Laravel Framework contributors
- LICT faculty and students
- Open source community
- All contributors and testers

---

**Note**: This is an educational project developed for learning purposes. For production use, additional security measures and optimizations should be implemented.
