<?php

use App\Http\Controllers\Blog\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\PostController;
use App\Http\Controllers\Api\Personal\LikeController;
use App\Http\Controllers\Api\Personal\CommentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["prefix" => "blog"], function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{post}', [BlogController::class, 'show']);

    Route::group(['prefix' => '{post}/comments'], function () {
        Route::post('/', [BlogController::class, 'storeComment']);
    });

    Route::group(['prefix' => '{post}/likes'], function () {
        Route::post('/', [BlogController::class, 'storeLike']);
    });
});

Route::group(["prefix" => "personal"], function () {
   Route::apiResource('like', LikeController::class)->except([
       'index', 'destroy'
   ]);
   Route::apiResource('comment', CommentController::class)->except([
      'index', 'update', 'destroy'
   ]);
});

Route::group(['prefix' => 'admin'], function () {
   Route::get('/', [AdminController::class, 'index']);
   Route::apiResource('category', CategoryController::class);
   Route::apiResource('tag', TagController::class);
   Route::apiResource('post', PostController::class);
   Route::apiResource('user', UserController::class);
});
