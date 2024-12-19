<?php

use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Group rute yang dilindungi dengan middleware 'role:admin'
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/view_master_data',[WeightController::class, 'view_master_data'])->name('view_master_data');
    
});
