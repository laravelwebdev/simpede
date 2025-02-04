<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\PersediaanKeluar;
use App\Models\User;

class PersediaanKeluarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersediaanKeluar $persediaanKeluar): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanKeluar->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersediaanKeluar $persediaanKeluar): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanKeluar->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersediaanKeluar $persediaanKeluar): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanKeluar->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PersediaanKeluar $persediaanKeluar): bool
    {
        return false;
    }
}
