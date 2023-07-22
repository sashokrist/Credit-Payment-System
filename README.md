<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Кредит Система

How to run

git clone git@github.com:sashokrist/Credit-Payment-System.git

composer install

cp .env.example .env

php artisan key:generate

Set database credentials in .env

php artisan migrate --seed

php artisan serve

npm install and npm  run dev

Routes:

// Route for displaying all credits
Route::get('/', [LoanController::class, 'index'])->name('loans.index');

// Route for displaying the form to create a new loan
Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');

// Route for handling the form submission to create a new loan
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

// Route for displaying the form to make a payment for a given loan
Route::get('/payments/create', [PaymentController::class, 'createPayment'])->name('payments.create');

// Route for handling the form submission to make a payment for a given loan
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');


