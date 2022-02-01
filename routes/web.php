<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('/posts',PostController::class);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('posts/{id}',[PostController::class,'show']);

Route::get('/admin',[AdminController::class,'panel'])->middleware('auth');

Route::get('/',[PostController::class,'index']);

Route::get('/posts/{id}/download',[PostController::class,'fileDownload']);
Route::get('/posts/{id}/tdownload',[PostController::class,'torrentdownload']);

Route::get('/user/{id}',[userController::class,'profile'])->name('profile');