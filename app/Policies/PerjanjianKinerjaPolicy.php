<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\PerjanjianKinerja;
use App\Models\User;

class PerjanjianKinerjaPolicy
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
    public function view(User $user, PerjanjianKinerja $perjanjian): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($perjanjian->tahun)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('admin,kasubbag')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PerjanjianKinerja $perjanjian): bool
    {
        return Policy::make()
            ->allowedFor('admin,kasubbag')
            ->withYear($perjanjian->tahun)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PerjanjianKinerja $perjanjian): bool
    {
        return Policy::make()
            ->allowedFor('admin,kasubbag')
            ->withYear($perjanjian->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PerjanjianKinerja $perjanjian): bool
    {
        return Policy::make()
            ->allowedFor('admin,kasubbag')
            ->withYear($perjanjian->tahun)
            ->get();
    }
}
