<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\PermintaanPersediaan;
use App\Models\User;

class PermintaanPersediaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PermintaanPersediaan $permintaan): bool
    {
        if (Policy::make()->allowedFor('bmn')->get()) {
            return true;
        }

        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->andEqual($permintaan->user_id, $user->id)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PermintaanPersediaan $permintaan): bool
    {
        if (Policy::make()->allowedFor('bmn')->get()) {
            return true;
        }

        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->andEqual($permintaan->user_id, $user->id)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PermintaanPersediaan $permintaan): bool
    {
        if (Policy::make()->allowedFor('bmn')->get()) {
            return true;
        }

        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->andEqual($permintaan->user_id, $user->id)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PermintaanPersediaan $permintaan): bool
    {
        return false;
    }
}
