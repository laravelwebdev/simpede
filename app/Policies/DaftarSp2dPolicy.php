<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\DaftarSp2d;
use App\Models\User;

class DaftarSp2dPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->notAllowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->notAllowedFor('admin')
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
    public function update(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
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

    public function attachKerangkaAcuan(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }

    public function attachAnyKerangkaAcuan(User $user, DaftarSp2d $sp2d): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->andNotEqual($sp2d->arsip_sp2d, null)
            ->andNotEqual($sp2d->arsip_spm, null)
            ->andNotEqual($sp2d->arsip_spp, null)
            ->andNotEqual($sp2d->arsip_lampiran, null)
            ->andNotEqual($sp2d->arsip_lampiran_spp, null)
            ->get();
    }

    public function detachKerangkaAcuan(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }
}
