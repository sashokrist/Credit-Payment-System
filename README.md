<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# 💳  Кредит Система – Laravel App

A simple credit and loan management system built using **Laravel** and **MySQL**. This app allows users to register new loans, view existing credit records, and process payments against outstanding loans.

---

## 🧾 Features

- Register new loans with user, amount, and term
- View all current credit entries
- Add payments to existing loans
- Basic interest and installment tracking (if extended)
- Database seeding for testing

---

## ⚙️ How to Run Locally

### 📦 Clone the Repository

```bash
git clone git@github.com:sashokrist/Credit-Payment-System.git
cd Credit-Payment-System
🔧 Backend Setup

composer install
cp .env.example .env
php artisan key:generate
Edit the .env file to set your database credentials.

Then run:

php artisan migrate --seed
php artisan serve
💻 Frontend Setup

npm install
npm run dev
Access the app at: http://localhost:8000

🗺️ Available Routes
Here are the key routes used in the system:

Method	URI	Controller Action	Route Name
GET	/	LoanController@index	loans.index
GET	/loans/create	LoanController@create	loans.create
POST	/loans	LoanController@store	loans.store
GET	/payments/create	PaymentController@createPayment	payments.create
POST	/payments	PaymentController@store	payments.store

🛠️ Tech Stack
Framework: Laravel

Languages: PHP, JavaScript

Frontend: Blade, Bootstrap (or other)

Database: MySQL

Tools: Laravel Seeder, Artisan CLI, Laravel Mix

📄 License
This project is open source and available under the MIT License.

🙌 Author
Aleksander Keremidarov
