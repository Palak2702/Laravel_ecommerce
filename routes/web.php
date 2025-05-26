<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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




Route::get('/', [HomeController::class, 'index']);
Route::get('/products-by-category/{id}', [HomeController::class, 'getProductsByCategory']);


// cart 

Route::post('/add-to-cart', [CartController::class, 'add']);
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::get('/get-cart-data', [CartController::class, 'getCartData'])->name('cart.get.data');
Route::get('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('cart.delete.item');
Route::get('/get_cart-subtotal', [CartController::class, 'getCartSubtotal'])->name('cart.subtotal');

Route::get('/cart-checkout', [CartController::class, 'showCartPage'])->name('cart.showCart');
Route::get('/order-success/{order}', [OrderController::class, 'success'])->name('order.success');




Route::get('razorpay-payment', [CartController::class, 'razonPayPage']);
Route::post('razorpay-payment', [CartController::class, 'razonPayStore'])->name('razorpay.payment.store');



// Users

Route::get('/get-my-orders', [UserController::class, 'getorders'])->name('get.my.orders');
Route::get('/contact', [UserController::class, 'show'])->name('contact.show');
Route::post('/contact', [UserController::class, 'submit'])->name('contact.submit');




// Auth ROute

Route::get('/register', [AuthController::class, 'showregisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');



// admin route

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'is_admin']);

// Route::get('/admin/dashboard', function () {
//     return view('admin.welcome_dashboard');
// })->middleware(['auth','is_admin']); 

Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('create.category');
Route::get('/admin/category/fetch', [CategoryController::class, 'fetch'])->name('fetch.category');
Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');


Route::get('/admin/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/admin/product/store', [ProductController::class, 'store'])->name('create.product');
Route::get('/admin/product/fetch', [ProductController::class, 'fetch'])->name('fetch.product');
Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete.product');


Route::get('/admin/users/index', [UserController::class, 'list_users'])->name('admin.users.index');

// Grouped under middleware if needed

Route::post('/admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
Route::post('/admin/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
