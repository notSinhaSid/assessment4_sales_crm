# Mini CRM System

A lead management and follow-up tracking CRM built with Laravel, MySQL, and Bootstrap.

## Features

- **Authentication & Roles** — Admin and Sales Executive roles via Laravel Breeze
- **Lead Management (CRUD)** — Admins can add, edit, delete, assign, and update lead status
- **Follow-Up Tracking** — Sales users can log follow-ups, view history per lead, and mark them completed
- **Role-Based Access** — Sales users only see and manage their own assigned leads; Admins have full access
- **Sales Reports** — Total leads, converted/lost counts, total & converted revenue, per-sales-user breakdown
- **Dashboard** — Total leads, new leads, today's follow-ups, and converted leads at a glance

## Tech Stack

- PHP / Laravel 13
- MySQL
- Blade + Bootstrap
- Laravel Breeze (authentication scaffolding)

## Setup Instructions

### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Node.js & npm

### Installation

1. Clone the repository
```bash
   git clone [your-repo-url]
   cd [project-folder]
```

2. Install PHP dependencies
```bash
   composer install
```

3. Install JS dependencies
```bash
   npm install
```

4. Copy the environment file and generate an app key
```bash
   cp .env.example .env
   php artisan key:generate
```

5. Configure your database in `.env`