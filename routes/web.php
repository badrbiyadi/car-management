<?php

use App\Http\Controllers\CarController;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(function () {
    Route::get('/cars', [CarController::class, 'index'])->name('cars');
    Route::get('/cars/{id}/edit', [CarController::class, 'edit'])->name('editCar');
    Route::get('/cars/create', [CarController::class, 'create'])->name('createCar');
    Route::delete('/cars/{id}', [CarController::class, 'destroy'])->name('deleteCar');
    Route::put('/cars/{id}', [CarController::class, 'update'])->name('updateCar');
    Route::post('/cars/create', [CarController::class, 'store'])->name('storeCar');
    
})->middleware(['auth']);


require __DIR__.'/auth.php';
