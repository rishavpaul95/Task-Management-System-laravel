# Task Management System

## Introduction

Welcome to the Task Management System, a web application developed using Laravel. This system is designed to help users efficiently manage their tasks, collaborate on projects, and stay organized. Below, you'll find an overview of the key features, installation instructions, and additional details about the project.

## Features

1. **User Authentication:**
   - Register, log in, and log out functionalities to ensure secure access to the system.

2. **Task CRUD Operations:**
   - Create, read, update, and delete tasks with essential details like title, description, due date, and status (pending, in progress, completed).

3. **User Roles and Permissions:**
   - Admins have the authority to manage tasks created by any user, ensuring proper access control.

4. **Task Comments:**
   - Users can add comments to tasks, including timestamps and user associations.

5. **Search and Filters:**
   - Search tasks based on keywords and utilize filters to sort tasks by due date, status, or category.

6. **Notifications:**
   - A notification system is implemented, allowing users to receive email notifications when a task is assigned to them. Gmail SMTP is used for sending task notifications.

7. **Frontend with Blade:**
   - The user interface is powered by Laravel's Blade templating engine, providing a seamless and responsive experience.

8. **File Uploads:**
   - Users can upload and attach files to tasks, enhancing collaboration and document sharing.

9. **Task Categories:**
   - Tasks can be categorized, and admins manage categories to ensure organization and consistency.

10. **Newsletter and Leads:**
    - Integrated with Mailchimp for newsletter functionality and leads storage.

## Installation

Follow these steps to set up the Task Management System on your local environment:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/task-management-system.git

2. **Navigate to the project directory:**
   ```bash
   cd task-management-system

3. **Install dependencies:**
    ```bash
    composer install

4. **Create a copy of the .env.example file:**
   ```bash
   cp .env.example .env

5. **Configure your database and mail settings in the .env file.**

6. **Run migrations:**
   ```bash
   php artisan migrate

7. **Serve the application:**
    ```bash
    php artisan serve

8. **Visit http://localhost:8000 in your browser to access the Task Management System.**



## Contribution

Contributions are welcome! Feel free to submit issues, feature requests, or pull requests. Please follow the [contribution guidelines](CONTRIBUTING.md) when contributing to this project.

## License

This project is licensed under the [MIT License](LICENSE.md).

Happy task managing! 🚀
