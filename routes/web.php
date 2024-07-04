<?php

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
// Route::get('/test', function () {
//     return view('test');
// });

Route::get('/test',[App\Http\Controllers\TestController::class,'testindex'])->name('test2');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('Category/All', [App\Http\Controllers\CategoryController::class, 'AllCat'])->name('all.category');
Route::post('Category/Add', [App\Http\Controllers\CategoryController::class, 'AddCat'])->name('store.category');
Route::get('Category/Edit/{id}', [App\Http\Controllers\CategoryController::class, 'Edit']);
Route::post('Store/Category/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('pdelete/category/{id}', [App\Http\Controllers\CategoryController::class, 'pdelete']);

// brand
Route::get('Brand/All', [App\Http\Controllers\BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('Update/All', [App\Http\Controllers\BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('Brand/Edit/{id}', [App\Http\Controllers\BrandController::class, 'Edit']);
Route::post('Update/Brand/{id}', [App\Http\Controllers\BrandController::class, 'update']);
Route::get('Delete/Brand/{id}', [App\Http\Controllers\BrandController::class, 'Delete']);


