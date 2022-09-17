<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    return inertia('home');
})->name('home');

Route::get('/contact', function () {
    return inertia('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
