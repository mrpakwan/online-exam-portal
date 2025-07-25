# 🎓 Online Examination & Student Portal

A modern Laravel 11-based system for managing online exams, class groups, subjects, and student participation. Built with Laravel Breeze and Tailwind CSS for a clean and responsive interface.

---

## 📌 Features

- Laravel 11 + Breeze (Blade + Tailwind)
- Role-based access control: **Lecturer** & **Student**
- Class Group & Subject Management
- Full CRUD for Exams and Questions
- MCQ & Written question types
- Timed exams (set via duration in minutes)
- Auto-submit on time expiration
- Student assignment to Class Groups
- Students can view and take available exams
- Exam Result summary & leaderboard
- Tailwind CSS UI + Font Awesome icons

---

## ⚙️ Tech Stack

- **Backend**: Laravel 11, Eloquent ORM
- **Frontend**: Blade, Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: SQLite
- **Icons**: Font Awesome

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/mrpakwan/online-exam-portal.git
cd online-exam-portal
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Then update the `.env` file with your database credentials (if using MySQL):

```env
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migrations & Seeders

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
```

This will seed:

- Default roles
- Sample Lecturer and Student accounts

### 5. Compile Frontend

```bash
npm run build
```

### 6. Start Development Server

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 👤 Default Accounts

| Role     | Email                 | Password  |
|----------|-----------------------|-----------|
| Lecturer | lecturer@example.com  | password  |
| Student  | studenta1@example.com | password  |
| Student  | studenta2@example.com | password  |
| Student  | studentb1@example.com | password  |
| Student  | studentb2@example.com | password  |

---

## 🗂️ Application Modules

### 👨‍🏫 Lecturer Panel

- Manage Class Groups
- Manage Subjects
- Create Exams (title, subject, duration)
- Add Questions (MCQ or Written)
- Assign Students to Class Groups
- View Results and Leaderboards

### 👩‍🎓 Student Panel

- View Available Exams
- Take Timed Exams
- Submit Answers
- View Scores

---

## 📝 License

Licensed under the [MIT License](LICENSE).

---

## 👋 Contributing

Feel free to fork the project and submit pull requests!

---