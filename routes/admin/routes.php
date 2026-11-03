<?php

use App\Enums\ViewPaths\Admin\Employee;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

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

});
