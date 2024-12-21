<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\DokumentasiKegiatan;
use App\Models\User;

class DokumentasiKegiatanPolicy
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
    public function update(User $user, DokumentasiKegiatan $kegiatan): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andEqual($user->id, $kegiatan->user_id)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DokumentasiKegiatan $kegiatan): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andEqual($user->id, $kegiatan->user_id)
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
