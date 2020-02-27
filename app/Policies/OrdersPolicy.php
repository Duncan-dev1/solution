<?php

namespace App\Policies;

use App\User;
use App\Orders;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the orders.
     *
     * @param  App\User  $user
     * @param  App\Orders  $orders
     * @return bool
     */
    public function view(User $user, Orders $orders)
    {
        return false;
    }

    /**
     * Determine whether the user can create a orders.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the orders.
     *
     * @param  App\User  $user
     * @param  App\Orders  $orders
     * @return bool
     */
    public function update(User $user, Orders $orders)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the orders.
     *
     * @param  App\User  $user
     * @param  App\Orders  $orders
     * @return bool
     */
    public function delete(User $user, Orders $orders)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the orders.
     *
     * @param  App\User  $user
     * @param  App\Orders  $orders
     * @return bool
     */
    public function restore(User $user, Orders $orders)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the orders.
     *
     * @param  App\User  $user
     * @param  App\Orders  $orders
     * @return bool
     */
    public function forceDelete(User $user, Orders $orders)
    {
        return false;
    }
}
