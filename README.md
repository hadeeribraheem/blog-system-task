
# Laravel Blog Application

This is a simple Laravel Blog system with authentication, post creation/editing/deleting, and image upload functionality. The application uses the Repository Design Pattern.

## Demo 

https://github.com/user-attachments/assets/14b99636-90c3-458f-af46-fc04b68fc1e3


## 📦 Requirements

- PHP >= 8.1
- Composer
- MySQL or SQLite
- Laravel 10


## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/hadeeribraheem/blog-system-task.git
cd blog-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Create Environment File

```bash
cp .env.example .env
```

Edit `.env` to match your database credentials.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will create the database structure and populate it with sample users and posts.

### 6. Run the Development Server

```bash
php artisan serve
```


##  Default Login

To access the dashboard after seeding, use:

- **Email**: any user mail in database after seeding
- **Password**: password


## Code Structure

- `app/Repositories`: Repository interfaces and implementations
- `app/Services`: Business logic layer
- `app/Http/Requests`: Form request validations
- `app/Http/Resources`: API resources
- `app/Policies`: Authorization policies

## Image Uploads

Uploaded images are stored in `public/images/posts/`. A default image is shown if no image is uploaded.

## ✅ Features

- User Authentication
- Create/Edit/Delete Posts
- Image Upload 
- Pagination, Search, and Sorting with DataTables
- Blade templates styled with Bootstrap 5

---
