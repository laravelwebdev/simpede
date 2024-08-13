<?php

namespace App\Policies;

class UnitKerjaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        return session('role') === 'admin';
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return session('role') === 'admin';
    }
}
