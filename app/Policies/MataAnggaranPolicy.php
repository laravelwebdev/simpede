<?php

namespace App\Policies;

use App\Helpers\Policy;

class MataAnggaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
        ->allowedFor('admin,koordinator,ppk')
        ->andEqual(request()->is('resources/mata-anggarans'), false)
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
        ->allowedFor('admin,koordinator,ppk')
        ->andEqual(request()->is('resources/mata-anggarans/new'), false)
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Policy::make()
        ->allowedFor('admin,koordinator,ppk')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Policy::make()
        ->allowedFor('admin,koordinator,ppk')
            ->get();
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
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }
    
}
