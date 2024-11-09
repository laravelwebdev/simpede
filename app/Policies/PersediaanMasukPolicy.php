<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\PersediaanMasuk;
use App\Models\User;

class PersediaanMasukPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersediaanMasuk $persediaanMasuk): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanMasuk->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersediaanMasuk $persediaanMasuk): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanMasuk->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersediaanMasuk $persediaanMasuk): bool
    {
        return Policy::make()
            ->allowedFor('bmn')
            ->withYear(Helper::getYearFromDate($persediaanMasuk->tanggal_buku))
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PersediaanMasuk $persediaanMasuk): bool
    {
        return false;
    }
}
