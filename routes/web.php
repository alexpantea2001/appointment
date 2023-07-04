<?php

use App\Http\Controllers\AppointmentHoursController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('appointments', [AppointmentHoursController::class, 'index']);
Route::post('appointments', [AppointmentHoursController::class, 'update'])->name('appointments_update');
Route::get('reserve', [AppointmentsController::class, 'index']);
Route::post('reserve', [AppointmentsController::class, 'reserve'])->name('reserve');
