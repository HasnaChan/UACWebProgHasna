<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

Route::get('/',  [UserController::class, 'userIndex']);

// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/homeAdmin', [UserController::class, 'adminIndex'])->middleware('admin');
Route::get('/home', [UserController::class, 'userIndex']);
Route::get('/filterjob', [UserController::class, 'filterJob']);

Route::post('/ban-user/{id}', [UserController::class, 'banUser'])->middleware('admin');
Route::post('/unban-user/{id}', [UserController::class, 'unbanUser'])->middleware('admin');

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

Route::get('/payment', function () {
    return view('payment');
})->name('payment');
//validasi login dari database
Route::post('/payment', [RegisterController::class,'payment']);



Route::get('/admin', function () {
    return view('admin.home');
})->middleware('admin');

Route::get('/profile', [UserController::class, 'index']);
Route::get('/profile/{user:id}/edit', [UserController::class, 'edit']);
Route::put('/profile/{user:id}', [UserController::class, 'update']);
Route::delete('/profile/{user:id}', [UserController::class, 'destroy']);

Route::delete('/deleteImg/{user}', [UserController::class, 'deleteImg']);
Route::post('/unmatch', [UserController::class, 'unmatch']);



Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
    // Route::get('/', [UserController::class, 'buserIndex']);
    // Route::get('/filter', [UserController::class,'filterByjob']);

    Route::put('/top-up', [UserController::class, 'topup']);
});
// Route::get('/profile/{user:id}/edit', );
// Route::put('/profile/{user:id}', );
// Route::delete('/profile/{user:id}');
