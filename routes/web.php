<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/category',CategoryController::class);
Route::group(['prefix'=>'category'] ,function () {
    Route::get('/', [CategoryController::class, 'Index'])->name('category.index');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/delete/{id}', [CategoryController::class, 'destory'])->name('category.delete');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); 
    Route::post('/update', [CategoryController::class, 'update'])->name('category.update'); 
 

 });

 Route::group(['prefix'=>'brand'] ,function () {
    Route::get('/', [BrandController::class, 'Index'])->name('brand.index');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/delete/{id}', [BrandController::class, 'destory'])->name('brand.delete');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit'); 
    Route::post('/update', [BrandController::class, 'update'])->name('brand.update'); 
 

 });




