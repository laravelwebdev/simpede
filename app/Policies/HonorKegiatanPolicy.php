<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\HonorKegiatan;
use App\Models\User;

class HonorKegiatanPolicy
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
    public function view(User $user, HonorKegiatan $honor): bool
    {
        return Policy::make()
            ->allowedFor('ppk,arsiparis,bendahara,kpa,ppspm,koordinator,anggota')
            ->withYear($honor->tahun)
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
    public function update(User $user, HonorKegiatan $honor): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->withYear($honor->tahun)
            ->andEqual($honor->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HonorKegiatan $honor): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->withYear($honor->tahun)
            ->andEqual($honor->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
            ->get();
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,ppk')
            ->get();
    }
}
