<?php

use App\Http\Controllers\AuthManagerController;
use App\Http\Controllers\BillDetailsController;
use App\Http\Controllers\BTTHController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SearchesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ShiftsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TypeEmployeesController;
use App\Http\Controllers\TypeServicesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('adminIndex');
    Route::resource('bill_details', BillDetailsController::class);
    Route::resource('customers', CustomersController::class);
    Route::resource('type_employees', TypeEmployeesController::class);
    Route::resource('employees', EmployeesController::class);
    Route::resource('shifts', ShiftsController::class);
    Route::resource('type_services', TypeServicesController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('tickets', TicketsController::class);
    Route::get('employees/export', [EmployeesController::class, 'export'])->name('employees.export');
    Route::get('type_employees/export', [TypeEmployeesController::class, 'export'])->name('type_employees.export');
    Route::get('customers/export', [CustomersController::class, 'export'])->name('customers.export');
    Route::get('type_services/export', [TypeServicesController::class, 'export'])->name('type_services.export');
    Route::get('services/export', [ServicesController::class, 'export'])->name('services.export');
    Route::get('tickets/export', [TicketsController::class, 'export'])->name('services.export');
});

Route::get('/', [ServicesController::class, 'homeIndex'])->name('index');
Route::get('/show/{serviceId}', [ServicesController::class, 'showForCustomer'])->name('show');

Route::get('/search', [SearchesController::class, 'index'])->name('search');
////Route::post('/cart/vnpay_payment', [CartController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);
Route::get('/info', [InfoController::class, 'show'])->name('info.show');

//Check login -> true: vào, false: thoát về home
Route::middleware('checkLogin')->group(function () {
    Route::get('profile', [ProfileUserController::class, 'showProfile'])->name('show-profile');
    Route::get('profile/edit', [ProfileUserController::class, 'edit'])->name('edit-profile');
    Route::post('profile/edit', [ProfileUserController::class, 'update'])->name('update-profile');
    Route::get('logout', [AuthManagerController::class, 'logout'])->name('logout');
    // cart route
    Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/cart/increase', [CartController::class, 'increaseQuantity'])->name('increaseQuantity');
    Route::post('/cart/decrease', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity');
    Route::post('/cart/remove', [CartController::class, 'removeItemFromCart'])->name('removeItemFromCart');
    Route::get('/cart/callback', [CartController::class, 'handlePaymentCallback'])->name('handlePaymentCallback');
});
Route::get('register', [AuthManagerController::class, 'showRegistration'])->name('show-registration');
Route::post('register', [AuthManagerController::class, 'register'])->name('register');
Route::get('login', [AuthManagerController::class, 'showLogin'])->name('show-login');
Route::post('login', [AuthManagerController::class, 'login'])->name('login');