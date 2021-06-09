<?php

namespace App\Policies;

use App\Helper\AuthHelper;
use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return AuthHelper::checkAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Address  $address
     * @return mixed
     */
    public function view(User $user, Address $address)
    {
        return $address->user_id == auth('sanctum')->user()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Address  $address
     * @return mixed
     */
    public function update(User $user, Address $address)
    {
        return $address->user_id == auth('sanctum')->user()->id || AuthHelper::checkAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Address  $address
     * @return mixed
     */
    public function delete(User $user, Address $address)
    {
        return $address->user_id == auth('sanctum')->user()->id || AuthHelper::checkAdmin();
    }
}
