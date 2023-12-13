<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            View::share('categories', Category::latest()->published()->get());
            View::share('latest_posts', Post::with('categories','user')->latest()->approved()->published()->take(5)->get());
            View::share('tags', Tag::latest()->published()->get());
            View::share('setting', Setting::first());
        });

        Paginator::useBootstrap();
    }
}
