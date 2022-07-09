<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ads
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ads
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }

}
