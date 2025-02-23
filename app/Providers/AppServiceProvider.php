<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\ImageService;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(ImageService::class,function(){
            return new ImageService();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Category::observe(CategoryObserver::class);
    }
}
