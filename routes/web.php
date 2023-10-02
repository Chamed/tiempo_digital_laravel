<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth;
use App\Http\Controllers\HomeController;

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

Route::get('/auth', [auth::class, 'show']);

Route::post('/auth', [auth::class, 'authenticate'])->name('auth');

Route::get('/home', [HomeController::class, 'show'])->name('home');

Route::get('/lists', [HomeController::class, 'getAllLists']);

Route::post('/list/create', [HomeController::class, 'createList']);

Route::post('/book/add', [HomeController::class, 'addBook']);

Route::post('/book/alter', [HomeController::class, 'alterBook']);

Route::post('/book/delete', [HomeController::class, 'deleteBook']);

Route::get('/books', [HomeController::class, 'getAllBooks']);



