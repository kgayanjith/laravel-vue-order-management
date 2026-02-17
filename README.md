# 🚀 Laravel Jetstream Application

A full-stack web application built with **Laravel** and **Vue.js**, featuring authentication via **Laravel Jetstream**.

---

## 📋 Requirements

Before getting started, ensure your environment meets the following requirements:

| Requirement | Version |
|-------------|---------|
| PHP | 8.4+ |
| Laravel | 12 |
| Composer | 2.8.12 |
| Node.js | 18+ |
| NPM | 10.9.3 |
| MySQL | 8.0+ |

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/kgayanjith/laravel-vue-order-management
cd laravel-vue-order-management
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

Open `.env` and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations & Seed Database

```bash
php artisan migrate --seed
```

> This will create all tables and seed the default user account.

---

## 🖥️ Running the Application

Open **two terminals** and run the following commands simultaneously:

**Terminal 1 — Frontend (Vite)**
```bash
npm run dev
```

**Terminal 2 — Backend (Laravel)**
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## 🔐 Default Login Credentials

After running the database seeder, you can log in with the following pre-filled credentials:

| Field | Value |
|-------|-------|
| Email | admin@admin.com |
| Password | password |

> ℹ️ The login form will have these credentials pre-filled for convenience.

---

## 📁 Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Requests/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── js/
│       ├── Components/
│       ├── Layouts/
│       └── Pages/
├── routes/
│   └── web.php
└── ...
```

---

## 🛠️ Tech Stack

- **Backend** — Laravel 12, PHP 8.4
- **Frontend** — Vue.js 3, Inertia.js
- **Authentication** — Laravel Jetstream
- **Database** — MySQL
- **Styling** — Bootstrap

---

## 📝 Notes

The Dashboard was implemented by the developer.