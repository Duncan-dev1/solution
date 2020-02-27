<?php

namespace App\Policies;

use App\User;
use App\Suppliers;
use Illuminate\Auth\Access\HandlesAuthorization;

class SuppliersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any suppliers.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the suppliers.
     *
     * @param  App\User  $user
     * @param  App\Suppliers  $suppliers
     * @return bool
     */
    public function view(User $user, Suppliers $suppliers)
    {
        return false;
    }

    /**
     * Determine whether the user can create a suppliers.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the suppliers.
     *
     * @param  App\User  $user
     * @param  App\Suppliers  $suppliers
     * @return bool
     */
    public function update(User $user, Suppliers $suppliers)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the suppliers.
     *
     * @param  App\User  $user
     * @param  App\Suppliers  $suppliers
     * @return bool
     */
    public function delete(User $user, Suppliers $suppliers)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the suppliers.
     *
     * @param  App\User  $user
     * @param  App\Suppliers  $suppliers
     * @return bool
     */
    public function restore(User $user, Suppliers $suppliers)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the suppliers.
     *
     * @param  App\User  $user
     * @param  App\Suppliers  $suppliers
     * @return bool
     */
    public function forceDelete(User $user, Suppliers $suppliers)
    {
        return false;
    }
}
