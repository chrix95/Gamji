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
