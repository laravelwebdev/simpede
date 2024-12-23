<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\KodeBank;
use App\Models\User;

class KodeBankPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('admin,bendahara')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('admin,bendahara')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('admin,bendahara')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Policy::make()
            ->allowedFor('admin,bendahara')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KodeBank $kode): bool
    {
        return Policy::make()
            ->allowedFor('admin,bendahara')
            ->andNotEqual($kode->id, 11, false)
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
