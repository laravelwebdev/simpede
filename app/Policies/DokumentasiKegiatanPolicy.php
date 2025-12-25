<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DokumentasiKegiatan;

class DokumentasiKegiatanPolicy
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
    public function view(User $user, DokumentasiKegiatan $kegiatan): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($kegiatan->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DokumentasiKegiatan $kegiatan): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($kegiatan->tanggal))
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
            ->withYear(Helper::getYearFromDate($kegiatan->tanggal))
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
