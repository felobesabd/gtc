<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StoreLocationController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
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

    /** DriverController */
    Route::resource('/drivers', DriverController::class, ['names' => 'admin.drivers']);
    Route::get('/drivers/delete/{id}', [DriverController::class, 'destroy'])->name('admin.drivers.delete');
    Route::get('/drivers-data-table', [DriverController::class, 'index'])->name('admin.drivers.data-table');
    /** DriverController */

    /** SupplierController */
    Route::resource('/suppliers', SupplierController::class, ['names' => 'admin.suppliers']);
    Route::get('/suppliers/delete/{id}', [SupplierController::class, 'destroy'])->name('admin.suppliers.delete');
    Route::get('/suppliers-data-table', [SupplierController::class, 'index'])->name('admin.suppliers.data-table');
    /** SupplierController */

    /** StoreLocationController */
    Route::resource('/storeLocations', StoreLocationController::class, ['names' => 'admin.storeLocations']);
    Route::get('/storeLocations/delete/{id}', [StoreLocationController::class, 'destroy'])->name('admin.storeLocations.delete');
    Route::get('/storeLocations-data-table', [StoreLocationController::class, 'index'])->name('admin.storeLocations.data-table');
    /** StoreLocationController */

    /** UnitController */
    Route::resource('/units', UnitController::class, ['names' => 'admin.units']);
    Route::get('/units/delete/{id}', [UnitController::class, 'destroy'])->name('admin.units.delete');
    Route::get('/units-data-table', [UnitController::class, 'index'])->name('admin.units.data-table');
    /** UnitController */

    /** ItemCategoryController */
    Route::resource('/itemCats', ItemCategoryController::class, ['names' => 'admin.itemCats']);
    Route::get('/itemCats/delete/{id}', [ItemCategoryController::class, 'destroy'])->name('admin.itemCats.delete');
    Route::get('/itemCats-data-table', [ItemCategoryController::class, 'index'])->name('admin.itemCats.data-table');
    /** ItemCategoryController */

    /** CategoryController */
    Route::resource('/categories', CategoryController::class, ['names' => 'admin.categories']);
    Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    Route::get('/categories-data-table', [CategoryController::class, 'index'])->name('admin.categories.data-table');
    /** CategoryController */

    /** CategoryController */
    Route::resource('/groups', GroupController::class, ['names' => 'admin.groups']);
    Route::get('/groups/delete/{id}', [GroupController::class, 'destroy'])->name('admin.groups.delete');
    Route::get('/groups-data-table', [GroupController::class, 'index'])->name('admin.groups.data-table');
    /** CategoryController */
});
