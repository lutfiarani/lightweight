<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeightController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\WeightListController;

// Route::get('/', function () {
    // return view('test');
//     return view('admin.view_master_data');
// });
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


Route::controller(MasterController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/upload_master', 'upload_data')->name('master.upload');
    Route::post('/upload_master', 'upload_data')->name('master.upload_data');
    Route::post('/weight/import', 'import')->name('master.import');
    Route::get('/view_upload', 'view_upload')->name('master.view');
    Route::get('/listSearch', 'list_search')->name('master.listSearch');
    Route::get('/view_detail/{id}', 'detail')->name('product.detail');
    Route::post('/searchData', 'search' )->name('searchData');
});


Route::controller(WeightListController::class)->group(function () {
    Route::get('/weight-list', 'index')->name('weight-list');
    Route::post('/weight-list/data', 'getData')->name('weight-data');
    Route::get('weight-list/export', 'export');
    Route::get('/listFactory', 'listFactory')->name('listFactory');
    Route::get('/listCell/{id}', 'listCell')->name('listCell');
    Route::get('/listModel', 'listModel')->name('listModel');
    Route::get('/listArticle/{id}', 'listArticle')->name('listArticle');
});

Route::controller(PercentageController::class)->group( function() {
    Route::get('/percentage', 'index')->name('percentage.value');
    Route::post('/update-weightloss/{id}', 'update')->name('weightloss.update');
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
