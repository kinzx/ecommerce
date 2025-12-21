# Laravel E-commerce Project

This is an e-commerce application built with the Laravel framework. It provides a set of features for managing products, categories, users, and roles.

## About The Project

This project is a web-based e-commerce platform that allows users to browse products, and administrators to manage the store's inventory. It is built using Laravel, Tailwind CSS, and Vite.

### Built With

* [Laravel](https://laravel.com/)
* [Tailwind CSS](https://tailwindcss.com/)
* [Vite](https://vitejs.dev/)
* [MySQL](https://www.mysql.com/)

## Features

*   **User Authentication:** Secure user registration, login, and social login with Google.
*   **Product Management:** Admins can create, read, update, and delete products.
*   **Category Management:** Organize products into categories.
*   **User Profile:** Users can view and update their profile information.
*   **Role-Based Access Control:** Differentiated user roles and permissions.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine.

*   PHP >= 8.1
*   [Composer](https://getcomposer.org/)
*   [Node.js](https://nodejs.org/en/) & NPM
*   A database server (e.g., MySQL, PostgreSQL)

## Getting Started

Follow these steps to get a local copy up and running.

### Installation

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
    ```sh
    npm run dev
    ```

2.  **Start the local server:**
    In a new terminal, start the Laravel development server.
    ```sh
    php artisan serve
    ```

The application will now be accessible at `http://127.0.0.1:8000`.

### Running Tests

To run the application's test suite, execute the following command:

```sh
php artisan test
```

## License

This project is licensed under the MIT License.
