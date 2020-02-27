<?php

namespace App\Policies;

use App\User;
use App\Order_details;
use Illuminate\Auth\Access\HandlesAuthorization;

class Order_detailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orderDetails.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the orderDetails.
     *
     * @param  App\User  $user
     * @param  App\Order_details  $orderDetails
     * @return bool
     */
    public function view(User $user, Order_details $orderDetails)
    {
        return false;
    }

    /**
     * Determine whether the user can create a orderDetails.
     *
     * @param  App\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the orderDetails.
     *
     * @param  App\User  $user
     * @param  App\Order_details  $orderDetails
     * @return bool
     */
    public function update(User $user, Order_details $orderDetails)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the orderDetails.
     *
     * @param  App\User  $user
     * @param  App\Order_details  $orderDetails
     * @return bool
     */
    public function delete(User $user, Order_details $orderDetails)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the orderDetails.
     *
     * @param  App\User  $user
     * @param  App\Order_details  $orderDetails
     * @return bool
     */
    public function restore(User $user, Order_details $orderDetails)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the orderDetails.
     *
     * @param  App\User  $user
     * @param  App\Order_details  $orderDetails
     * @return bool
     */
    public function forceDelete(User $user, Order_details $orderDetails)
    {
        return false;
    }
}
