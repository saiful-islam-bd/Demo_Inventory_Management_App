<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StaffController;


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

// Route::get('/', function () {
//     return view('welcome');
// });


// User Routes
Route::get('/', [AuthController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/', [AuthController::class, 'userLogin'])->name('user.login.submit');
Route::get('user/register', [AuthController::class, 'showUserRegisterForm'])->name('user.register');
Route::post('user/register', [AuthController::class, 'userRegister'])->name('user.register.submit');


//User forgot password link
Route::get('/password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/password/forgot', [AuthController::class, 'sendResetLink'])->name('forgot.password.link');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('reset.password.form');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('reset.password');


//Admin forgot password link
Route::prefix('admin')->group(function () {
    Route::get('/password/forgot', [AuthController::class, 'showAdminForgotPasswordForm'])->name('admin.forgot.password.form');
    Route::post('/password/forgot', [AuthController::class, 'sendAdminResetLink'])->name('admin.forgot.password.link');
    Route::get('/password/reset/{token}', [AuthController::class, 'showAdminResetForm'])->name('admin.reset.password.form');
    Route::post('/password/reset', [AuthController::class, 'resetAdminPassword'])->name('admin.reset.password');
});


// Admin Routes
Route::get('/admin', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.submit');
Route::get('/admin/register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'adminRegister'])->name('admin.register.submit');



//Dashboard
Route::get('/dashboard', [DashboarController::class, 'index'])->name('dashboard');


//User
Route::get('users', [UsersController::class, 'index'])->name('users.index');
Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');


//Staff
// Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
// Route::post('staff/store', [StaffController::class, 'store'])->name('staff.store');
// Route::get('staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
// Route::put('staff/{id}', [StaffController::class, 'update'])->name('staff.update');
// Route::delete('staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');


//Customer
Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('customers/store', [CustomerController::class, 'store'])->name('customers.store');
Route::get('customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');


//Supplier
Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('suppliers/store', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
Route::put('suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');


//Task
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');


// Logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');



// php artisan config:clear
// php artisan cache:clear     
// php artisan optimize:clear
