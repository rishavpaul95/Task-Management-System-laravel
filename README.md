
Task Management System
Introduction
Welcome to the Task Management System, a web application developed using Laravel. This system is designed to help users efficiently manage their tasks, collaborate on projects, and stay organized. Below, you'll find an overview of the key features, installation instructions, and additional details about the project.

Features
User Authentication:

Register, log in, and log out functionalities to ensure secure access to the system.
Task CRUD Operations:

Create, read, update, and delete tasks with essential details like title, description, due date, and status (pending, in progress, completed).
User Roles and Permissions:

Admins have the authority to manage tasks created by any user, ensuring proper access control.
Task Comments:

Users can add comments to tasks, including timestamps and user associations.
Search and Filters:

Search tasks based on keywords and utilize filters to sort tasks by due date, status, or category.
Notifications:

A notification system is implemented, allowing users to receive email notifications when a task is assigned to them. Gmail SMTP is used for sending task notifications.
Frontend with Blade:

The user interface is powered by Laravel's Blade templating engine, providing a seamless and responsive experience.
File Uploads:

Users can upload and attach files to tasks, enhancing collaboration and document sharing.
Task Categories:

Tasks can be categorized, and admins manage categories to ensure organization and consistency.
Newsletter and Leads:

Integrated with Mailchimp for newsletter functionality and leads storage.
Installation
Follow these steps to set up the Task Management System on your local environment:

Clone the repository:

bash
Copy code
git clone https://github.com/your-username/task-management-system.git
Navigate to the project directory:

bash
Copy code
cd task-management-system
Install dependencies:

bash
Copy code
composer install
Create a copy of the .env.example file:

bash
Copy code
cp .env.example .env
Configure your database and mail settings in the .env file.

Generate application key:

bash
Copy code
php artisan key:generate
Run migrations:

bash
Copy code
php artisan migrate
Serve the application:

bash
Copy code
php artisan serve
Visit http://localhost:8000 in your browser to access the Task Management System.

Contribution
Contributions are welcome! Feel free to submit issues, feature requests, or pull requests. Please follow the contribution guidelines when contributing to this project.

License
This project is licensed under the MIT License.

Happy task managing! 🚀
