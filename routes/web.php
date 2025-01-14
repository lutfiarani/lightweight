<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\WeightListController;
use App\Http\Controllers\ProductWeightController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth.custom-login');
    // return view('admin.view_master_data');
});
// Route::get('/login', function () {
//     return view('login');
// });

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
    Route::get('/prod/model_name',[WeightController::class, 'search_model_name'])->name('search_model_name');
    Route::post('/prod/get_model_name',[WeightController::class, 'get_model_name'])->name('get_model_name');
    Route::post('/prod/view_data_result_outsole',[WeightController::class, 'view_data_result_outsole'])->name('view_data_result_outsole');
    Route::post('/prod/saving_data_weight_outsole',[WeightController::class, 'saving_data_outsole'])->name('saving_data_outsole');
    

});


Route::middleware([('role:dev')])->controller(MasterController::class)->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/upload_master', 'upload_data')->name('master.upload');
    Route::post('/upload_master', 'upload_data')->name('master.upload_data');
    Route::post('/weight/import', 'import')->name('master.import');
    Route::get('/view_upload', 'view_upload')->name('master.view');
    Route::post('/searchData', 'search' )->name('searchData');
    Route::get('/listSearch', 'list_search')->name('master.listSearch');
});

Route::middleware([('role:dev')])->controller(ProductWeightController::class)->group(function () {
    Route::get('/view_detail/{id}', 'detail')->name('product.detail');
    Route::get('/product-weight/{id}/export-pdf', 'exportPDF')->name('product-weight.export-pdf');
    Route::get('/product-weight/{id}/preview-pdf', 'previewPDF')->name('product-weight.preview-pdf');
    
});


Route::middleware([('role:dev')])->controller(WeightListController::class)->group(function () {
    Route::get('/weight-list', 'index')->name('weight-list');
    Route::post('/weight-list/data', 'getData')->name('weight-data');
    Route::get('weight-list/export', 'export');
    Route::get('/listFactory', 'listFactory')->name('listFactory');
    Route::get('/listCell/{id}', 'listCell')->name('listCell');
    Route::get('/listModel', 'listModel')->name('listModel');
    Route::get('/listArticle/{id}', 'listArticle')->name('listArticle');
    Route::get('/weight-list/export', 'export')->name('weight-list.export');
});

Route::middleware([('role:dev')])->controller(PercentageController::class)->group( function() {
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

// Route::get('/register', function(){
//     return view('auth.custom-register');
// })->middleware([('role:dev')])->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware([('role:dev')]);

require __DIR__.'/auth.php';
