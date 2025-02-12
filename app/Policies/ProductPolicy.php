<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine if the user can view any products.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->hasRole('admin');
    }

     /**
     * Determine if the user can view a specific product.
     */
    public function view(User $user, Product $product): bool
    {
        //
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->hasRole('admin') || $user->hasRole('seller');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        //
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        //
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        //
        return $user->hasRole('admin') || $user->id === $product->user_id;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        //
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }
}
