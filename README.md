# Laravel E-commerce Project

This is an e-commerce application built with the Laravel framework. It provides a set of features for managing products, categories, users, and roles.

## About The Project

This project is a web-based e-commerce platform that allows users to browse products, and administrators to manage the store's inventory. It is built using the TALL stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) and provides a solid foundation for building a modern e-commerce website.

### Built With

* [Laravel](https://laravel.com/)
* [Tailwind CSS](https://tailwindcss.com/)
* [Vite](https://vitejs.dev/)
* [MySQL](https://www.mysql.com/)

## Features

*   **User Authentication:** Secure user registration and login system.
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
    git clone https://github.com/your_username/your_project.git
    cd your_project
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
    ```sh
    cp .env.example .env
    ```

5.  **Generate an application key:**
    ```sh
    php artisan key:generate
    ```

6.  **Configure your database:**
    Open the `.env` file and update the `DB_*` variables with your database credentials.
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

7.  **Run database migrations and seeders:**
    ```sh
    php artisan migrate --seed
    ```

8.  **Build frontend assets:**
    ```sh
    npm run dev
    ```

### Running the Application

To start the local development server, run the following command:

```sh
php artisan serve
```

The application will be accessible at `http://127.0.0.1:8000`.

### Running Tests

To run the application's test suite, execute the following command:

```sh
php artisan test
```

## License

This project is licensed under the MIT License - see the `LICENSE` file for details.