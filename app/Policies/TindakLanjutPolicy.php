<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\TindakLanjut;
use App\Models\User;

class TindakLanjutPolicy
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
    public function view(User $user, TindakLanjut $tindak_lanjut): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear($tindak_lanjut->tahun)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        $tw = Helper::getTriwulanBerjalan(now()->month);

        return Policy::make()
            ->allowedFor('kasubbag,koordinator')
            ->andEqual(Helper::is_triwulan($tw), true)
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TindakLanjut $tindak_lanjut): bool
    {
        $tw = Helper::getTriwulanBerjalan(now()->month);

        return Policy::make()
            ->allowedFor('kasubbag,koordinator')
            ->withYear($tindak_lanjut->tahun)
            ->andEqual(Helper::is_triwulan($tw), true)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TindakLanjut $tindak_lanjut): bool
    {
        $tw = Helper::getTriwulanBerjalan(now()->month);

        return Policy::make()
            ->allowedFor('kasubbag,koordinator')
            ->andEqual(Helper::is_triwulan($tw), true)
            ->withYear($tindak_lanjut->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, TindakLanjut $tindak_lanjut): bool
    {
        $tw = Helper::getTriwulanBerjalan(now()->month);

        return Policy::make()
            ->allowedFor('kasubbag,koordinator')
            ->andEqual(Helper::is_triwulan($tw), true)
            ->withYear($tindak_lanjut->tahun)
            ->get();
    }
}
