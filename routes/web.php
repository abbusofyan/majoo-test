<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\KategoriController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function() {
  return redirect('/login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::group(['prefix' => 'master', 'as' => 'master.'], function(){

    Route::group(['prefix' => 'produk', 'as' => 'produk.'], function(){
      Route::get('/', [ProductController::class, 'index'])->name('index');
      Route::get('/tambah', [ProductController::class, 'tambah'])->name('tambah');
      Route::post('/store', [ProductController::class, 'store'])->name('store');
      Route::post('/uploadImage', [ProductController::class, 'uploadImage'])->name('uploadImage');
    });

    Route::group(['prefix' => 'kategori', 'as' => 'kategori.'], function(){
      Route::get('/', [KategoriController::class, 'index'])->name('index');
      Route::get('/tambah', [KategoriController::class, 'tambah'])->name('tambah');
      Route::post('/store', [KategoriController::class, 'store'])->name('store');
      Route::get('/delete/{id}', [KategoriController::class, 'delete'])->name('delete');
      Route::post('/update/{id}', [KategoriController::class, 'update'])->name('update');
    });

  });

});
