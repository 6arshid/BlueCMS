# BlueCMS - Laravel Content Management System

## Features

- **Page Builder**: Create and manage static or dynamic pages with custom content.
- **Post Management**: Add, edit, and delete blog or news posts.
- **Category System**: Organize content with a flexible category structure.
- **Menu Manager**: Easily build and customize website navigation menus.
- **User Roles & Permissions**: Admin, Editor, and other roles with fine-grained access control.
- **File Manager**: Upload and manage media assets like images and documents.
- **Settings Panel**: Change website title, logo, SEO settings, and more from the admin dashboard.
- **Multilingual Support**: Add and manage translations for different languages.
- **Contact Form**: Built-in contact form with email notifications.
- **SEO Friendly**: Clean URLs, meta tags, and sitemap support.
- **Responsive Design**: Admin panel and front-end optimized for all screen sizes.

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- Git
- MySQL or other supported DB

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/6arshid/BlueCMS.git
cd BlueCMS
```

### 2. Install Backend Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Set Up Environment File

```bash
cp .env.example .env
```

Edit `.env` to configure your database and mail settings.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional but Recommended)

```bash
php artisan db:seed
```

### 8. Compile Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 9. Serve the Application

```bash
php artisan serve
```

Visit:  
```
http://localhost:8000
```

---

## Default Admin Login

If seeded:

- **Email**: admin@admin.com  
- **Password**: password

Make sure to **change the password** after first login.

---

## Notes

- Ensure `storage/` and `bootstrap/cache/` have `775` or `777` permissions if needed.
- If using a custom domain or production server, configure `.env` and `APP_URL` accordingly.
- Compatible with shared hosting and cloud deployments.

---

Made with ❤️ using Laravel 12.
