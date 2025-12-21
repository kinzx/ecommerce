# Laravel E-commerce with n8n Automation

This is an e-commerce application built with the Laravel framework. It features a complete product and category management system, integrated with **n8n** for automated reporting to **Telegram** and **Google Sheets**.

## About The Project

<<<<<<< HEAD
This project is a web-based e-commerce platform that allows users to browse products, and administrators to manage the store's inventory. It is built using Laravel, Tailwind CSS, and Vite.
=======
This project is a web-based e-commerce platform that allows users to browse products, and administrators to manage the store's inventory. What makes this project unique is its integration with automation tools to stream real-time activity logs.
>>>>>>> a1a6bcf52356c4b5e276153245b6d7d97da628ed

### Built With

* [Laravel](https://laravel.com/)
* [Tailwind CSS](https://tailwindcss.com/)
* [Vite](https://vitejs.dev/)
* [MySQL](https://www.mysql.com/)
* **[n8n](https://n8n.io/)** (Workflow Automation)

## Features

<<<<<<< HEAD
*   **User Authentication:** Secure user registration, login, and social login with Google.
*   **Product Management:** Admins can create, read, update, and delete products.
*   **Category Management:** Organize products into categories.
*   **User Profile:** Users can view and update their profile information.
*   **Role-Based Access Control:** Differentiated user roles and permissions.
=======
* **User Authentication:** Secure user registration, login, and social login with Google.
* **Product Management:** Admins can create, read, update, and delete products.
* **Category Management:** Organize products into categories with full CRUD capabilities.
* **Automated Logging:** Every transaction (Create/Edit/Delete) is automatically logged into specific **Google Sheets** tabs.
* **Real-time Notifications:** Administrators receive instant alerts via **Telegram Bot** whenever data changes.
* **Role-Based Access Control:** Differentiated user roles and permissions.
>>>>>>> a1a6bcf52356c4b5e276153245b6d7d97da628ed

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

<<<<<<< HEAD
4.  **Create your environment file:**
    Copy the example environment file and create your own.
    ```sh
    cp .env.example .env
    ```

5.  **Generate an application key:**
    This key is used for encryption and is essential for your application's security.
    ```sh
    php artisan key:generate
    ```

### Configuration

#### 1. Database
Open the `.env` file and update the `DB_*` variables with your database credentials.
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

#### 2. Google Login (Socialite)
To enable logging in with Google, you need to add your Google API credentials to the `.env` file.

1.  Navigate to the [Google API Console](https://console.developers.google.com/).
2.  Create a new project or select an existing one.
3.  Go to **APIs & Services** > **Credentials**.
4.  Click **Create Credentials** and select **OAuth client ID**.
5.  Choose **Web application** as the application type.
6.  Under **Authorized redirect URIs**, add the following URL:
    ```
    http://127.0.0.1:8000/google/callback
    ```
7.  Click **Create** and copy the **Client ID** and **Client Secret**.
8.  Add these credentials to your `.env` file:
    ```env
    GOOGLE_CLIENT_ID=your_google_client_id
    GOOGLE_CLIENT_SECRET=your_google_client_secret
    GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/google/callback
    ```

### Database Migration

Run the database migrations to create the necessary tables. You can also seed the database with initial data using the `--seed` flag.
```sh
php artisan migrate --seed
```

### Running the Application

1.  **Build frontend assets:**
    Run the following command to compile the frontend assets with Vite. For development, this will watch for changes.
=======
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
>>>>>>> a1a6bcf52356c4b5e276153245b6d7d97da628ed
    ```sh
    npm run dev
    ```

<<<<<<< HEAD
2.  **Start the local server:**
    In a new terminal, start the Laravel development server.
=======
2.  **Start Backend (Laravel):**
>>>>>>> a1a6bcf52356c4b5e276153245b6d7d97da628ed
    ```sh
    php artisan serve
    ```

<<<<<<< HEAD
The application will now be accessible at `http://127.0.0.1:8000`.
=======
3.  **Start Automation (n8n):**
    ```sh
    n8n start
    ```

The application will be accessible at `http://127.0.0.1:8000`.
>>>>>>> a1a6bcf52356c4b5e276153245b6d7d97da628ed

## License

This project is licensed under the MIT License.
