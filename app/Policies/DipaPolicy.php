<?php

namespace App\Policies;

use App\Helpers\Policy;

class DipaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
        ->allowedFor('admin,koordinator,ppk')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }
    public function addMataAnggaran(): bool
    {
        return Policy::make()
        ->allowedFor('admin,koordinator,ppk')
        ->get();
    }
}