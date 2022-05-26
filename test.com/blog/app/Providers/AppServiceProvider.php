<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Service\AdminService;
use App\Service\CategoryService;
use App\Service\CommentService;
use App\Service\LikeService;
use App\Service\PostService;
use App\Service\TagService;
use App\Service\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminService::class, function () {
           return new AdminService(new CategoryRepository(), new PostRepository(), new UserRepository(), new TagRepository());
        });

        $this->app->bind(CategoryService::class, function () {
            return new CategoryService(new CategoryRepository());
        });

        $this->app->bind(TagService::class, function () {
            return new TagService(new TagRepository());
        });

        $this->app->bind(UserService::class, function () {
            return new UserService(new UserRepository());
        });

        $this->app->bind(PostService::class, function () {
            return new PostService(new PostRepository());
        });

        $this->app->bind(LikeService::class, function () {
            return new LikeService(new LikeRepository());
        });

        $this->app->bind(CommentService::class, function () {
            return new CommentService(new CommentRepository());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
