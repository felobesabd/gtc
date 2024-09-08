<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->middleware(['web', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/edit-profile', [AdminController::class, 'editProfile'])->name('admin.edit-profile');
    Route::patch('/update-profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');

    /** UserController */
    Route::resource('/users', UserController::class, ['names' => 'admin.users']);
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    Route::get('/users-data-table', [UserController::class, 'index'])->name('admin.users.data-table');
    /** UserController */

    /** DepartmentController */
    Route::resource('/departments', DepartmentController::class, ['names' => 'admin.departments']);
    Route::get('/departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('admin.departments.delete');
    Route::get('/departments-data-table', [DepartmentController::class, 'index'])->name('admin.departments.data-table');
    /** DepartmentController */

    /** EmployeeController */
    Route::resource('/employees', EmployeeController::class, ['names' => 'admin.employees']);
    Route::get('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employees.delete');
    Route::get('/employees-data-table', [EmployeeController::class, 'index'])->name('admin.employees.data-table');
    /** EmployeeController */
});
