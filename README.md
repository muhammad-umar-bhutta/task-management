
# Task Management

This Laravel project is a task management system that allows users to manage tasks, upload files, export data to CSV and XLSX formats, and authenticate themselves securely.

Prerequisites:
Make sure you have PHP and Composer installed on your system.
Ensure you have a database server like MySQL, PostgreSQL, or SQLite installed and running.
You should have Git installed on your system.

## Features:

Task Management: Users can create, edit, delete, and mark tasks as completed.

File Upload: Users can upload files, such as documents or images, to attach them to tasks.

Export Data: Users can export task data to CSV and XLSX formats for analysis or sharing.

User Authentication: Secure user authentication system provided by Laravel Breeze for user registration, login, and logout.

Tailwind CSS: Utilizes Tailwind CSS for a clean and responsive user interface design.

### Installation

Install Dependencies

```bash
    composer install
    npm install && npm run dev  
```



### Set Environment Variables:

Create a copy of the .env.example file and name it .env.

### Generate an application key:
```bash
    php artisan key:generate  
```
Update .env file with database credentials and other necessary configurations.

### Run Migrations:

```bash
    php artisan migrate  
```

### Start Development and Vite Server:

```bash
    php artisan serve
    npm run dev  
```

Access Application:

Visit http://localhost:8000 in your web browser to access the application.

### Contributing:

Contributions to this project are welcome. You can contribute by reporting issues, suggesting new features, or submitting pull requests.