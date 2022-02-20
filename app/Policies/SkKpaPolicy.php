<?php

namespace App\Policies;

use App\Models\SkKpa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SkKpaPolicy
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
        return $user->role == 'koordinator';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SkKpa  $sK
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SkKpa $sK)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'koordinator';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SkKpa  $sK
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SkKpa $sK)
    {
        return $user->role == 'koordinator';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SkKpa  $sK
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SkKpa $sK)
    {
        return $user->role == 'koordinator';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SkKpa  $sK
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SkKpa $sK)
    {
        return $user->role == 'koordinator';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SkKpa  $sK
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SkKpa $sK)
    {
        return $user->role == 'koordinator';
    }
}
