<?php

namespace App\Policies;

class DaftarHonorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return (session('role') == 'koordinator') || (session('role') == 'ppk');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return false;
    }

    public function replicates(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function runAction(): bool
    {
        return  session('role') == 'koordinator';
    }
}