<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\NaskahKeluar;
use App\Models\User;

class NaskahKeluarPolicy
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
    public function view(User $user, NaskahKeluar $naskahKeluar): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($naskahKeluar->tanggal))
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
    public function update(User $user, NaskahKeluar $naskahKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->andNotEqual($naskahKeluar->generate, 'A')
            ->withYear(Helper::getYearFromDate($naskahKeluar->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NaskahKeluar $naskahKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->withYear(Helper::getYearFromDate($naskahKeluar->tanggal))
            ->andNotEqual($naskahKeluar->generate, 'A')
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, NaskahKeluar $naskahKeluar): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,kepala,arsiparis')
            ->andNotEqual($naskahKeluar->generate, 'A')
            ->get();
    }
}
