<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Peronal\Comment\CommentController;
use App\Http\Controllers\Peronal\Like\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Admin\Category\CategoryController;
use \App\Http\Controllers\Admin\Tag\TagController;
use \App\Http\Controllers\Admin\Post\PostController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Peronal\PersonalController;
use \App\Http\Controllers\Blog\BlogController;
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

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{post}', [BlogController::class, 'show'])->name('blog.show');

    Route::group(['prefix' => '{post}/comments'], function () {
        Route::post('/', [BlogController::class, 'storeComment'])->name('post.comment.store');
    });

    Route::group(['prefix' => '{post}/likes'], function () {
        Route::post('/', [BlogController::class, 'storeLike'])->name('post.like.store');
    });
});

Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [PersonalController::class, 'index'])->name('personal.main.index');
    Route::resource('like', LikeController::class, [
        'names' => [
            'index' => 'personal.like.index',
            'destroy' => 'personal.like.delete'
        ]
    ]);
    Route::resource('comment', CommentController::class, [
        'names' => [
            'index' => 'personal.comment.index',
            'edit' => 'personal.comment.edit',
            'update' => 'personal.comment.update',
            'destroy' => 'personal.comment.delete'
        ]
    ]);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function() {
   Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');
   Route::resource('category', CategoryController::class, [
       'names' => [
           'index' => 'admin.category.index',
           'create' => 'admin.category.create',
           'store' => 'admin.category.store',
           'show' => 'admin.category.show',
           'edit' => 'admin.category.edit',
           'update' => 'admin.category.update',
           'destroy' => 'admin.category.delete'
           ]
   ]);
    Route::resource('tag', TagController::class, [
        'names' => [
            'index' => 'admin.tag.index',
            'create' => 'admin.tag.create',
            'store' => 'admin.tag.store',
            'show' => 'admin.tag.show',
            'edit' => 'admin.tag.edit',
            'update' => 'admin.tag.update',
            'destroy' => 'admin.tag.delete'
        ]
    ]);
    Route::resource('post', PostController::class, [
        'names' => [
            'index' => 'admin.post.index',
            'create' => 'admin.post.create',
            'store' => 'admin.post.store',
            'show' => 'admin.post.show',
            'edit' => 'admin.post.edit',
            'update' => 'admin.post.update',
            'destroy' => 'admin.post.delete'
        ]
    ]);
    Route::resource('user', UserController::class, [
        'names' => [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'store' => 'admin.user.store',
            'show' => 'admin.user.show',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.delete'
        ]
    ]);
});

Auth::routes(['verify' => true]);

