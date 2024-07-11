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
// home
Route::get('/test',[App\Http\Controllers\TestController::class,'testindex'])->name('test2');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

// home end
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// category
Route::get('Category/All', [App\Http\Controllers\CategoryController::class, 'AllCat'])->name('all.category');
Route::post('Category/Add', [App\Http\Controllers\CategoryController::class, 'AddCat'])->name('store.category');
Route::get('Category/Edit/{id}', [App\Http\Controllers\CategoryController::class, 'Edit']);
Route::post('Store/Category/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('pdelete/category/{id}', [App\Http\Controllers\CategoryController::class, 'pdelete']);

// subcategory
Route::get('Sub-Category/All', [App\Http\Controllers\SubCategoryController::class, 'AllSubCat'])->name('all.subcategory');
Route::post('Sub-Category/Add', [App\Http\Controllers\SubCategoryController::class, 'AddSubCat'])->name('store.subcategory');
Route::get('Sub-Category/Edit/{id}', [App\Http\Controllers\SubCategoryController::class, 'Edit']);
Route::post('Update/Sub-Category/{id}', [App\Http\Controllers\SubCategoryController::class, 'Update']);
Route::get('Delete/Sub-Category/{id}', [App\Http\Controllers\SubCategoryController::class, 'Delete']);

// brand
Route::get('Brand/All', [App\Http\Controllers\BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('Update/All', [App\Http\Controllers\BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('Brand/Edit/{id}', [App\Http\Controllers\BrandController::class, 'Edit']);
Route::post('Update/Brand/{id}', [App\Http\Controllers\BrandController::class, 'update']);
Route::get('Delete/Brand/{id}', [App\Http\Controllers\BrandController::class, 'Delete']);

// product
Route::get('Product/All', [App\Http\Controllers\ProductController::class, 'AllProduct'])->name('all.product');
Route::post('Product/Add', [App\Http\Controllers\ProductController::class, 'Addproduct'])->name('store.product');
Route::get('Product/Edit/{id}', [App\Http\Controllers\ProductController::class, 'Edit']);
Route::post('Update/Product/{id}', [App\Http\Controllers\ProductController::class, 'Update']);
Route::get('Delete/Product/{id}', [App\Http\Controllers\ProductController::class, 'Delete']);




