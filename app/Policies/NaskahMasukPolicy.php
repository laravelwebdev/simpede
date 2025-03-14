<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\NaskahMasuk;
use App\Models\User;

class NaskahMasukPolicy
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
    public function view(User $user, NaskahMasuk $naskahMasuk): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($naskahMasuk->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NaskahMasuk $naskahMasuk): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->withYear(Helper::getYearFromDate($naskahMasuk->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NaskahMasuk $naskahMasuk): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->withYear(Helper::getYearFromDate($naskahMasuk->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->get();
    }
}
