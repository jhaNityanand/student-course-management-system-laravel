# Student Course Management System

A comprehensive web-based application for managing students, courses, instructors, and enrollments in an educational institution. Built with Laravel and Bootstrap, this system provides a modern and user-friendly interface for educational administrators.

## Features

- **Student Management**
  - Add, edit, and delete student records
  - View student profiles and enrollment history
  - Search and filter students

- **Course Management**
  - Create and manage courses
  - Assign instructors to courses
  - Track course details (credits, duration, fees)

- **Instructor Management**
  - Manage instructor profiles
  - Assign courses to instructors
  - Track instructor specializations and departments

- **Enrollment Management**
  - Enroll students in courses
  - Track enrollment status and grades
  - View enrollment history

- **Dashboard**
  - Overview of key statistics
  - Recent enrollments
  - Quick access to common actions

## Requirements

- PHP >= 8.1
- MySQL >= 5.7
- Composer
- Node.js & NPM
- Web Server (Apache/Nginx)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/jhaNityanand/student-course-management-system-laravel.git
   cd student-course-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Create environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Configure database**
   - Open `.env` file
   - Update database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

7. **Run database migrations**
   ```bash
   php artisan migrate
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Compile assets**
   ```bash
   npm run dev
   ```

10. **Start the development server**
    ```bash
    php artisan serve
    ```

## Usage

1. Access the application at `http://localhost:8000`
2. Register a new account or login with existing credentials
3. Navigate through the dashboard to access different features
4. Use the navigation menu to manage students, courses, instructors, and enrollments

## Directory Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Helpers/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   ├── js/
│   └── storage/
├── resources/
│   ├── views/
│   └── lang/
└── routes/
    └── web.php
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, email support@example.com or create an issue in the repository.

## Acknowledgments

- Laravel Framework
- Bootstrap
- Font Awesome
- All contributors who have helped shape this project
