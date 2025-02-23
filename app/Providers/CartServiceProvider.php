<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }
}
