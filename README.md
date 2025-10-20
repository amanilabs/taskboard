🗂️ TaskBoard — Laravel + Blade + Flowbite Kanban App

TaskBoard is a Trello-inspired Kanban task manager built with Laravel 10, Blade, TailwindCSS, and Flowbite.

It lets authenticated users create, edit, and manage tasks with priorities, deadlines, and assignees — all in a clean, modal-based interface.

🌟 Features & Architecture

TaskBoard was designed to showcase a robust, containerized backend architecture built for maintainability, featuring:

✅ Laravel authentication (login/register) and Service Layer pattern for business logic

✅ Create, edit, and delete tasks with user assignment

✅ Set task priority (Lowest, Low, Medium, High) and deadlines

✅ Clean Blade templates with Flowbite components

✅ Dark mode ready (TailwindCSS + Flowbite)

✅ SQLite database with seeded example users and tasks

🧰 Technologies Used

Layer

Technology

Framework

Laravel 10 (PHP 8.2+)

Frontend

Blade + TailwindCSS + Flowbite

Architecture

Service Layer (Logic Separation)

Auth

Built-in Laravel Auth (Breeze / UI)

Database

SQLite (default)

DevOps

Docker / Docker Compose

JS

Vanilla JS (AJAX/Fetch) for dynamic state updates

Package Manager

Yarn

Icons/UI

Flowbite Components + Heroicons

🧱 Project Structure

```text
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
| ...

resources/
├── views/
| ├── auth/
| ├── components/
| ├── layouts/
| ├── tasks/
| └── dashboard.blade.php
public/
├── images/
├── css/
└── js/
```

🐳 Docker Installation (Recommended)

Run the entire application stack without installing local PHP, Composer, or Yarn.

1. Clone the repository:

git clone [https://github.com/](https://github.com/)<amanilabs>/taskboard.git
cd taskboard

2. Build and Run the Stack:
   This command builds the image and starts the container in detached mode.

docker compose up -d --build

3. Initialize Database and Dependencies:
   Run these commands inside the container to set up Laravel.

docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed

4. Access the Application:
   The application will be available at http://localhost:8000.

⚙️ Traditional Installation

For developers who prefer a traditional setup with locally installed PHP and dependencies:

Requirements

PHP 8.2+

Composer

Yarn

SQLite

🪜 Steps

git clone [https://github.com/](https://github.com/)<amanilabs>/taskboard.git
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

yarn dev

# Start the Laravel development server

php artisan serve

🔑 Demo Login

    Email: task@board.com
    Password: 123456
