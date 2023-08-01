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

Route::get('/',  [UserController::class, 'userIndex']);
Route::get('/home', [UserController::class, 'userIndex']);
Route::get('/filtergender', [UserController::class, 'filterGender']);


Route::post('/dislike', [UserController::class, 'dislikeUser']);
Route::post('/love', [UserController::class, 'loveUser']);
Route::post('/matcher', [UserController::class, 'matcher']);

Route::get('/register', [RegisterController::class,'index']);
Route::post('/register', [RegisterController::class,'store']);


Route::get('/login', function () {
    return view('login');
})->name('login');
//validasi login dari database
Route::post('/login', [RegisterController::class,'login']);
//logout
Route::get('/logout', [RegisterController::class, 'logout']);

Route::get('/profile', [UserController::class, 'index']);
Route::get('/profile/{user:id}/edit', [UserController::class, 'edit']);
Route::put('/profile/{user:id}', [UserController::class, 'update']);
Route::delete('/profile/{user:id}', [UserController::class, 'destroy']);

Route::delete('/deleteImg/{user}', [UserController::class, 'deleteImg']);
Route::post('/unmatch', [UserController::class, 'unmatch']);
