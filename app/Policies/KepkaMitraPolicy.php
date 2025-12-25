<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\KepkaMitra;
use App\Models\User;

class KepkaMitraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KepkaMitra $kepkaMitra): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($kepkaMitra->tahun)
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
    public function update(User $user, KepkaMitra $kepkaMitra): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->withYear($kepkaMitra->tahun)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KepkaMitra $kepkaMitra): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->withYear($kepkaMitra->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }
}
