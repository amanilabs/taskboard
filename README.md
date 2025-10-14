# 🗂️ TaskBoard — Laravel + Blade + Flowbite Kanban App

**TaskBoard** is a Trello-inspired Kanban task manager built with **Laravel 10**, **Blade**, **TailwindCSS**, and **Flowbite**.  
It lets authenticated users create, edit, and manage tasks with priorities, deadlines, and assignees — all in a clean, modal-based interface.

---

## 🌟 Overview

TaskBoard was designed to be a **minimal yet functional Trello clone**, featuring:

-   ✅ Laravel authentication (login/register)
-   ✅ Create, edit, and delete tasks
-   ✅ Assign tasks to registered users
-   ✅ Set task priority (**Lowest**, **Low**, **Medium**, **High**)
-   ✅ Clean Blade templates with Flowbite components
-   ✅ Dark mode ready (TailwindCSS + Flowbite)
-   ✅ SQLite database with **seeded example users and tasks**

---

## 🧰 Technologies Used

| Layer               | Technology                          |
| ------------------- | ----------------------------------- |
| **Framework**       | Laravel 10 (PHP 8.2+)               |
| **Frontend**        | Blade + TailwindCSS + Flowbite      |
| **Auth**            | Built-in Laravel Auth (Breeze / UI) |
| **Database**        | SQLite (default)                    |
| **JS**              | Vanilla JS for modal fetch & toggle |
| **Package Manager** | Yarn                                |
| **Icons/UI**        | Flowbite Components + Heroicons     |

---

## 🧱 Architecture Overview

app/
├── helpers/
│ └── Helper.php
├── Http/
│ └── Controllers/
│ └── AuthController.php
│ └── BoardController.php
│ └── TaskController.php
├── Models/
| └── Board.php
│ └── Label.php
| └── Lane.php
| └── Task.php
| └── User.php

resources/
├── views/
| ├── auth/
│ │ ├── login.blade.php
│ │ └── register.blade.php
| ├── components/
│ │ ├── footer.blade.php
│ │ └── navbar.blade.php
| ├── layouts/
│ │ ├── app.blade.php
│ ├── tasks/
│ │ ├── \_form.blade.php
│ │ └── delete_modal.blade.php
│ │ └── modal.blade.php
| ├── dashboard.blade.php
public/
├── images/
├── css/
└── js/

---

## ⚙️ Installation

### Requirements

-   PHP 8.2+
-   Composer
-   Yarn
-   SQLite

---

🪜 Steps

git clone https://github.com/<yourusername>/taskboard.git
cd taskboard

# Install dependencies

composer install
yarn install

# Create environment

cp .env.example .env
php artisan key:generate

# Database setup

mkdir -p database
touch database/database.sqlite

# Run migrations and seeders

php artisan migrate --seed

# Build assets

yarn install && yarn dev
