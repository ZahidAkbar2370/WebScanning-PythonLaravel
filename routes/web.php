<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/url-scan', function () {
//     return view('scan');
// });

Route::get("url-scan", [App\Http\Controllers\ScanController::class, "create"]);
Route::post("url-scan", [App\Http\Controllers\ScanController::class, "scan"]);


Route::get("admin/dashboard", [App\Http\Controllers\Admin\DashboardController::class, "index"]);
Route::get("admin/users", [App\Http\Controllers\Admin\UserController::class, "index"]);
Route::get("admin/create-user", [App\Http\Controllers\Admin\UserController::class, "create"]);
Route::post("admin/save-user", [App\Http\Controllers\Admin\UserController::class, "store"]);
Route::get("admin/delete-user/{id}", [App\Http\Controllers\Admin\UserController::class, "destory"]);
Route::get("admin/active-user/{id}", [App\Http\Controllers\Admin\UserController::class, "active"]);
Route::get("admin/inactive-user/{id}", [App\Http\Controllers\Admin\UserController::class, "inactive"]);


Route::get("admin/scans", [App\Http\Controllers\Admin\ScanController::class, "index"]);
Route::get("admin/delete-scan/{id}", [App\Http\Controllers\Admin\ScanController::class, "destory"]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
