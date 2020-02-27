<?php

namespace App\Policies;

use App\User;
use App\Supplier_products;
use Illuminate\Auth\Access\HandlesAuthorization;

class Supplier_productsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any supplierProducts.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the supplierProducts.
     *
     * @param  App\User  $user
     * @param  App\Supplier_products  $supplierProducts
     * @return bool
     */
    public function view(User $user, Supplier_products $supplierProducts)
    {
        return false;
    }

    /**
     * Determine whether the user can create a supplierProducts.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the supplierProducts.
     *
     * @param  App\User  $user
     * @param  App\Supplier_products  $supplierProducts
     * @return bool
     */
    public function update(User $user, Supplier_products $supplierProducts)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the supplierProducts.
     *
     * @param  App\User  $user
     * @param  App\Supplier_products  $supplierProducts
     * @return bool
     */
    public function delete(User $user, Supplier_products $supplierProducts)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the supplierProducts.
     *
     * @param  App\User  $user
     * @param  App\Supplier_products  $supplierProducts
     * @return bool
     */
    public function restore(User $user, Supplier_products $supplierProducts)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the supplierProducts.
     *
     * @param  App\User  $user
     * @param  App\Supplier_products  $supplierProducts
     * @return bool
     */
    public function forceDelete(User $user, Supplier_products $supplierProducts)
    {
        return false;
    }
}
