<?php

use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\AgencyController as AdminAgencyController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Agency\BrandController as AgencyBrandController;
use App\Http\Controllers\Agency\CategoryController as AgencyCategoryController;
use App\Http\Controllers\Agency\SupplierController as AgencySupplierController;
use App\Http\Controllers\Agency\CustomerController as AgencyCustomerController;
use App\Http\Controllers\Agency\PlanController as AgencyPlanController;
use App\Http\Controllers\Agency\UserController as AgencyUserController;
use App\Http\Controllers\Agency\ProductController as AgencyProductController;
use App\Http\Controllers\Agency\AgencyController as AgencyAgencyController;
use App\Http\Controllers\Agency\DashboardController;
use App\Http\Controllers\Agency\SaleController as AgencySaleController;
use App\Http\Controllers\Agency\OrderController as AgencyOrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;



// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['can:admin','auth']], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // User and Account
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.create.user');
    Route::post('/users/add', [AdminUserController::class, 'create_user'])->name('create.user');
    
    // Delete User
    Route::post('/users/delete/{id}', [AdminUserController::class, 'delete_user'])->name('delete.user');
    
    // Edit User
    Route::get('user/{id}', [AdminUserController::class, 'show'])->name('users.detail');
    Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('update.user');

    // change password
    Route::put('/change_password/{id}', [AdminUserController::class, 'change_password'])->name('change.password');

    // Plan Admin
    Route::get('/plans', [AdminPlanController::class, 'index'])->name('admin.plans.index');
    Route::get('/plans/create', [AdminPlanController::class, 'create'])->name('admin.plans.create');
    Route::post('/plans/store', [AdminPlanController::class, 'store'])->name('admin.plans.store');
    Route::get('/plans/{id}', [AdminPlanController::class, 'edit'])->name('admin.plans.edit');
    Route::put('/plans/update/{id}', [AdminPlanController::class, 'update'])->name('admin.plans.update');

    // Agency
    Route::get('/agencies', [AdminAgencyController::class, 'index'])->name('admin.agencies.index');
    Route::get('/agencies/create', [AdminAgencyController::class, 'create'])->name('admin.agencies.create');
    Route::post('/agencies/store', [AdminAgencyController::class, 'store'])->name('admin.agencies.store');
    Route::get('/agencies/{id}', [AdminAgencyController::class, 'edit'])->name('admin.agencies.edit');
    Route::put('/agencies/update/{id}', [AdminAgencyController::class, 'update'])->name('admin.agencies.update');

    // Order
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.view');
});

// Agency
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    // agency Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Agency
    Route::get('/agencies/change', [AgencyAgencyController::class, 'show'])->name('agency.agencies.show');
    Route::get('/agencies', [AgencyAgencyController::class, 'index'])->name('agency.agencies.index');
    Route::put('/agencies/update', [AgencyAgencyController::class, 'update'])->name('agency.agencies.update');

    // Account
    Route::get('/accounts', [AgencyUserController::class, 'index'])->name('agency.accounts.index');
    Route::get('/accounts/{id}', [AgencyUserController::class, 'edit'])->name('agency.accounts.edit');
    Route::post('/accounts/store', [AgencyUserController::class, 'store'])->name('agency.accounts.store');
    Route::put('/accounts/update/{id}', [AgencyUserController::class, 'update'])->name('agency.accounts.update');
    Route::get('/accounts/change/{id}', [AgencyUserController::class, 'change'])->name('agency.accounts.change');
    Route::put('/accounts/change_password/{id}', [AgencyUserController::class, 'change_password'])->name('agency.accounts.changepass');

    // Plan
    Route::get('/renew', [HomeController::class, 'renew'])->name('dashboard.renew');

    // Category
    Route::get('/categories', [AgencyCategoryController::class, 'index'])->name('agency.categories.index');
    Route::post('/categories/store', [AgencyCategoryController::class, 'store'])->name('agency.categories.store');
    Route::get('/categories/{id}', [AgencyCategoryController::class, 'edit'])->name('agency.categories.edit');
    Route::put('/categories/update/{id}', [AgencyCategoryController::class, 'update'])->name('agency.categories.update');
    Route::delete('/categories/{id}', [AgencyCategoryController::class, 'destroy'])->name('agency.categories.destroy');

    // Brand
    Route::get('/brands', [AgencyBrandController::class, 'index'])->name('agency.brands.index');
    Route::post('/brands/store', [AgencyBrandController::class, 'store'])->name('agency.brands.store');
    Route::get('/brands/{id}', [AgencyBrandController::class, 'edit'])->name('agency.brands.edit');
    Route::put('/brands/update/{id}', [AgencyBrandController::class, 'update'])->name('agency.brands.update');
    Route::delete('/brands/{id}', [AgencyBrandController::class, 'destroy'])->name('agency.brands.destroy');

    // Supplier
    Route::get('/suppliers', [AgencySupplierController::class, 'index'])->name('agency.suppliers.index');
    Route::post('/suppliers/store', [AgencySupplierController::class, 'store'])->name('agency.suppliers.store');
    Route::get('/suppliers/{id}', [AgencySupplierController::class, 'edit'])->name('agency.suppliers.edit');
    Route::get('/suppliers/view/{id}', [AgencySupplierController::class, 'show'])->name('agency.suppliers.view');
    Route::put('/suppliers/update/{id}', [AgencySupplierController::class, 'update'])->name('agency.suppliers.update');
    Route::delete('/suppliers/{id}', [AgencySupplierController::class, 'destroy'])->name('agency.suppliers.destroy');

    // Customer
    Route::get('/customers', [AgencyCustomerController::class, 'index'])->name('agency.customers.index');
    Route::post('/customers/store', [AgencyCustomerController::class, 'store'])->name('agency.customers.store');
    Route::get('/customers/{id}', [AgencyCustomerController::class, 'edit'])->name('agency.customers.edit');
    Route::get('/customers/view/{id}', [AgencyCustomerController::class, 'show'])->name('agency.customers.view');
    Route::put('/customers/update/{id}', [AgencyCustomerController::class, 'update'])->name('agency.customers.update');
    Route::delete('/customers/{id}', [AgencyCustomerController::class, 'destroy'])->name('agency.customers.destroy');

    // Product
    Route::get('/products', [AgencyProductController::class, 'index'])->name('agency.products.index');
    Route::get('/products/create', [AgencyProductController::class, 'create'])->name('agency.products.create');
    Route::post('/products/store', [AgencyProductController::class, 'store'])->name('agency.products.store');
    Route::get('/products/{id}', [AgencyProductController::class, 'edit'])->name('agency.products.edit');
    Route::get('/products/view/{id}', [AgencyProductController::class, 'show'])->name('agency.products.view');
    Route::put('/products/update/{id}', [AgencyProductController::class, 'update'])->name('agency.products.update');
    Route::delete('/products/{id}', [AgencyProductController::class, 'destroy'])->name('agency.products.destroy');

    // Sale
    Route::get('/sales', [AgencySaleController::class, 'index'])->name('agency.sales.index');
    Route::post('/sales/store', [AgencySaleController::class, 'store'])->name('agency.sales.store');
    Route::get('/sales/list', [AgencySaleController::class, 'list'])->name('agency.sales.list');
    Route::get('/sales/invoice-pdf/{no}', [AgencySaleController::class, 'invoice'])->name('agency.sales.invoice.pdf');
    Route::get('/sales/show/{no}', [AgencySaleController::class, 'show'])->name('agency.sales.show');

});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    // Plan
    Route::get('/plans', [AgencyPlanController::class, 'index'])->name('agency.plans.index');

    // plan Order
    Route::get('/plans/order/history', [AgencyOrderController::class, 'index'])->name('agency.plans.order.index');
    Route::get('/plans/order/{id}', [AgencyOrderController::class, 'create'])->name('agency.plans.order.create');
    Route::post('/plans/order/store/{id}', [AgencyOrderController::class, 'store'])->name('agency.plans.order.store');
    Route::get('/plans/view/{id}', [AgencyOrderController::class, 'show'])->name('agency.plans.view');

});


// Frontend
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/register', [FrontendController::class, 'register'])->name('frontend.register');
Route::post('/store', [FrontendController::class, 'store'])->name('frontend.store');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/pricing', [FrontendController::class, 'pricing'])->name('frontend.pricing');
Route::get('/policy', [FrontendController::class, 'policy'])->name('frontend.policy');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');

Auth::routes(['register' => false]);


