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
});

Auth::routes(['register' => false]);

Route::get('/create-user', function () {
    User::create([
        'name' => "Christopher Okokon Ntuk",
        'email' => "admin@admin.com",
        'phone' => "081837880409",
        'password' => Hash::make('secret'),
        'address' => "Dove court garden estate, Utako, Abuja FCT",
        'dob' => "1995-09-05",
        'employee_code' => "GAM-U982002",
        'branch_id' => NULL,
        'role' => 1,
    ]);
    return "Done";
})->name('create.user');

Route::get('/home', 'HomeController@index')->name('home');
