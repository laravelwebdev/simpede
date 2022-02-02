<?php

namespace App\Policies;

use App\Models\Permintaan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermintaanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role != 'admin';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Permintaan $permintaan)
    {
        if (($user->role == 'koordinator') && ($permintaan->unit != $user->unit)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Permintaan $permintaan)
    {
        if (($user->role == 'koordinator') && ($permintaan->unit != $user->unit)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Permintaan $permintaan)
    {
        return $user->role == 'ppk' || ($user->role == 'koordinator') && ($permintaan->unit == $user->unit);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Permintaan $permintaan)
    {
        return $user->role == 'ppk' || ($user->role == 'koordinator') && ($permintaan->unit == $user->unit);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Permintaan  $permintaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Permintaan $permintaan)
    {
        return $user->role == 'ppk' || ($user->role == 'koordinator') && ($permintaan->unit == $user->unit);
    }
}
