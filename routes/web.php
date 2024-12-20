<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Group rute yang dilindungi dengan middleware 'role:admin'
Route::middleware(['role:prod'])->group(function () {
    Route::get('/prod/input_data',[WeightController::class, 'input_data_production'])->name('input_data_production');
    
});

// Route::middleware(['auth', 'verified', 'role:prod'])
//     ->group(function () {
//         Route::get('/prod/input_data',[WeightController::class, 'input_data_production'])->name('input_data_production');
// });


// Route::get('/prod/input_data',[WeightController::class, 'input_data_production'])->name('input_data_production');
// Route::get('/prod/input_data', [WeightController::class, 'input_data_production'])->middleware(['auth', 'verified','role:prod'])->name('input_data_production');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
