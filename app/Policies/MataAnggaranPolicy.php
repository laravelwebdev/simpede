<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\MataAnggaran;
use App\Models\User;

class MataAnggaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk,anggota')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MataAnggaran $mataAnggaran): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk,anggota')
            ->withYear($mataAnggaran->dipa->tahun)
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
    public function update(User $user, MataAnggaran $mataAnggaran): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk')
            ->withYear($mataAnggaran->dipa->tahun)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MataAnggaran $mataAnggaran): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk')
            ->andEqual($mataAnggaran->is_manual, true)
            ->withYear($mataAnggaran->dipa->tahun)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('admin,koordinator,ppk,anggota')
            ->get();
    }
}
