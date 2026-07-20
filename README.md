# EasyGo – Role-Based Healthcare Appointment Management System

## 📖 Overview
EasyGo is a full-stack healthcare appointment booking platform that enables **clients to book doctors**, **doctors to manage availability and appointments**, and **admins to oversee platform operations**.  
The system is designed with **scalable backend architecture**, **role-based access control**, and **real-world workflows** similar to production healthcare platforms.

This project was developed as part of a **real internship experience**, focusing on backend development, database design, and API-driven workflows.

---

## 👥 User Roles & Features

### 🧑 Client
- User registration and authentication
- Browse doctors and view detailed profiles
- Book appointments based on available time slots
- Make payments for appointments
- Track appointment status:
  - Pending
  - Confirmed
  - Completed
  - Cancelled

---

### 🩺 Doctor
- Doctor registration and profile management
- Manage availability and time slots
- Accept or reject appointment requests
- View upcoming and past appointments
- Track earnings, commissions, and wallet balance

---

### 🛠 Admin
- Approve or reject doctor registrations
- Manage platform CMS pages (Privacy Policy, Terms & Conditions, Tips, etc.)
- Monitor platform activity:
  - Appointments
  - Doctors
  - Clients
- View earnings, commissions, GST, and withdrawals
- Manage system settings and notifications

---

## 🏗 System Architecture

- **Backend Framework**: Laravel (MVC Architecture)
- **Database**: MySQL
- **Authentication**: Role-based authentication & authorization
- **API Style**: RESTful APIs
- **Frontend**: Server-rendered dashboards (Admin & Doctor panels)

---

## 🗄 Database Design

Key database entities include:

- Users (Client / Doctor / Admin)
- Doctor Profiles
- Appointments
- Time Slots
- Payments
- Wallet & Transactions
- CMS Pages

The database schema is optimized for relational integrity, scalability, and real-world usage.

---

## 📸 Screenshots

Below are some screenshots demonstrating core system workflows:

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

### Doctor Details & Slot Management
![Doctor Details](screenshots/doctor-details.png)

### Platform Overview & Analytics
![Platform Overview](screenshots/platform-overview.png)

> Screenshots are included for UI reference and workflow clarity.

---

## 🔄 Appointment Workflow

1. Client selects a doctor and available time slot
2. Client books appointment and completes payment
3. Appointment status is set to **Pending**
4. Doctor accepts or rejects the appointment
5. Appointment progresses to **Confirmed / Completed / Cancelled**
6. Earnings and wallet balances are updated accordingly


## 🚀 How to Run Locally

```bash
git clone https://github.com/your-username/easygo-healthcare-system.git
cd easygo-healthcare-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
