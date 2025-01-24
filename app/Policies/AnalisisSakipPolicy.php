<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\AnalisisSakip;
use App\Models\User;

class AnalisisSakipPolicy
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
    public function view(User $user, AnalisisSakip $analisis): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($analisis->tahun)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AnalisisSakip $analisis): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($analisis->tahun)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AnalisisSakip $analisis): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($analisis->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, AnalisisSakip $analisis): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($analisis->tahun)
            ->get();
    }
}
