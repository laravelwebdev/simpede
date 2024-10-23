<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\IzinKeluar;
use App\Models\User;

class IzinKeluarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('kepala,anggota,koordinator')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IzinKeluar $izinKeluar): bool
    {
        return Policy::make()
            ->withYear(Helper::getYearFromDate($izinKeluar->tanggal))
            ->allowedFor('kepala,anggota,koordinator')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('anggota')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IzinKeluar $izinKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota')
            ->withYear(Helper::getYearFromDate($izinKeluar->tanggal))
            ->andEqual($user->id, $izinKeluar->user_id)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IzinKeluar $izinKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota')
            ->withYear(Helper::getYearFromDate($izinKeluar->tanggal))
            ->andEqual($user->id, $izinKeluar->user_id)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, IzinKeluar $izinKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota')
            ->withYear(Helper::getYearFromDate($izinKeluar->tanggal))
            ->andEqual($user->id, $izinKeluar->user_id)
            ->get();
    }
}
