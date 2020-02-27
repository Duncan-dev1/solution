<?php

namespace App\Policies;

use App\User;
use App\Products;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the products.
     *
     * @param  App\User  $user
     * @param  App\Products  $products
     * @return bool
     */
    public function view(User $user, Products $products)
    {
        return false;
    }

    /**
     * Determine whether the user can create a products.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the products.
     *
     * @param  App\User  $user
     * @param  App\Products  $products
     * @return bool
     */
    public function update(User $user, Products $products)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the products.
     *
     * @param  App\User  $user
     * @param  App\Products  $products
     * @return bool
     */
    public function delete(User $user, Products $products)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the products.
     *
     * @param  App\User  $user
     * @param  App\Products  $products
     * @return bool
     */
    public function restore(User $user, Products $products)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the products.
     *
     * @param  App\User  $user
     * @param  App\Products  $products
     * @return bool
     */
    public function forceDelete(User $user, Products $products)
    {
        return false;
    }
}
