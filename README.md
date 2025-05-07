# Library Access Time Management System

A web-based system to monitor and manage student access time in the university library. It supports fingerprint-based entry logging, tracks usage by student, department, and batch, and provides an admin dashboard with analytics.

## 🔧 Features

- 🧑‍🎓 Student entry/exit registration
- 📊 Admin dashboard with:
  - Top 10 students by access time (monthly)
  - Department-wise and batch-wise usage
  - Full access logs
- 🔐 Admin login authentication
- 📁 PHP & MySQL backend
- 🎨 HTML, CSS, JavaScript frontend
- 🧮 Real-time duration calculation

## 🗃️ Database Structure

### `students` table:
- `student_id` (Primary key)
- `name`
- `department`
- `batch`
- `fingerprint_code`

### `access_logs` table:
- `log_id` (Primary key)
- `student_id` (Foreign key)
- `entry_time`
- `exit_time`
- `duration_minutes`
- `duration` (hh:mm)
- `date`

## 🚀 How to Run

1. Clone this repo to your XAMPP `htdocs` folder:
   ```bash
   git clone https://github.com/Fa-him/Library-Access-Time-Management.git
