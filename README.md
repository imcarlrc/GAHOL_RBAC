# Student Management System

A role-based student management system built with **CodeIgniter 4** and **PHP 8**.

---

## Features

- **Role-Based Access Control** — Admin, Coordinator, Teacher, Student
- **Student Enrollment** — Dedicated form for enrolling students
- **Staff Registration** — Separate form for adding Teachers and Coordinators
- **Teacher Directory** — Faculty listing with profile viewing
- **Student Management** — Full student list with search, view, and edit
- **Smart Navbar** — Auto-highlights based on current page
- **403 Error Page** — Shows exactly which page is restricted

---

## Roles & Permissions

| Feature              | Admin | Coordinator | Teacher | Student |
|----------------------|:-----:|:-----------:|:-------:|:-------:|
| User Management      |  ✅   |      ❌     |    ❌   |    ❌   |
| Role Management      |  ✅   |      ❌     |    ❌   |    ❌   |
| Teacher List         |  ✅   |      ✅     |    ❌   |    ❌   |
| Edit Teacher         |  ✅   |      ❌     |    ❌   |    ❌   |
| Student List         |  ✅   |      ❌     |    ✅   |    ❌   |
| Add New Student      |  ✅   |      ✅     |    ❌   |    ❌   |
| View Student Profile |  ✅   |      ❌     |    ✅   |    ❌   |

---

## Requirements

- PHP 8.1 or higher
- MySQL / MariaDB
- Composer

---

## How to Run

### 1. Clone or extract the project

### 2. Install dependencies
```bash
composer install
```

### 3. Set up your database
- Create a database (e.g. `rbac`)
- Copy `.env.example` to `.env`
- Edit `.env` and set your database credentials:
```
database.default.hostname = localhost
database.default.database = rbac
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Run migrations
```bash
php spark migrate
php spark db:seed Users
```

### 5. Start the server
```bash
php spark serve
```

### 6. Open in browser
```
http://localhost:8080
```

---

## Default Passwords

| Account Type | Default Password |
|--------------|-----------------|
| Staff        | `Password123`   |
| Student      | `Student123`    |

---

## Tech Stack

- **Framework**: CodeIgniter 4.7.2
- **Language**: PHP 8.4
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Bootstrap Icons 
