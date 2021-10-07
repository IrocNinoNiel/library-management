<?php

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
Route::get('/book/{id}', [App\Http\Controllers\BookController::class, 'index'])->name('book.index');

Route::group(['middleware' => 'CheckType:admin'],function(){ 
    Route::get('/add',[App\Http\Controllers\BookController::class, 'addpage'])->name('book.addpage');
    Route::post('/add',[App\Http\Controllers\BookController::class, 'store'])->name('book.store');
    Route::delete('/delete/{id}', [App\Http\Controllers\BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\BookController::class, 'editpage'])->name('book.editpage');
    Route::post('/edit/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('book.edit');

    Route::post('/table/{id}',[App\Http\Controllers\BorrowController::class, 'toggle'])->name('borrow.toggle');

    Route::get('/addadmin', [App\Http\Controllers\AdminController::class, 'index'])->name('registeradmin.index');
    Route::post('/addadmin', [App\Http\Controllers\AdminController::class, 'store'])->name('registeradmin.store');
});

Route::group(['middleware' => 'CheckType:user'],function(){ 
    Route::get('/borrow/{id}',[App\Http\Controllers\BorrowController::class, 'index'])->name('borrow.index');
    Route::post('/borrow/{id}',[App\Http\Controllers\BorrowController::class, 'store'])->name('borrow.store');
});

Route::get('/table',[App\Http\Controllers\BorrowController::class, 'table'])->name('borrow.table');