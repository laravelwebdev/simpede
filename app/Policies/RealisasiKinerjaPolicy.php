<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\RealisasiKinerja;
use App\Models\User;

class RealisasiKinerjaPolicy
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
    public function view(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RealisasiKinerja $realisasi): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->get() ? true :
             Policy::make()
                 ->allowedFor('koordinator')
                 ->andEqual($realisasi->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
                 ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->get();
    }
}
