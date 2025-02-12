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
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can view a specific product.
     */
    public function view(User $user, Product $product): Response
    {
        return $this->isAdminOrOwner($user, $product)
            ? Response::allow()
            : Response::deny('You do not have permission to view this product.');
    }

    /**
     * Determine if the user can create products.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('seller');
    }

    /**
     * Determine if the user can update a product.
     */
    public function update(User $user, Product $product): Response
    {
        return $this->isAdminOrOwner($user, $product)
            ? Response::allow()
            : Response::deny('You do not have permission to update this product.');
    }

    /**
     * Determine if the user can delete a product.
     */
    public function delete(User $user, Product $product): Response
    {
        return $this->isAdminOrOwner($user, $product)
            ? Response::allow()
            : Response::deny('You do not have permission to delete this product.');
    }

    /**
     * Determine if the user can restore a product.
     */
    public function restore(User $user, Product $product): Response
    {
        return $this->isAdminOrOwner($user, $product)
            ? Response::allow()
            : Response::deny('You do not have permission to restore this product.');
    }

    /**
     * Determine if the user can permanently delete a product.
     */
    public function forceDelete(User $user, Product $product): Response
    {
        return $this->isAdminOrOwner($user, $product)
            ? Response::allow()
            : Response::deny('You do not have permission to permanently delete this product.');
    }

    /**
     * Helper function to check if the user is an admin or the owner of the product.
     */
    private function isAdminOrOwner(User $user, Product $product): bool
    {
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }
}
