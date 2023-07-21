<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


// routes/web.php

use App\Http\Controllers\LoanController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
