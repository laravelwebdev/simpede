<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\KontrakMitra;
use App\Models\User;

class KontrakMitraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KontrakMitra $kontrak): bool
    {
        return Policy::make()
            ->withYear($kontrak->tahun)
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('ppk')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KontrakMitra $kontrak): bool
    {
        return Policy::make()
            ->allowedFor('ppk')
            ->withYear($kontrak->tahun)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KontrakMitra $kontrak): bool
    {
        return Policy::make()
            ->allowedFor('ppk')
            ->withYear($kontrak->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('ppk')
            ->get();
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('ppk')
            ->get();
    }
}
