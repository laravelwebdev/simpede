<?php

namespace App\Policies;

use App\Models\JenisNaskah;
use App\Models\User;

class JenisNaskahPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, JenisNaskah $jenisNaskah): bool
    {
        return session('role') === 'admin';
    }
}
