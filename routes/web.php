<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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
Route::get('/',function(){
    return view('welcome');
});

Route::get('/dashboard',[ProductController::class,'index'])->middleware('auth','verified')->name('dashboard');
Route::resource('products',ProductController::class);
Route::post('/sold/{product}',[ProductController::class,'sold'])->name('products.sold');
Route::get('user',[ProductController::class,'user_index'])->name('products.user_index');
Route::delete('user_delete/{user}',[ProductController::class,'destroy2'])->name('products.destroy2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
