<?php

use App\Enums\ViewPaths\Admin\Customer;
use App\Enums\ViewPaths\Admin\CustomRole;
use App\Enums\ViewPaths\Admin\Employee;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Employee\CustomRoleController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'rootLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::group(['prefix' => 'employee', 'as' => 'employee.'], function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::get(Employee::LIST[URI], 'index')->name('list');
            Route::get(Employee::ADD[URI], 'getAddView')->name('add-new');
            Route::post(Employee::ADD[URI], 'add');
            Route::get(Employee::VIEW[URI].'/{id}', 'getView')->name('view');
            Route::get(Employee::UPDATE[URI].'/{id}', 'getUpdateView')->name('update');
            Route::post(Employee::UPDATE[URI].'/{id}', 'update');
            Route::post(Employee::STATUS[URI], 'updateStatus')->name('status');
            Route::delete(Employee::DELETE[URI].'/{id}', 'delete')->name('delete');
            Route::get(Employee::EXPORT[URI], 'exportList')->name('export');

        });

    });
    Route::group(['prefix' => 'custom-role', 'as' => 'custom-role.', 'middleware' => 'module:user_section'], function () {
        Route::controller(CustomRoleController::class)->group(function () {
            Route::get(CustomRole::ADD[URI], 'index')->name('create');
            Route::post(CustomRole::ADD[URI], 'add')->name('store');
            Route::get(CustomRole::UPDATE[URI].'/{id}', 'getUpdateView')->name('update');
            Route::post(CustomRole::UPDATE[URI].'/{id}', 'update');
            Route::post(CustomRole::STATUS[URI], 'updateStatus')->name('employee-role-status');
            Route::post(CustomRole::DELETE[URI], 'delete')->name('delete');
            Route::get(CustomRole::EXPORT[URI], 'exportList')->name('export');
        });
    });

    Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['module:user_section']], function () {
        Route::controller(CustomerController::class)->group(function () {
            Route::get(Customer::LIST[URI], 'getListView')->name('list');
            Route::get(Customer::VIEW[URI].'/{user_id}', 'getView')->name('view');
            Route::get(Customer::EDIT[URI], 'getEditView')->name('edit');
            Route::post(Customer::EDIT[URI], 'update')->name('update');
            Route::post(Customer::UPDATE[URI], 'updateStatus')->name('status-update');
            Route::delete(Customer::DELETE[URI], 'delete')->name('delete');
            Route::get(Customer::ADD[URI], 'getAddView')->name('add');
            Route::post(Customer::ADD[URI], 'add');
            Route::get(Customer::SEARCH[URI], 'getCustomerList')->name('customer-list-search');
            Route::get(Customer::SEARCH[URI], 'getCustomerList')->name('customer-list-search');
            Route::get(Customer::EXPORT[URI], 'exportList')->name('export');
            // Route::get(Customer::SUBSCRIBER_LIST[URI], 'getSubscriberListView')->name('subscriber-list');
            // Route::get(Customer::SUBSCRIBER_EXPORT[URI], 'exportSubscribersList')->name('subscriber-list.export');
            // Route::get(Customer::EXPORT[URI], 'exportList')->name('export');
            // Route::get(Customer::SEARCH[URI],'getCustomerList')->name('customer-list-search');
            // Route::post(Customer::ADD[URI],'add')->name('add');
        });
    });

});
