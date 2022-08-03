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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// For Users show
Route::get('users', [App\Http\Controllers\ItemController::class, 'index'])->name('users.index');
// For Add Item
Route::post('/addItems', [App\Http\Controllers\ItemController::class, 'addItem'])->name('addItems');
// For Edit Items
Route::post('/editUser', [App\Http\Controllers\ItemController::class, 'editUser'])->name('editUser');
// For Update Items
Route::post('/updateUser', [App\Http\Controllers\ItemController::class, 'updateUser'])->name('updateUser');
// For Delete
Route::get('/delete', [App\Http\Controllers\ItemController::class, 'destroy'])->name('delete');
// For Show Subscribs
Route::get('/displaySubscribe', [App\Http\Controllers\SubscribesController::class, 'index'])->name('displaySubscribe.index');
// For Subscribs
Route::post('/subscribeUser', [App\Http\Controllers\SubscribesController::class, 'subscribeUsers'])->name('subscribeUser');
// For Subscribes items
Route::get('/allSubscribe', [App\Http\Controllers\HomeController::class, 'index'])->name('allSubscribe.index');
