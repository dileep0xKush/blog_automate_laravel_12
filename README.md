# 🧠 AI News Generate — Laravel Application

A clean, backend-focused Laravel application for managing and publishing AI-powered News content.  
This project is open source and built to demonstrate how to integrate Laravel with AI APIs (like OpenRouter) using a simple and maintainable architecture.

---

## 📋 Table of Contents

-   [Overview](#-overview)
-   [Features](#-features)
-   [Requirements](#-requirements)
-   [Installation](#-installation)
-   [Environment Setup](#-environment-setup)
-   [Artisan Commands](#-artisan-commands)
-   [Development Notes](#-development-notes)
-   [Deployment](#-deployment)
-   [Contributing](#-contributing)
-   [License](#-license)
-   [Contact](#-contact)

---

## 🌍 Overview

**AI News** is a Laravel-based content management system that leverages AI integrations to help generate and manage articles intelligently.  
It uses **MySQL** for data storage, **Redis** for caching (optional), and includes support for queued jobs, database-backed sessions, and mail logging.

This setup is ideal for developers who want to:

-   Explore Laravel’s backend capabilities.
-   Learn API integration with AI tools.
-   Build production-ready Laravel apps with clean configuration.

---

## ⚡ Features

-   🚀 **Laravel 10+ Framework**
-   🧠 **AI Integration** via [OpenRouter](https://openrouter.ai/)
-   💾 **MySQL** database backend
-   🗃️ **Database sessions and queues**
-   ⚙️ **Redis support** for caching and queues
-   📬 **Mail logging** (no real emails sent in local mode)
-   🪶 **Lightweight backend** — no Node.js or frontend build tools required
-   🔐 **Secure configuration** via `.env` file

---

## 🧩 Requirements

| Dependency         | Minimum Version |
| ------------------ | --------------- |
| PHP                | 8.2             |
| Composer           | 2.5             |
| MySQL              | 8.0             |
| Redis _(optional)_ | Latest          |
| Git                | Any             |

> 🧾 No Node.js or npm required — this project is backend-only.

---

## ⚙️ Installation

Follow these steps to set up the project locally:

1. **Clone the repository**

    ```bash
    git clone https://github.com/yourusername/ai-News.git
    cd ai-News
    ```

````

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Copy the example environment file**

   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**

   ```bash
   php artisan key:generate
   ```

5. **Configure your database credentials** in `.env` (see [Environment Setup](#-environment-setup)).

6. **Run migrations**

   ```bash
   php artisan migrate
   ```

7. **Start the development server**

   ```bash
   php artisan serve
   ```

   Then visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## 🧠 Environment Setup

Example `.env` configuration:

```env
APP_NAME=AI News
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ai_News
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120

QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

OPENROUTER_API_KEY=your_openrouter_api_key_here
```

---

## 🧰 Artisan Commands

| Command                      | Description                          |
| ---------------------------- | ------------------------------------ |
| `php artisan serve`          | Start the local development server   |
| `php artisan migrate`        | Run database migrations              |
| `php artisan db:seed`        | Populate the database with test data |
| `php artisan queue:work`     | Process queued jobs                  |
| `php artisan optimize:clear` | Clear caches                         |
| `php artisan route:list`     | List all registered routes           |
| `php artisan tinker`         | Open an interactive Laravel shell    |

---

## 🧑‍💻 Development Notes

* Application logs: `storage/logs/laravel.log`
* Emails are written to logs (`MAIL_MAILER=log`) for safe testing
* Sessions and queues are stored in the database
* Redis can be enabled for caching and job handling
* The app can be extended easily for APIs, admin dashboards, or AI tools

---

## ☁️ Deployment

When deploying to production:

1. Update `.env`:

   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```
2. Use optimized commands:

   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. Ensure correct file permissions:

   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
4. Configure a real mail service (SMTP, Mailgun, SES, etc.)
5. Restart the queue workers if applicable:

   ```bash
   php artisan queue:restart
   ```

---

## 🤝 Contributing

Contributions are welcome!
If you’d like to improve this project:

1. **Fork** the repository
2. **Create** a new feature branch (`git checkout -b feature/your-feature`)
3. **Commit** your changes (`git commit -m "Add your message"`)
4. **Push** to your branch (`git push origin feature/your-feature`)
5. **Open a Pull Request**

Please make sure your code follows Laravel best practices.

---

## 🔑 License

This project is open source and available under the [MIT License](LICENSE).

---

## 💬 Contact

Created and maintained by **[Dileep Kushwaha](https://github.com/dileep0xkush)**
📧 Email: [dileepkushwaha8090@gmail.com](mailto:dileepkushwaha8090@gmail.com)
🌐 GitHub: [https://github.com/dileep0xkush/ai-News](https://github.com/dileep0xkush/ai-News)

---

> ⭐ If you find this project useful, please give it a star on GitHub — it helps others discover it!

```

````
