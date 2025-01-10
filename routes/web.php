<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\WeightListController;

// Route::get('/', function () {
    // return view('test');
//     return view('admin.view_master_data');
// });

// Group rute yang dilindungi dengan middleware 'role:admin'
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/view_master_data',[WeightController::class, 'view_master_data'])->name('view_master_data');
    

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