Task Management System

Features
Authentication
jwt api
Login using username, email, or phone number along with a password.
JWT Authentication for API authentication.

Admin Dashboard
web api
Authentication 
Manage products (Add, Edit, Delete, List).
View all orders placed by users.
CRUD operations for managing users, roles, and permissions.

User 
View all available products.
Add products to the cart.
Checkout and place an order.
View order history and download invoices (PDF format).

Role-Based Access Control (RBAC)
Admin/User roles using middleware.

Clone the repository : git clone https://github.com/aki961996/task.git

cd task

Install dependencies
composer install
npm install

Set up environment
cp .env.example .env

Configure database settings in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

Generate application key :php artisan key:generate


Run database migrations and seed data
php artisan migrate --seed
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder

Run the application : php artisan serve


API Authentication
Authentication is handled using JWT.
To obtain a token, make a POST request to:
/api/login

Technologies Used
Laravel (Backend Framework)
JWT Authentication (API Security)
MySQL (Database)
Blade / React.js (Frontend, if applicable)
Bootstrap 

