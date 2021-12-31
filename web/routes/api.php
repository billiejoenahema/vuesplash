<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\LoginUserController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    // ログインユーザー
    Route::get('/login_user', LoginUserController::class)->name('login_user');
    // フォト
    Route::get('/photos', [PhotoController::class, 'index'])->name('photo.index');
    Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photo.show');
    Route::post('/photos', [PhotoController::class, 'create'])->name('photo.create');
    // コメント
    Route::post('/comments', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/comments/{id}', [CommentController::class, 'create'])->name('comment.create');

    // いいね
    Route::put('/likes/{id}', [LikeController::class, 'like'])->name('like.like');
    Route::delete('/likes/{id}', [LikeController::class, 'dislike'])->name('like.dislike');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
