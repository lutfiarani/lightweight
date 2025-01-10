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
    Route::get('/prod/input_data_outsole',[WeightController::class, 'input_data_production_outsole'])->name('input_data_production_outsole');
    Route::get('/prod/get_po/{po_no}',[WeightController::class, 'get_data_po'])->name('get_data_po');
    Route::get('/prod/get_data_log',[WeightController::class, 'get_data_log'])->name('get_data_log');
    Route::post('/prod/saving_data_weight',[WeightController::class, 'saving_data'])->name('saving_data');
    Route::post('/prod/view_data_result',[WeightController::class, 'view_data_result'])->name('view_data_result');
    Route::get('/prod/po',[WeightController::class, 'search_po'])->name('search_po');
    Route::post('/prod/delete_data_log',[WeightController::class, 'delete_data_log'])->name('delete_data_log');
    
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
