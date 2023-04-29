<?php

namespace App\Providers;

use App\Repositories\CommentRepository;
use App\Repositories\FriendShipRepository;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\FriendShipRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(CommentRepositoryInterface::class,CommentRepository::class);
        $this->app->bind(FriendShipRepositoryInterface::class,FriendShipRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
