<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# The "Empathetic DXP": A Human-First Growth Engine

## 1. The Concept

### The Problem

Most educational websites act like passive "digital brochures." They rely on cold menus and static text that fail to engage the 95% of visitors who are "just browsing." We have no idea who they are, and our internal team lacks the tools to manage them effectively.

### The Solution

We transformed the website into an **active conversation**.

-   **"Alex" (Virtual Guide):** Replaces the standard menu with a friendly, interactive chat that qualifies leads in real-time.
-   **Personalized Dashboard:** Users are instantly logged in to a homepage that remembers their career goals and shows relevant programs.
-   **Admin Action Center:** An internal tool that allows the team to manage content and leads using AI automation.

### The Impact

-   **Higher Engagement:** Users feel heard and understood, not just processed.
-   **Better Data:** We know exactly _why_ a user helps us (Student vs. Pro, Stuck vs. Ambitious).
-   **Operational Efficiency:** The team can manage the entire platform without coding.

---

## 2. System Capabilities

### For the Student (User)

1.  **Chat Interface:** A warm welcome that builds trust and captures the user's email naturally.
2.  **Instant Access:** No passwords or friction.
3.  **Tailored Roadmap:** A dashboard that highlights the exact skills and programs for _their_ specific career stage (e.g., "AI for Professionals").

### For the Business (Admin)

1.  **Pulse Dashboard:** Real-time view of live traffic and engagement.
2.  **Lead Intelligence:** See exactly who signed up and what they want (Status, Interest, Role).
3.  **Action Center:** Generate new program updates and emails instantly using AI tools.

---

## 3. How to Run (Local Preview)

Follow these steps to set up the prototype on your local machine.

### Prerequisites

-   PHP 8.1 or higher
-   Composer
-   Node.js & NPM

### Installation Steps

1.  **Install PHP Dependencies**

    ```bash
    composer install
    ```

2.  **Install Frontend Dependencies**

    ```bash
    npm install
    ```

3.  **Environment Setup**
    Copy the example environment file and configure it.

    ```bash
    cp .env.example .env
    ```

    _Open the `.env` file and ensure your database settings (DB_DATABASE, etc.) are correct._

4.  **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5.  **Setup Database**
    Run the migrations to create the necessary tables.

    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Run the System**
    You need two terminals running simultaneously:

    **Terminal 1 (Frontend Build):**

    ```bash
    npm run dev
    ```

    **Terminal 2 (Backend Server):**

    ```bash
    php artisan serve
    ```

7.  **Preview**
    Open your browser and visit: `http://127.0.0.1:8000`

---

### Demo Script (Quick Walkthrough)

1.  **Chat with Alex:** Choose "I'm already working" -> "Kinda stuck" -> "AI" to see the "Professional" flow.
2.  **Submit Email:** Enter any email (e.g., `test@example.com`) to be redirected.
3.  **View Dashboard:** Observe how the homepage welcomes you as a "Future AI Leader."
4.  **Admin Panel:** Visit `/admin` to see the real-time "Pulse" dashboard.
