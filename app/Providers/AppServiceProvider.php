<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Services\ImageService;
use Illuminate\Support\ServiceProvider;

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
