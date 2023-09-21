<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::resource('/emails', EmailController::class)->middleware('auth');
Route::get('/emails/{id}/suspend', [EmailController::class, 'suspend'])->name('emails.suspend');
Route::get('/emails/{id}/active', [EmailController::class, 'active'])->name('emails.active');
Route::get('/emails/{id}/change_password', [EmailController::class, 'change_password'])->name('emails.change_password');


require __DIR__.'/auth.php';
