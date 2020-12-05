<?php

use App\User;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Project
    Route::prefix('project')->group(function () {
        Route::get('list', 'ProjectController@index')->name('project.list');
        Route::get('create', 'ProjectController@create')->name('project.create');
        Route::get('edit/{project_code}', 'ProjectController@edit')->name('project.edit');
        Route::get('view/{project_code}', 'ProjectController@view')->name('project.view');
        Route::post('store', 'ProjectController@store')->name('project.store');
        Route::post('update', 'ProjectController@update')->name('project.update');
        Route::get('destroy/{id}', 'ProjectController@destroy')->name('project.destroy');
        // Milestones
        Route::prefix('milestone')->group(function () {
            Route::get('{project_id}/create', 'ProjectController@createMilestone')->name('project.create.milestone');
            Route::post('{project_id}/store', 'ProjectController@storeMilestone')->name('project.store.milestone');
            Route::get('edit/{milestone_id}', 'ProjectController@editMilestone')->name('project.edit.milestone');
            Route::post('update', 'ProjectController@updateMilestone')->name('project.update.milestone');
        });
    });
    // Store management
    Route::prefix('store')->group(function () {
        Route::get('list', 'StoreController@index')->name('store.list');
        Route::get('create', 'StoreController@create')->name('store.create');
        Route::get('edit/{id}', 'StoreController@edit')->name('store.edit');
        Route::get('view/{id}', 'StoreController@view')->name('store.view');
        Route::post('store', 'StoreController@store')->name('store.store');
        Route::post('update', 'StoreController@update')->name('store.update');
        Route::get('destroy/{id}', 'StoreController@destroy')->name('store.destroy');
    });
    // Secretary management
    Route::prefix('secretary')->group(function () {
        Route::get('list', 'StoreController@index')->name('store.list');
        Route::get('create', 'StoreController@create')->name('store.create');
        Route::get('edit/{id}', 'StoreController@edit')->name('store.edit');
        Route::get('view/{id}', 'StoreController@view')->name('store.view');
        Route::post('store', 'StoreController@store')->name('store.store');
        Route::post('update', 'StoreController@update')->name('store.update');
        Route::get('destroy/{id}', 'StoreController@destroy')->name('store.destroy');
    });
    // Supllier management
    Route::prefix('supplier')->group(function () {
        Route::get('list', 'SupplierController@index')->name('supplier.list');
        Route::get('create', 'SupplierController@create')->name('supplier.create');
        Route::get('edit/{id}', 'SupplierController@edit')->name('supplier.edit');
        // Route::get('view/{id}', 'SupplierController@view')->name('supplier.view');
        Route::post('store', 'SupplierController@store')->name('supplier.store');
        Route::post('update', 'SupplierController@update')->name('supplier.update');
        Route::get('destroy/{id}', 'SupplierController@destroy')->name('supplier.destroy');
    });
    // Human Resource
    Route::prefix('employee')->group(function () {
        Route::get('list', 'EmployeeController@index')->name('employee.list');
        Route::get('create', 'EmployeeController@create')->name('employee.create');
        Route::get('edit/{employee_code}', 'EmployeeController@edit')->name('employee.edit');
        Route::get('view/{employee_code}', 'EmployeeController@view')->name('employee.view');
        Route::post('store', 'EmployeeController@store')->name('employee.store');
        Route::post('update', 'EmployeeController@update')->name('employee.update');
        Route::get('destroy/{id}', 'EmployeeController@destroy')->name('employee.destroy');
    });
    // Branches
    Route::prefix('branches')->group(function () {
        Route::get('list', 'BranchController@index')->name('branches.list');
        Route::get('create', 'BranchController@create')->name('branches.create');
        Route::get('edit/{id}', 'BranchController@edit')->name('branches.edit');
        Route::post('store', 'BranchController@store')->name('branches.store');
        Route::post('update', 'BranchController@update')->name('branches.update');
        Route::get('destroy/{id}', 'BranchController@destroy')->name('branches.destroy');
    });
    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('change-password', 'SettingsController@passwordView')->name('settings.password')->middleware('password.confirm');
        Route::post('change-password', 'SettingsController@changePassword')->name('settings.password.change');
    });
});
