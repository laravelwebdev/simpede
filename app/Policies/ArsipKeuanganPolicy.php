<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\ArsipKeuangan;
use App\Models\User;

class ArsipKeuanganPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('admin,arsiparis')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArsipKeuangan $arsipKeuangan): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($arsipKeuangan->kurun_awal)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArsipKeuangan $arsipKeuangan): bool
    {
        return Policy::make()
            ->allowedFor('admin,arsiparis')
            ->withYear($arsipKeuangan->kurun_awal)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
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
