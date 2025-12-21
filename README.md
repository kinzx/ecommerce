# Laravel E-commerce with n8n Automation

This is an e-commerce application built with the Laravel framework. It features a complete product and category management system, integrated with **n8n** for automated reporting to **Telegram** and **Google Sheets**.

## About The Project

This project is a web-based e-commerce platform that allows users to browse products, and administrators to manage the store's inventory. What makes this project unique is its integration with automation tools to stream real-time activity logs.

### Built With

* [Laravel](https://laravel.com/)
* [Tailwind CSS](https://tailwindcss.com/)
* [Vite](https://vitejs.dev/)
* [MySQL](https://www.mysql.com/)
* **[n8n](https://n8n.io/)** (Workflow Automation)

## Features

* **User Authentication:** Secure user registration, login, and social login with Google.
* **Product Management:** Admins can create, read, update, and delete products.
* **Category Management:** Organize products into categories with full CRUD capabilities.
* **Automated Logging:** Every transaction (Create/Edit/Delete) is automatically logged into specific **Google Sheets** tabs.
* **Real-time Notifications:** Administrators receive instant alerts via **Telegram Bot** whenever data changes.
* **Role-Based Access Control:** Differentiated user roles and permissions.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

* PHP >= 8.1
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org/en/) & NPM
* A database server (e.g., MySQL)
* **n8n** (installed globally via npm: `npm install n8n -g`)

## Getting Started

Follow these steps to get a local copy up and running.

### 1. Application Installation

1.  **Clone the repository:**
    ```sh
    git clone <repository-url>
    cd <project-directory>
    ```

2.  **Install PHP dependencies:**
    ```sh
    composer install
    ```

3.  **Install NPM dependencies:**
    ```sh
    npm install
    ```

4.  **Environment Setup:**
    Copy the example environment file and create your own.
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Database Configuration:**
    Open `.env` and configure your database:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_ecommerce
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Run Migrations:**
    ```sh
    php artisan migrate --seed
    ```

### 2. Google OAuth Configuration (Login & n8n)

To enable Google Login and n8n Google Sheets integration, you need a project in Google Cloud Console.

1.  Go to [Google Cloud Console](https://console.developers.google.com/).
2.  Enable the following APIs:
    * **Google Drive API**
    * **Google Sheets API**
3.  Create OAuth Credentials:
    * **Authorized redirect URIs (For Laravel):** `http://127.0.0.1:8000/auth/google/callback`
    * **Authorized redirect URIs (For n8n):** `http://localhost:5678/rest/oauth2-credential/callback`
4.  Add Client ID & Secret to your `.env` file:
    ```env
    GOOGLE_CLIENT_ID=your_client_id
    GOOGLE_CLIENT_SECRET=your_client_secret
    GOOGLE_REDIRECT_URI=[http://127.0.0.1:8000/auth/google/callback](http://127.0.0.1:8000/auth/google/callback)
    ```

### 3. Automation Setup (n8n)

This project relies on n8n running locally on port `5678`.

1.  **Start n8n:**
    Open a new terminal and run:
    ```sh
    n8n start
    ```
2.  **Access n8n Dashboard:**
    Open `http://localhost:5678` in your browser.
3.  **Import Workflow:**
    * Create a new workflow.
    * Add a **Webhook** node (Method: POST, Path: `/webhook/laporan-toko`).
    * Add **Switch** node to filter "Barang" vs "Kategori".
    * Add **Google Sheets** nodes (Action: Append) connecting to your spreadsheet.
    * Add **Telegram** nodes for notifications.
4.  **Activate Workflow:**
    Ensure the workflow is set to **Active** (Green toggle on top right).

**Note:** Ensure your Google Sheet has two tabs named exactly:
* `Log Produk`
* `Log Kategori`

### Running the Application

1.  **Start Frontend (Vite):**
    ```sh
    npm run dev
    ```

2.  **Start Backend (Laravel):**
    ```sh
    php artisan serve
    ```

3.  **Start Automation (n8n):**
    ```sh
    n8n start
    ```

The application will be accessible at `http://127.0.0.1:8000`.

## License

This project is licensed under the MIT License.
