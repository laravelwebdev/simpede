<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\DaftarKegiatan;
use App\Models\User;

class DaftarKegiatanPolicy
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
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('all')
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
    public function update(User $user, DaftarKegiatan $daftar): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andNotEqual($daftar->jenis, 'Rapat')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DaftarKegiatan $daftar): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andNotEqual($daftar->jenis, 'Rapat')
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, DaftarKegiatan $daftar): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andNotEqual($daftar->jenis, 'Rapat')
            ->get();
    }
}
